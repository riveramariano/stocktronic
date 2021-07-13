<head>
    <link href="../styles/checkout.css" rel="stylesheet" />
</head>

<?php
// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);
$curs2 = oci_new_cursor($conn);

// Call the stored procedure to bring all metodos de pago
$getAllMetodoPago = oci_parse($conn, "begin GET_ALL_METODOPAGO(:CM); end;");
$getCarritos = oci_parse($conn, "begin GET_CARRITOS(:CM, 1); end;");

// Pass the memory cursor into the stored procedure, Note: Idk what -1 does, but leave it there hehe
oci_bind_by_name($getAllMetodoPago, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getCarritos, ":CM", $curs2, -1, OCI_B_CURSOR);

// Execute the stored procedured and the memory cursor
oci_execute($getAllMetodoPago);
oci_execute($getCarritos);
oci_execute($curs);
oci_execute($curs2);

// Start the session to get the total amount value from carrito.php
session_start();

// After pressing the button the "isset" func. is going to search for the inputs with the following names:
if (isset($_POST['submitBtn'])) {
    // Set the input values to a variable
    $numeroTarjeta = $_POST['tarjeta'];
    $direccion1 = $_POST['dir1'];
    $direccion2 = $_POST['dir2'];
    $telefono = $_POST['telefono'];
    $total = $_SESSION['total'];
    $idUsuario = 1;
    $metodoPago = $_POST['metodo'];

    // Call the stored procedure to insert
    $insertInfoPago = oci_parse($conn, "begin INSERT_INFOPAGO(:I_NUM_TARJETA, :I_DIR_FACTURACION, :I_DIR_FACTURACION2, :I_TELEFONO, :I_TOTAL, :I_ID_USUARIO, :I_ID_METODOPAGO); end;");

    // Pass the parameters into the stored procedure, Note: You can only assign a variable as a parameter value in the stored procedure, that's the goal of $idUsuario
    oci_bind_by_name($insertInfoPago, ":I_NUM_TARJETA", $numeroTarjeta, 32);
    oci_bind_by_name($insertInfoPago, ":I_DIR_FACTURACION", $direccion1, 32);
    oci_bind_by_name($insertInfoPago, ":I_DIR_FACTURACION2", $direccion2, 32);
    oci_bind_by_name($insertInfoPago, ":I_TELEFONO", $telefono, 32);
    oci_bind_by_name($insertInfoPago, ":I_TOTAL", $total, 32);
    oci_bind_by_name($insertInfoPago, ":I_ID_USUARIO", $idUsuario, 32);
    oci_bind_by_name($insertInfoPago, ":I_ID_METODOPAGO", $metodoPago, 32);

    // Execute de stored procedure
    oci_execute($insertInfoPago);

    // Redirect to "confirmacion.php" after the insert is accomplished
    header('Location:confirmacion.php');
}
?>

<body class="bg-light">
    <!-- Inicio Pruebas -->

    <main class="page payment-page">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Payment</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
                </div>

                <!-- Seccion 1 -->
                <form action="" method="post">
                    <div class="products">
                        <h3 class="title">Checkout</h3>
                        <?php
                        // Fetch the array of the first stored procedure to create a new option for each metodo de pago
                        while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                            // Attributes of the carrito table
                            $cantidadCarrito = $row2['CANTIDAD'];
                            // Attributes of the product table
                            $nombreProducto = $row2['NOMBRE'];
                            $descripcionProducto = $row2['DESCRIPCION'];
                            $precioProducto = $row2['PRECIO'];

                            echo '<div class="item">
                                    <span class="price">₡' . $precioProducto . '</span>
                                        <p class="item-name">' . $nombreProducto . ' (' . $cantidadCarrito . ')' . '</p>
                                        <p class="item-description">' . $descripcionProducto . '</p>
                                </div>';
                        }
                        ?>
                        <?php
                        echo '<div class="total">Total<span class="price">₡' . $_SESSION['total'] . '</span></div>';
                        ?>
                    </div>

                    <!-- Seccion 2 -->
                    <div class="card-details">
                        <h3 class="title text-uppercase">Método de Pago</h3>
                        <div class="row">
                            <div class="form-group col-sm-7">
                                <label for="metodo">Metodo de Pago</label>
                                <select name="metodo" class="form-control">
                                    <?php
                                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        // This is how you bind the values of the array to a variable
                                        $id = $row['ID_METODOPAGO'];
                                        $nombre = $row['NOMBRE'];
                                        // You gotta use this sintax to insert a php variable into a html attribute, useful for dinamic id's
                                        echo '<option value="' . $id . '">' . $nombre . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="">Expiration Date</label>
                                <div class="input-group expiration-date">
                                    <input type="text" class="form-control" placeholder="MM" maxlength="2" minlength="2" required>
                                    <span class="date-separator">/</span>
                                    <input type="text" class="form-control" placeholder="YY" maxlength="2" minlength="2" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="card-number">Card Number</label>
                                <input name="tarjeta" type="text" class="form-control" maxlength="16" minlength="16" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control" placeholder="CVC">
                            </div>
                        </div>
                    </div>

                    <!-- Seccion 3 -->
                    <div class="card-details">
                        <h3 class="title text-uppercase">Información de Facturación</h3>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="card-holder">Dir 1</label>
                                <input name="dir1" type="text" class="form-control" maxlength="30" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Dir 2</label>
                                <div class="input-group expiration-date">
                                    <input name="dir2" type="text" class="form-control" maxlength="30" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-7">
                                <label for="card-number">Telefono</label>
                                <input name="telefono" type="text" class="form-control" maxlength="20" minlength="8" required">
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="cvc">Codigo Postal</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <button name="submitBtn" type="submit" class="btn btn-primary btn-block">Confirmar Compra</button>
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

</body>

<!-- We'll need to free the statments and close the conn here -->