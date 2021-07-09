<head>
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="../styles/carrito.css" rel="stylesheet" />
</head>

<?php
include '../components/header.php';
include '../conexion.php';

$curs = oci_new_cursor($conn);
$sp = oci_parse($conn, "begin GET_CARRITO(:CM, 1); end;");
oci_bind_by_name($sp, ":CM", $curs, -1, OCI_B_CURSOR);

oci_execute($sp);
oci_execute($curs);
?>

<body class="bg-light">

    <!-- Cart items -->
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-10 col-11 mx-auto">
                <div class="row mt-5 gx-3">

                    <!-- Left side -->
                    <div class="col-md-12 col-lg-8 col-11 mx-auto main-cart mb-lg-0 mb-5 shadow">
                        <h2 class='mt-4 ml-2 font-weight-bold'>Cantidad de Artículos: </h2>
                        <?php
                        while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                            // Atributos carrito
                            $idCarrito = $row['ID_CARRITO'];
                            $cantidadCarrito = $row['CANTIDAD'];
                            $idUsuario = $row['ID_USUARIO'];
                            $idProducto = $row['ID_PRODUCTO'];
                            // Atributos producto
                            $nombreProducto = $row['NOMBRE'];
                            $descripcionProducto = $row['DESCRIPCION'];
                            $urlImagen = $row['URL_IMAGEN'];
                            $precioProducto = $row['PRECIO'];

                            echo "<div class='cart p-4'>
                                    <div class='row'>
                                    <!-- Cart images -->
                                        <div class='col-md-5 col-11 mx-auto bg-light d-flex justify-content-center align-items-center  product-img'>
                                            <img src='$urlImagen' class='img-fluid' alt='cart img' />
                                        </div>
                                    <!-- Cart product details -->
                                    <div class='col-md-7 col-11 mx-auto px-4 mt-2'>
                                        <div class='row'>
                                        <!-- Product name -->
                                            <div class='col-6 card-title'>
                                                <h1 class='mb-4 product-name'>$nombreProducto</h1>
                                                <p class='mb-5'>$descripcionProducto</p>
                                                <br><br>
                                            </div>
                                            <!-- Quantity inc dec -->
                                            <div class='col-6'>
                                                <ul class='pagination justify-content-end set-quantity'>
                                                    <li class='page-item border'>
                                                        <button class='page-link' href='#'><i class='fa fa-minus'></i></button>
                                                    </li>
                                                    <li class='page-item border'>
                                                        <input class='page-link' type='text' name='' value='$cantidadCarrito' id='textbox' />
                                                    </li>
                                                    <li class='page-item border'>
                                                        <button class='page-link' href='#'><i class='fa fa-plus'></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <!-- Remove item and price -->
                                    <div class='row'>
                                        <div class='col-8 d-flex justify-content-between remove'>
                                            <p><i class='fa fa-trash-alt'></i>    REMOVE ITEM</p>
                                        </div>
                                        <div class='col-4 d-flex justify-content-end price-money'>
                                            <h3>₡<span id='itemval'>$precioProducto</span></h3>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                <hr />";
                        }
                        // Libero el cursor y el procedimiento almacenado      
                        oci_free_statement($sp);
                        oci_free_statement($curs);
                        ?>
                    </div>
                    <!-- Right side -->
                    <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                        <div class="rigth_side p-3 shadow bg-white">
                            <h2 class="product_name mb-4">Desgloce Factura:</h2>
                            <?php
                            $curs = oci_new_cursor($conn);
                            $sp = oci_parse($conn, "begin GET_CARRITO(:CM, 1); end;");
                            oci_bind_by_name($sp, ":CM", $curs, -1, OCI_B_CURSOR);

                            oci_execute($sp);
                            oci_execute($curs);

                            while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                // Atributos carrito
                                $idCarrito = $row['ID_CARRITO'];
                                $cantidadCarrito = $row['CANTIDAD'];
                                $idUsuario = $row['ID_USUARIO'];
                                $idProducto = $row['ID_PRODUCTO'];
                                // Atributos producto
                                $nombreProducto = $row['NOMBRE'];
                                $descripcionProducto = $row['DESCRIPCION'];
                                $urlImagen = $row['URL_IMAGEN'];
                                $precioProducto = $row['PRECIO'];

                                $total = $precioProducto * $cantidadCarrito;

                                echo "<div class='price-indiv d-flex justify-content-between'>
                                        <p>$nombreProducto</p>
                                        <p>+ ₡<span>$total</span></p>
                                    </div>";
                            }
                            // Cierra la conexión
                            oci_close($conn);
                            ?>
                            <div class="price-indiv d-flex justify-content-between">
                                <p>IVA</p>
                                <p>+ ₡4000</p>
                            </div>
                            <hr />
                            <div class="total-amt d-flex justify-content-between font-weight-bold">
                                <p>Monto Total (Incluye Impuestos)</p>
                                <p>₡<span id="total_cart_amt">50.00</span></p>
                            </div>
                            <button class="btn btn-primary text-uppercase">Comprar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Cart items -->
</body>