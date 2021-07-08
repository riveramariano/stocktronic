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
        <h1 class="text-center" style="margin-top: 8rem;">Ultima Tecnologia</h1>
        <h1 class="text-center">Desde ₡1500</h1>
        <div class="text-center">
            <button class="mt-3 btn btn-dark">Agregar al Carrito</button>
        </div>

        <!-- Imagen Producto -->
        <div class="row justify-content-center" style="margin-top: 4rem;">
            <div class="col-12 card text-white bg-dark mr-3" style="max-width: 31rem;">
                <div class="card-header">Agregar Motor</div>
                <div class="card-body">
                    <h5 class="card-title">Imagen</h5>
                    <p class="card-text">Nos puedes contactar en cuarquier momento</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Segundo Contenedor -->
    <div class="container-fluid" style="background-color: #f9f9fa; padding-top: 1rem; margin-top: 5rem;">
        <h1 class="text-center" style="margin-top: 5rem;">Nuestros Componentes:</h1>
        <!-- Catalogo Componentes -->
        <div class="container pt-5" style="max-width: 65rem">
            <!-- Primera Card -->
            <div class="row">
                <?php
                while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                    $id = $row['ID_PRODUCTO'];
                    $nombre = $row['NOMBRE'];
                    $url = $row['URL_IMAGEN'];
                    $precio = $row['PRECIO'];
                    echo "
                    <div class='col-lg-4 pb-5'>
                        <div class='card ho'>
                            <div class='card-body'>
                                <h5 class='card-title text-center black-text'>$nombre</h5>
                                <h6 class='card-title text-center black-text'>₡$precio</h6>
                            </div>
                        <div class='view overlay'>
                            <img class='card-img-top' src='$url' height='300' />
                            <a class='d-flex justify-content-center' href='#'>
                                <button type='submit' class='mt-3 btn btn-dark'>Comprar</button
                            </a>
                            
                        </div>
                        <br>
                        </div>
                    </div>";
                }
                ?>
                <!-- Fin Primera Card -->
            </div>
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