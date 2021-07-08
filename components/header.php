<?php
echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Stocktronic</title>
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel=" stylesheet" />
    <link href="../styles/simple-sidebar.css" rel="stylesheet" />
    <link href="../styles/navbar.css" rel="stylesheet" />
    <link href="../styles/index.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <nav class=" navbar navbar-expand-md navbar-dark border-bottom">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapse_target">
            <ul class="navbar-nav list-inline mx-auto justify-content-center">
                <a class="navbar-brand mb-2 mr-5" href="/stocktronic">
                    <img src="../images/isotipo.svg" width="20" height="20" />
                </a>
                <li class="nav-item mt-1 mr-5">
                    <a class="nav-link" href="/stocktronic/pages/componentes.php">Componente</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="nav-link" href="/stocktronic/pages/herramientas.php">Herramienta</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="nav-link" href="/stocktronic/pages/impresoras.php">Impresora 3D</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="nav-link" href="/stocktronic/pages/cortadores.php">Cortadores Láser</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="nav-link" href="/stocktronic/pages/raspberry.php">Raspberry Pi</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="nav-link" href="/stocktronic/pages/wireless.php">Wireless</a>
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link" href="/stocktronic/pages/carrito.php">CART</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    
<body>';
?>
