<head>
    <link href="../styles/catalogo.css" rel="stylesheet" />
</head>

<?php
// Import header.php and conexion.php
include '../components/header.php';
include '../conexion.php';

// Declare a variable to generate dinamic id's
$i = 0;

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

// Call the stored procedure to bring all products with id_categoria = 1
$getProductos = oci_parse($conn, "begin GET_PRODUCTOS(:CM, 1); end;");

// Pass the memory cursor into the stored procedure, Note: Idk what -1 does, but leave it there hehe
oci_bind_by_name($getProductos, ":CM", $curs, -1, OCI_B_CURSOR);

// Execute the stored procedured and the memory cursor
oci_execute($getProductos);
oci_execute($curs);
?>

<head>
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<body>
    <!-- First container -->
    <div class="container-fluid">
        <h3 class="text-center mt-5" style="color:orange">Nuevos</h3>
        <h1 class="text-center mt-2">Componentes</h1>
        <h6 class="text-center mt-3">Desde ₡1500</h6>
        <div class="col text-center">
            <button type="button" class="mt-3 btn btn-primary rounded-lg">Agregar al Carrito</button>
        </div>
        <div class="row justify-content-center minus-mt">
            <div class="text-center">
                <img class="img-fluid" src="../images/componentes.png" />
            </div>
        </div>
    </div>

    <!-- Second container -->
    <div class="container-fluid mt-5" style="background-color: #f9f9fa; padding-top: 1rem">
        <h1 class="text-center mt-4">Nuestros Componentes:</h1>
        <div class="container pt-5">
            <!-- Product card -->
            <div class="row">
                <?php
                // Fetch the array to create a new card for each product with id_categoria = 1
                while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                    // This is how you bind the values of the array to a variable
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
                    echo '<form method="post">
                                        <div class="product-links">
                                            <button type="submit" name="btn-add' . $i . '" id="cart' . $i . '" 
                                            onclick="addCart(\'' . $nombre . '\', 1, 1, \'' . $id . '\')">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    // Import the footer.php
    include '../components/footer.php';
    ?>

    <!-- Usuful scripts? I think we could delete some, try deleting them one by one hehe -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Add sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/sweetalert2.js"></script>

    <!-- Idk what this does, I think is for the navbar -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>

<!-- We'll need to free the statments and close the conn here -->