<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Motores</title>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../css/simple-sidebar.css" rel="stylesheet" />
    <link href="../../css/navbar.css" rel="stylesheet" />
</head>

<body>
    <nav class="
        navbar navbar-height navbar-expand-lg navbar-dark
        bg-dark
        border-bottom
      ">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav list-inline mx-auto justify-content-center">
                <li class="nav-item list-inline-item mr-5">
                    <a class="nav-link" href="../../index.html">LOGO</a>
                </li>
                <li class="nav-item list-inline-item mr-5">
                    <a class="nav-link" href="#">3D Printers</a>
                </li>
                <li class="nav-item list-inline-item mr-5">
                    <a class="nav-link" href="#">LEDs</a>
                </li>
                <li class="nav-item list-inline-item mr-5">
                    <a class="nav-link" href="#">Motors</a>
                </li>
                <li class="nav-item list-inline-item mr-5">
                    <a class="nav-link" href="#">Sensors</a>
                </li>
                <li class="nav-item list-inline-item mr-5">
                    <a class="nav-link" href="#">Wireless</a>
                </li>
                <li class="nav-item list-inline-item mr-5">
                    <a class="nav-link" href="#">CART</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Primer Contenedor -->
    <div class="container-fluid">
        <h1 class="text-center" style="margin-top: 8rem;">Ultima Tecnologia</h1>
        <h1 class="text-center">Desde ₡5000</h1>
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
        <h1 class="text-center" style="margin-top: 5rem;">Nuestros motores:</h1>
        <!-- Catalogo Motores -->
        <div class="row mt-5 justify-content-center">
            <div class="col-4 card bg-light mr-3 mb-5" style="max-width: 18rem;">
                <div class="card-header text-center">Motor 1</div>
                <div class="card-body">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
            <div class="col-4 card bg-light mr-3 mb-5" style="max-width: 18rem;">
                <div class="card-header text-center">Motor 2</div>
                <div class="card-body">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
            <div class="col-4 card bg-light mb-5" style="max-width: 18rem;">
                <div class="card-header text-center">Motor 3</div>
                <div class="card-body">
                    <h5 class="card-title">Dark card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>

</html>