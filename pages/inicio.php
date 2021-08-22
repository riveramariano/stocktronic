<head>
    <link href="../styles/catalogo.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
// include '../scripts/procedures.php';
// include '../components/validator.php';
include '../pages/catalogoSP/getProductos.php';
include '../components/header.php';
$i = 0;
?>

<body>
    <div class="container header-top">
        <h1 class="text-center main-title">
            Los productos que amas <br /> a un clic de distancia
        </h1>
        <!-- <h4 class="text-center mt-4 main-subtitle" style="color: gray">
            No dudes en consultarnos
        </h4> -->
        <div class='col text-center'>
            <a href='#seccionProductos' class="cupertino-link">Conocer productos</a>
        </div>
    </div>

    <!-- Carrusel -->
    <div id="carouselExampleControls" class="carousel slide carousel-fade section-top" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/banner-01.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/banner-02.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/banner-03.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <section class="py-5 product-section" id="seccionProductos">
        <div class="container px-4 px-lg-5 mt-4">
            <h1 class="text-center mt-5 main-title">Explore nuestros productos</h1>
            <div class="row gx-4 gx-lg-5 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 mt-5 justify-content-center">
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
    <script src="../scripts/carritoSP.js"></script>
    <script src="../scripts/carritoSA.js"></script>
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