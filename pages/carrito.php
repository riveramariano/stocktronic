<head>
    <title>Carrito - Stocktronic</title>
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="../styles/carrito.css" rel="stylesheet" />
</head>

<?php
// Import header.php and conexion.php
include '../components/header.php';
$idUsuario = $_SESSION['idUsuario'];
include '../conexion.php';

$total = 0;
$montoTotal = 0;

// This first set of GET_CARRITOS is called for the validation
$curs = oci_new_cursor($conn);
$sp = oci_parse($conn, "begin GET_CARRITOS(:CM, :ID_USUARIO); end;");
oci_bind_by_name($sp, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($sp, ":ID_USUARIO", $idUsuario, 32);
oci_execute($sp);
oci_execute($curs);

// This second set is to print the values
$curs2 = oci_new_cursor($conn);
$sp2 = oci_parse($conn, "begin GET_CARRITOS(:CM, :ID_USUARIO); end;");
oci_bind_by_name($sp2, ":CM", $curs2, -1, OCI_B_CURSOR);
oci_bind_by_name($sp2, ":ID_USUARIO", $idUsuario, 32);
oci_execute($sp2);
oci_execute($curs2);

?>

<!-- In the cart we'll need to add some fonts -->

<body>
    <?php
    // If $validation is true, then is something in the cart
    if (($validation = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS))) {
        echo '<div class="container-fluid mb-5 header-top">
            <div class="row">
                <div class="col-md-10 col-11 mx-auto">
                    <div class="row mt-5 gx-4">
                        <!-- Left side -->
                        <div class="col-md-12 col-lg-8 col-10 mx-auto main-cart mb-lg-0 mb-5 shadow">
                            <h2 class="mt-4 ml-2 font-weight-bold">Cantidad de Artículos: </h2>';
        // Fetch the array to create card for each product in the user cart
        while (($row = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
            // Attributes of the carrito table
            $idCarrito = $row['ID_CARRITO'];
            $cantidadCarrito = $row['CANTIDAD'];
            $idUsuario = $row['ID_USUARIO'];
            $idProducto = $row['ID_PRODUCTO'];
            // Attributes of the product table
            $nombreProducto = $row['NOMBRE'];
            $descripcionProducto = $row['DESCRIPCION'];
            $urlImagen = $row['URL_IMAGEN'];
            $precioProducto = $row['PRECIO'];
            // Create a card for each product
            echo '<div class="cart p-4"> 
                                        <div class="row">
                                            <!-- Cart images -->
                                            <div class="col-md-5 col-11 mx-auto bg-light d-flex justify-content-center align-items-center product-img">
                                                <img src="' . $urlImagen . '" class="img-fluid" alt="cart img" />
                                            </div>
                                        <!-- Cart product details -->
                                        <div class="col-md-7 col-11 mx-auto px-4 mt-2">
                                            <div class="row">
                                                <!-- Product name -->
                                                <div class="col-6 card-title">
                                                    <h1 class="mb-4 product-name">' . $nombreProducto . '</h1>
                                                    <p class="mb-5">' . $descripcionProducto . '</p>
                                                    <br><br>
                                                </div>
                                            <!-- Quantity inc dec -->
                                            <div class="col-6">
                                                <ul class="pagination justify-content-end set-quantity">
                                                    <li class="page-item border">
                                                        <button type="button" onclick="minusCart(\'' . $nombreProducto . '\')" 
                                                        data-id="' . $idCarrito . '" data-filter="' . $cantidadCarrito . '" class="page-link btnMinus">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </li>
                                                    <li class="page-item border">
                                                        <input class="page-link itemval" type="text" value="' . $cantidadCarrito . '" disabled />
                                                    </li>
                                                    <li class="page-item border">
                                                        <button type="button" onclick="plusCart(\'' . $nombreProducto . '\')" 
                                                        data-id="' . $idCarrito . '" data-filter="' . $cantidadCarrito . '" class="page-link btnPlus"> 
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <!-- Remove item and price -->
                                    <div class="row">
                                        <div class="col-8 d-flex justify-content-between remove">
                                            <div class="product-links">
                                                <button data-id="' . $idCarrito . '" type="button" class="btnDelete" 
                                                onclick="deleteCart(\'' . $nombreProducto . '\')">
                                                    <i class="fa fa-trash"></i> Eliminar Producto
                                                </button> 
                                            </div>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end price-money">
                                            <h3>₡<span id="itemval">' . $precioProducto . '</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />';
        }
        // Free the cursor and the stored procedure to call it one more time
        oci_free_statement($sp);
        oci_free_statement($curs);
        echo '</div>
                    <!-- Right side -->
                    <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                        <div class="rigth_side p-3 shadow bg-white">
                            <h2 class="product_name mb-4">Desgloce Factura:</h2>';

        // Call a stored procedure that returns the list of items inside the cart
        $getCarritos = oci_parse($conn, "begin GET_CARRITOS(:CM, :ID_USUARIO); end;");
        // Create the memory cursor to iterate through the stored procedure
        $curs = oci_new_cursor($conn);

        // Bind the memory cursor and the user id into the stored procedure
        oci_bind_by_name($getCarritos, ":CM", $curs, -1, OCI_B_CURSOR);
        oci_bind_by_name($getCarritos, ":ID_USUARIO", $idUsuario, 32);

        // Execute the stored procedure and the memory cursor
        oci_execute($getCarritos);
        oci_execute($curs);

        // The reason of calling the same stored procedure one more time is to dinamicly add the prices to the factura section
        while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
            // Catch the table values into variables
            $idCarrito = $row['ID_CARRITO'];
            $cantidadCarrito = $row['CANTIDAD'];
            $idUsuario = $row['ID_USUARIO'];
            $idProducto = $row['ID_PRODUCTO'];
            $nombreProducto = $row['NOMBRE'];
            $descripcionProducto = $row['DESCRIPCION'];
            $urlImagen = $row['URL_IMAGEN'];
            $precioProducto = $row['PRECIO'];

            // Multiply the product price by the quantity to get the total of each product
            $total = $precioProducto * $cantidadCarrito;
            $montoTotal = $montoTotal + $total;

            // Print the results into the right bar
            echo "<div class='price-indiv d-flex justify-content-between'>
                                        <p>$nombreProducto</p>
                                        <p>+ ₡<span>$total</span></p>
                                    </div>";
        }
        echo '<hr />
                            <div class="total-amt d-flex justify-content-between font-weight-bold">
                                <p>Monto Total</p>';

        // Put the total amount of the cart inside a variable session
        $_SESSION['total'] = $montoTotal;
        // Print the total amount into the right bar
        echo '<p>₡<span id="total_cart_amt">' . $montoTotal . '</span></p>';


        echo '</div>
                            <!-- This button will only redirect to checkout.php -->
                            <a href="checkout.php">
                                <button class="btn btn-primary text-uppercase">Comprar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    } else {
        echo '<div id="outer" class="container">
                <div id="inner">
                    <img class="img-responsive" src="../images/isotipoDark.svg" alt="logo" />
                    <h1 class="text-center mt-3">Carrito de Compras</h1>
                    <p class="text-center">No has agregado ningún artículo</p>
                    <a class="d-flex justify-content-center fs" href="inicio.php">Empecemos!</a>
                </div>
            </div>';
    }
    ?>

    <!-- Add sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/carritoSA.js"></script>

    <!-- This one call the ajax to add carrito -->
    <script src="../scripts/carritoSP.js"></script>

</body>

<?php
// The final thing we do is close the connection with Oracle
oci_close($conn);
?>