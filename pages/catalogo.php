<?php
// Imports
include '../conexion.php';
include '../scripts/procedures.php';

$categoria = $_GET['q'];
$dataCategoria = get_categoria($conn, $categoria);
$infoCategoria = oci_fetch_array($dataCategoria, OCI_ASSOC + OCI_RETURN_NULLS);
$tipo = $infoCategoria['TIPO'];
$i = 0;
?>

<head>
    <title><?php echo "$tipo - Stocktronic" ?></title>
    <link href="../styles/catalogo.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
include '../components/header.php';
?>

<body>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-4">
            <h1 class="text-center mt-5">Explore nuestros Productos</h1>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 mt-5 justify-content-center">
                <?php
                $data = get_products($conn, $categoria);
                while (($row = oci_fetch_array($data, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                    $id = $row['ID_PRODUCTO'];
                    $nombre = $row['NOMBRE'];
                    $hola = 'hola';
                    $descripcion = $row['DESCRIPCION'];
                    $url = $row['URL_IMAGEN'];
                    $precio = $row['PRECIO'];
                    $i = $i + 1;
                    // I divided the card into two echo's only to create dinamic id's, if you find an easier way to do it, go ahead and change it.
                    echo "<div class='product-card mb-5'>
                            <div class='badge'>Nuevo</div>
                            <div class='product-tumb'>
                                <img src='$url' alt=''>
                            </div>
                            <div class='product-details'>
                                <h4><a id='productName$i' href='#'>$nombre</a></h4>
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

    <?php
    include '../components/footer.php';
    ?>

    <!-- Add sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/sweetalert2.js"></script>

    <!-- This one call the ajax to add carrito -->
    <script src="../scripts/addCarrito.js"></script>

    <!-- Usuful scripts? I think we could delete some, try deleting them one by one hehe -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

<!-- We'll need to free the statments and close the conn here -->