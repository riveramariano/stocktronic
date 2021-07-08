<head>
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<body>

    <?php
    include '../components/header.php';
    include '../conexion.php';

    $curs = oci_new_cursor($conn);
    $sp = oci_parse($conn, "begin GET_PRODUCTOS(:CM, 1); end;");
    oci_bind_by_name($sp, ":CM", $curs, -1, OCI_B_CURSOR);

    oci_execute($sp);
    oci_execute($curs);
    ?>

    <!-- Primer Contenedor -->
    <div class="container-fluid">
        <h3 class="text-center mt-5" style="color:orange">Nuevos</h3>
        <h1 class="text-center mt-2">Componentes</h1>
        <h6 class="text-center mt-3">Desde ₡1500</h6>
        <div class="text-center">
            <button class="mt-3 btn btn-primary rounded-lg">Agregar al Carrito</button>
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
                    $descripcion = $row['DESCRIPCION'];
                    $url = $row['URL_IMAGEN'];
                    $precio = $row['PRECIO'];
                    echo "<div class='product-card mb-5'>
                            <div class='badge'>Nuevo</div>
                            <div class='product-tumb'>
                                <img src='$url' alt=''>
                            </div>
                            <div class='product-details'>
                                <h4><a href=''>$nombre</a></h4>
                                <p>$descripcion</p>
                                <div class='product-bottom-details'>
                                <div class='product-price'>₡$precio</div>
                                <div class='product-links'>
                                    <a href=''><i class='fa fa-heart'></i></a>
                                    <a href=''><i class='fa fa-shopping-cart'></i></a>
                                </div>
                            </div>
                            </div>
                        </div>";
                }
                ?>
            </div>
            <!-- Fin Card -->
        </div>
    </div>

    <?php
    include '../components/footer.php';
    ?>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>

</html>