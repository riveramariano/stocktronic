<head>
    <link href="../styles/catalogo.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
// include '../scripts/procedures.php';
// include '../components/validator.php';
include '../pages/catalogoSP/getProductos.php';
include '../pages/catalogoSP/getLowestPrice.php';
include '../components/header.php';

$categoria = $_GET['q'];

// $i = 0;
?>

<body>
    <?php
    $dataCategoria = get_lowest_price($conn, $categoria);
    $infoCategoria = oci_fetch_array($dataCategoria, OCI_ASSOC + OCI_RETURN_NULLS);
    $lowestPrice = $infoCategoria['PRECIO'];
    $tipo = $infoCategoria['TIPO'];

    echo "<h3 class='text-center header-top subtitle' style='color:orange'>Novedades en:</h3>
            <h1 class='text-center mt-2 main-title'>$tipo</h1>
            <h6 class='text-center mt-3 main-subtitle'>Desde ₡$lowestPrice</h6>
            <div class='col text-center'>
                <a href='#productos'><button type='button' class='mt-3 btn btn-primary rounded-lg'>Conocer Productos</button></a>
            </div>
            <div class='row justify-content-center'>
                <div class='text-center'>
                    <img class='img-fluid' src='../images/imagen-$categoria.png' width='550' height='auto' />
                </div>
            </div>";
    ?>

    <!-- Product Secction -->
    <section id="productos" class="py-5" style="background-color: #f9f9fa; padding-top: 1rem">
        <div class="container px-4 px-lg-5 mt-4">
            <h1 class="text-center mt-5">Explore nuestros Productos</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 mt-5 justify-content-center">
                <?php
                $data = get_products($conn, $categoria);
                while (($row = oci_fetch_array($data, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                    $id = $row['ID_PRODUCTO'];
                    $nombre = $row['NOMBRE'];
                    $descripcion = $row['DESCRIPCION'];
                    $url = $row['URL_IMAGEN'];
                    $precio = $row['PRECIO'];
                    // $i = $i + 1;
                    // I divided the card into two echo's only to create dinamic id's, if you find an easier way to do it, go ahead and change it.
                    echo "<div class='product-card mb-5'>
                            <div class='badge'>Nuevo</div>
                            <div class='product-tumb'>
                                <img src='$url' alt='$nombre'>
                            </div>
                            <div class='product-details'>
                                <h4><a id='productName$id' href='#'>$nombre</a></h4>
                                <p>$descripcion</p>
                                <div class='product-bottom-details'>
                                <div class='product-price'>₡$precio</div>";
                    // I created a dinamic button name and id to create a func. for each one, the func's are on scripts/sweetalert2.js. Could you change that file name? Thx
                    echo '<div class="product-links">
                                        <button data-id="' . $id . '" type="button" class="btnAdd" 
                                        onclick="addCart(\'' . $nombre . '\')">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </section>

    < <?php
        include '../components/footer.php';
        ?> <!-- Add sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../scripts/carritoSA.js"></script>

        <!-- This one call the ajax to add carrito -->
        <script src="../scripts/carritoSP.js"></script>

        <!-- Usuful scripts? I think we could delete some, try deleting them one by one hehe -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

<!-- We'll need to free the statments and close the conn here -->