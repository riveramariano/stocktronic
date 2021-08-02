<?php
session_start();
include 'conexion.php';
include './scripts/procedures.php';

if (isset($_POST['btnEntrar'])) {
    login($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Stocktronic</title>
    <!-- <link rel="stylesheet" href="styles/fonts.css"> -->
    <link rel="stylesheet" href="styles/newFonts.css">
    <link href="images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel=" stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.8.2/css/all.css' />
    <!-- Google Fonts -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap' />
    <!-- Bootstrap core CSS -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css' rel='stylesheet' />
    <!-- Material Design Bootstrap -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css' rel='stylesheet' />
</head>

<body>

    <form method="POST">
        <div class="container px-4 py-5 mx-auto margenarriba">
            <div class="row justify-content-center my-auto">
                <div class="col-md-auto col-auto col-sm-auto my-5 mycenter">
                    <div class="row justify-content-center px-3 mb-3">
                        <!-- Aqui va el logo -->
                        <img id="logo" src="images/isotipoDark.svg" class="fillsvg">
                    </div>
                    <h1 class="mb-4 mt-3 text-center heading">Stocktronik</h1>
                    <h3 class="text-center mb-3">Ingresa con tu cuenta de Stocktronik</h3>
                    <div class="form-group">
                        <input type="text" id="email" name="email" placeholder="Correo Electrónico" class="form-control cupertinoup">
                        <input type="password" id="psw" name="psw" placeholder="Contraseña" class="form-control cupertinodown">
                    </div>

                    <div class="row justify-content-center my-3 px-5">
                        <div class="product-links">
                            <button name="btnEntrar" type="submit">
                                <i class="fas fa-chevron-circle-right fa-2x mt-3"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row justify-content-center my-2">
                        <a href="#">
                            <small>¿Olvidaste la contraseña?</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <?php
    oci_close($conn);
    ?>

</body>

</html>