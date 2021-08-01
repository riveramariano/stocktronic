<?php
session_start();
include 'conexion.php';

if (isset($_POST['btnEntrar'])) {

    $emailusuario = $_POST['email'];
    $passusuario = $_POST['psw'];

    $curs = oci_new_cursor($conn);

    $login = oci_parse($conn, "begin LOGIN(:CM, :email, :passwrd); end;");

    oci_bind_by_name($login, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($login, ":email", $emailusuario, 32);
    oci_bind_by_name($login, ":passwrd", $passusuario, 32);

    oci_execute($login);
    oci_execute($curs);

    $row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS);
    
    $_SESSION['idUsuario'] = $row['ID_USUARIO'];
    $_SESSION['nombreUsuario'] = $row['NOMBRE'];
    $_SESSION['apellidoUsuario'] = $row['APELLIDO1'];
    $_SESSION['idRol'] = $row['ID_ROL'];

    header('Location: pages/inicio.php ');
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
    <link href="images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel=" stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/fonts.css">
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
                    <h1 class="mb-5 text-center heading">Stocktronik</h1>
                    <h6 class="text-center mb-4">Ingresa con tu cuenta de Stocktronik</h6>
                    <div class="form-group">
                        <input type="text" id="email" name="email" placeholder="Correo Electrónico" class="form-control cupertinoup">
                        <input type="password" id="psw" name="psw" placeholder="Contraseña" class="form-control cupertinodown">
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="row justify-content-center my-3 px-5">
                        <button name="btnEntrar" type="submit">ENTRAR
                            <!-- <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#007BFF" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </a> -->
                        </button>

                    </div>

                    <div class="row justify-content-center my-2">
                        <a href="#">
                            <small class="text-muted">¿Olvidaste la contraseña?</small>
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