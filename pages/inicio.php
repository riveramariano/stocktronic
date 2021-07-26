<?php
include '../components/header.php';
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

    <!-- Anuncios -->
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 4rem">
            <div class="col-6 card text-white bg-dark mr-3" style="max-width: 31rem">
                <div class="card-header">Item 1</div>
                <div class="card-body">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Nos puedes contactar en cuarquier momento</p>
                </div>
            </div>
            <div class="col-6 card text-white bg-info" style="max-width: 31rem">
                <div class="card-header">Item 2</div>
                <div class="card-body">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Que tenemos free shipping</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mostrar Producto -->
    <div class="container-fluid">
        <div class="row mt-3 justify-content-center">
            <div class="col-12 card text-white bg-dark mr-3" style="max-width: 62rem">
                <div class="card-header">Item 1</div>
                <div class="card-body">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Aqui mostramos un producto</p>
                </div>
            </div>
        </div>
    </div>

    <!-- La seccion 04 es la de mostrar productos en tendencia -->
    <h1 class="text-center mt-5">Explore nuestros Productos</h1>
    <!-- Cards 01 -->
    <div class="container pt-5" style="max-width: 65rem">
        <div class="row">
            <!-- Primera Card -->
            <div class="col-lg-4 pb-5">
                <div class="card ho">
                    <div class="card-body">
                        <h5 class="card-title text-center">Impresora 3D</h5>
                    </div>
                    <div class="view overlay">
                        <img class="card-img-top" src="images/3dprinter.png" />
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Fin Primera Card -->

            <!-- Segunda Card -->
            <div class="col-lg-4 pb-5">
                <div class="card ho">
                    <div class="card-body">
                        <h5 class="card-title text-center">Impresora 3D</h5>
                    </div>
                    <div class="view overlay">
                        <img class="card-img-top" src="images/3dprinter.png" />
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Fin Segunda Card -->

            <!-- Tercera Card -->
            <div class="col-lg-4 pb-5">
                <div class="card ho">
                    <div class="card-body">
                        <h5 class="card-title text-center">Impresora 3D</h5>
                    </div>
                    <div class="view overlay">
                        <img class="card-img-top" src="images/3dprinter.png" />
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Fin Tercera Card -->

            <div class="col-lg-4 pb-5">
                <div class="card ho">
                    <div class="card-body">
                        <h5 class="card-title text-center">Impresora 3D</h5>
                    </div>
                    <div class="view overlay">
                        <img class="card-img-top" src="images/3dprinter.png" />
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pb-5">
                <div class="card ho">
                    <div class="card-body">
                        <h5 class="card-title text-center">Impresora 3D</h5>
                    </div>
                    <div class="view overlay">
                        <img class="card-img-top" src="images/3dprinter.png" />
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pb-5">
                <div class="card ho">
                    <div class="card-body">
                        <h5 class="card-title text-center">Impresora 3D</h5>
                    </div>
                    <div class="view overlay">
                        <img class="card-img-top" src="images/3dprinter.png" />
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '../components/footer.php';
    ?>

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