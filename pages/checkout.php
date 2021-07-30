<head>
    <link href="../styles/checkout.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
// The first thing is always start the session
session_start();

// Get the user id from the session
$idUsuario = $_SESSION['idUsuario'];

// The most important file of the project
include '../conexion.php';

// After pressing the button the "isset" func. is going to search for the inputs with the following names:
if (isset($_POST['submitBtn'])) {
    // Set the input values to a variable
    $numeroTarjeta = $_POST['tarjeta'];
    $direccion1 = $_POST['dir1'];
    $direccion2 = $_POST['dir2'];
    $telefono = $_POST['telefono'];
    $total = $_SESSION['total'];
    $metodoPago = $_POST['metodo'];

    // Call the stored procedure to insert the payment info
    $insertInfoPago = oci_parse($conn, "begin INSERT_INFOPAGO(:NUM_TARJETA, :DIR_FACTURACION, :DIR_FACTURACION2, :TELEFONO, :TOTAL, :ID_USUARIO, :ID_METODOPAGO); end;");

    // Bind the parameters into the stored procedure, this is strictly neccesary
    oci_bind_by_name($insertInfoPago, ":NUM_TARJETA", $numeroTarjeta, -1);
    oci_bind_by_name($insertInfoPago, ":DIR_FACTURACION", $direccion1, -1);
    oci_bind_by_name($insertInfoPago, ":DIR_FACTURACION2", $direccion2, -1);
    oci_bind_by_name($insertInfoPago, ":TELEFONO", $telefono, -1);
    oci_bind_by_name($insertInfoPago, ":TOTAL", $total, -1);
    oci_bind_by_name($insertInfoPago, ":ID_USUARIO", $idUsuario, -1);
    oci_bind_by_name($insertInfoPago, ":ID_METODOPAGO", $metodoPago, -1);

    // Execute de stored procedure
    oci_execute($insertInfoPago);

    // Redirect to "confirmacion.php" after the insert is accomplished
    header('Location: confirmacion.php');
}

// If you got an include and a header() the header by force needs to be the first line code
include "../components/header.php";

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);
$curs2 = oci_new_cursor($conn);

// Call the stored procedure to bring all metodos de pago
$getAllMetodoPago = oci_parse($conn, "begin GET_ALL_METODOPAGO(:CM); end;");
$getCarritos = oci_parse($conn, "begin GET_CARRITOS(:CM, :ID_USUARIO); end;");

// Pass the memory cursor into the stored procedure, Note: Idk what -1 does, but leave it there hehe
oci_bind_by_name($getAllMetodoPago, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getCarritos, ":CM", $curs2, -1, OCI_B_CURSOR);
oci_bind_by_name($getCarritos, ":ID_USUARIO", $idUsuario, -1);

// Execute the stored procedured and the memory cursor
oci_execute($getAllMetodoPago);
oci_execute($getCarritos);
oci_execute($curs);
oci_execute($curs2);
?>

<body class="bg-light">
    <main class="page payment-page">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Formulario de Pago</h2>
                    <p>Una vez finalizado la compra le redirigirá a una página de confirmación.</p>
                </div>

                <!-- First section -->
                <form id="formCheckout" action="" method="post">
                    <div class="products">
                        <h3 class="title">Checkout</h3>
                        <?php
                        // Fetch the array of the first stored procedure to create a new option for each metodo de pago
                        while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                            // Fetch the table values into variables
                            $cantidadCarrito = $row2['CANTIDAD'];
                            $nombreProducto = $row2['NOMBRE'];
                            $descripcionProducto = $row2['DESCRIPCION'];
                            $precioProducto = $row2['PRECIO'];

                            // Print the items into the checkout page for user comfort
                            echo '<div class="item">
                                    <span class="price">₡' . $precioProducto * $cantidadCarrito . '</span>
                                        <p class="item-name">' . $nombreProducto . ' (' . $cantidadCarrito . ')' . '</p>
                                        <p class="item-description">' . $descripcionProducto . '</p>
                                </div>';
                        }
                        ?>
                        <?php
                        echo '<div class="total">Total<span class="price">₡' . $_SESSION['total'] . '</span></div>';
                        ?>
                    </div>

                    <!-- Second section -->
                    <div class="card-details">
                        <h3 class="title text-uppercase">Método de Pago</h3>
                        <div class="row">
                            <div class="form-group col-sm-7">
                                <label for="metodo">Método de Pago</label>
                                <select name="metodo" class="form-control">
                                    <?php
                                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        // Fetch the table values into variables
                                        $id = $row['ID_METODOPAGO'];
                                        $nombre = $row['NOMBRE'];
                                        // Print the payments methods into the select
                                        echo '<option value="' . $id . '">' . $nombre . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="">Fecha de Expiración</label>
                                <div class="input-group expiration-date">
                                    <input type="text" class="form-control" placeholder="MM">
                                    <span class="date-separator">/</span>
                                    <input type="text" class="form-control" placeholder="YY">
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <label id="tarjetaVal">Número de Tarjeta</label>
                                <input id="tarjeta" name="tarjeta" type="text" class="form-control" maxlength="16">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="cvc">Código de Seguridad</label>
                                <input type="text" class="form-control" placeholder="CVC">
                            </div>
                        </div>
                    </div>

                    <!-- Third section -->
                    <div class="card-details">
                        <h3 class="title text-uppercase">Información de Facturación</h3>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label id="dir1Val">Dirección Línea 1</label>
                                <input id="dir1" name="dir1" type="text" class="form-control" maxlength="30">
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="dir2Val">Dirección Línea 2</label>
                                <div class="input-group expiration-date">
                                    <input id="dir2" name="dir2" type="text" class="form-control" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group col-sm-7">
                                <label id="telVal">Teléfono</label>
                                <input id="tel" name="telefono" type="text" class="form-control">
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="cvc">Código Postal</label>
                                <input type="text" class="form-control" maxlength="10">
                            </div>
                            <div class="form-group col-sm-12">
                                <button id="btnBuy" name="submitBtn" type="submit" class="btn btn-primary btn-block">Confirmar Compra</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php
    include '../components/footer.php';
    ?>
    <script src="../scripts/validacionForm.js"></script>

</body>

<!-- We'll need to free the statments and close the conn here -->