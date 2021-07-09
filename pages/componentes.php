<head>
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<body>

    <?php
    include '../components/header.php';
    include '../conexion.php';

    $curs = oci_new_cursor($conn);
    $getProductos = oci_parse($conn, "begin GET_PRODUCTOS(:CM, 1); end;");
    oci_bind_by_name($getProductos, ":CM", $curs, -1, OCI_B_CURSOR);

    oci_execute($getProductos);
    oci_execute($curs);

    // Call function to insert product into user cart
    // if (isset($_POST['btn-add'])) {
    //     $insertProducto = oci_parse($conn, "begin INSERT_CARRITO(1, 1, 1); end;");
    //     oci_execute($insertProducto);
    // }

    ?>

    <!-- Primer Contenedor -->
    <div class="container-fluid">
        <h3 class="text-center mt-5" style="color:orange">Nuevos</h3>
        <h1 class="text-center mt-2">Componentes</h1>
        <h6 class="text-center mt-3">Desde ₡1500</h6>
        <div class="col text-center">
            <button type="button" class="mt-3 btn btn-primary rounded-lg">Agregar al Carrito</button>
        </div>

        <!-- Imagen Producto -->
        <div class="row justify-content-center minus-mt">
            <div class="text-center">
                <img class="img-fluid" src="../images/componentes.png" />
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5" style="background-color: #f9f9fa; padding-top: 1rem">
        <h1 class="text-center mt-4">Nuestros Componentes:</h1>
        <div class="container pt-5">
            <!-- Card -->
            <div class="row">
                <?php
                while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                    $id = $row['ID_PRODUCTO'];
                    $nombre = $row['NOMBRE'];
                    $hola = 'hola';
                    $descripcion = $row['DESCRIPCION'];
                    $url = $row['URL_IMAGEN'];
                    $precio = $row['PRECIO'];
                    $incrementador = $incrementador + 1;
                    echo "<div class='product-card mb-5'>
                            <div class='badge'>Nuevo</div>
                            <div class='product-tumb'>
                                <img src='$url' alt=''>
                            </div>
                            <div class='product-details'>
                                <h4><a id='productName$incrementador' href='#'>$nombre</a></h4>
                                <p>$descripcion</p>
                                <div class='product-bottom-details'>
                                <div class='product-price'>₡$precio</div>";
                                echo '<form method="post">
                                        <div class="product-links">
                                            <button type="submit" name="btn-add'.$incrementador.'" id="cart'.$incrementador.'" 
                                            onclick="addCart(\''.$nombre. '\', 1, 1, \'' . $id . '\')">
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
            <!-- Fin Card -->
        </div>
    </div>

    <?php
    include '../components/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    // AGREGAR SWEETALERT2
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/sweetalert2.js"></script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>

</html>