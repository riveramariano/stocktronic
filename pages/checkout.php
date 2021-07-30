<head>
    <title>Compras - Stocktronic</title>
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
                <form id="formCheckout" action="">
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
                                <select id="selectMet" name="metodo" class="form-control">
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
                                <label id="fecVal">Fecha de Expiración</label>
                                <div class="input-group expiration-date">
                                    <input id="mm" type="text" class="form-control" placeholder="MM" maxlength="2">
                                    <span class="date-separator">/</span>
                                    <input id="yy" type="text" class="form-control" placeholder="YY" maxlength="2">
                                </div>
                            </div>
                            <div class="form-group col-sm-7">
                                <label id="tarjetaVal">Número de Tarjeta</label>
                                <input id="tarjeta" name="tarjeta" type="text" class="form-control" maxlength="16">
                            </div>
                            <div class="form-group col-sm-5">
                                <label id="cvcVal">Código de Seguridad</label>
                                <input id="cvc" type="text" class="form-control" placeholder="CVC" maxlength="3">
                            </div>
                        </div>
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
                            <div class="form-group col-sm-6">
                                <label id="telVal">Teléfono</label>
                                <input id="tel" name="telefono" type="text" class="form-control" maxlength="8">
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="codVal">Código Postal</label>
                                <input id="cod" type="text" class="form-control" maxlength="10">
                            </div>
                            <div class="form-group col-sm-12">
                                <button id="btnBuy" name="submitBtn" type="button" class="btn btn-primary btn-block">Confirmar Compra</button>
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

    <!-- Add sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/sweetalert2.js"></script>

    <script src="../scripts/validacionForm.js"></script>

</body>

<!-- We'll need to free the statments and close the conn here -->