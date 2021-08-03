<head>
    <link href="../styles/fonts.css" rel="stylesheet" />
    <link href="../styles/catalogo.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
include '../components/header.php';
include '../scripts/procedures.php';
include '../conexion.php';
// include '../components/validator.php'; // <- Revisar funcionalidad
$i = 0;
?>

<body>
    <div class=" container-fluid">
        <h1 class="text-center" style="margin-top: 8rem">
            Todo lo que ama de nuestra tienda <br /> a un clic de su alcance.
        </h1>
        <h4 class="text-center mt-4" style="color: gray">
            No dudes en consultarnos cualquier cosa
        </h4>
    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-4">
            <h1 class="text-center mt-5">Explore nuestros Productos</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 mt-5 justify-content-center">
                <?php
                $data = get_products_random($conn);
                while (($row = oci_fetch_array($data, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                    $i = $i + 1;
                    $productoNombre = $row['NOMBRE'];
                    $productoPrecio = $row['PRECIO'];
                    $productoID = $row['ID_PRODUCTO'];
                    $productoImagen = $row['URL_IMAGEN'];
                    $productoDescripcion = $row['DESCRIPCION'];
                    $btnCarrito = '<button data-id="' . $productoID . '" type="button" class="btnAdd"
                                        onclick="addCart(\'' . $productoNombre . '\')">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>';
                    echo "<div class='product-card mb-5'>
                            <div class='badge'>Nuevo</div>
                            <div class='product-tumb'>
                                <img src='$productoImagen' alt=''>
                            </div>
                            <div class='product-details'>
                                <h4><a id='productName$i' href='#'>$productoNombre</a></h4>
                                <p>$productoDescripcion</p>
                                <div class='product-bottom-details'>
                                <div class='product-price'>₡$productoPrecio</div><div class='product-links'>
                                    $btnCarrito
                                </div>
                                </div>
                            </div>
                        </div>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    include '../components/footer.php';
    ?>
    <script src="../scripts/proceduresCarrito.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>

</html>