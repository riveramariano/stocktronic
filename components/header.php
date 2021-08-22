<?php
session_start();

if (is_null($_SESSION['idUsuario'])) {
    header('Location: ../index.php ');
}

// Get the user id from the session
$idUsuario = $_SESSION['idUsuario'];
$nombreUsuario = $_SESSION['nombreUsuario'];
$apellidoUsuario = $_SESSION['apellidoUsuario'];
$idRol = $_SESSION['idRol'];

include '../conexion.php';
// This first set of GET_CARRITOS is called for the validation
$curs = oci_new_cursor($conn);
$getCarritoCount = oci_parse($conn, "begin GET_CARRITO_COUNT(:CM, :ID_USUARIO); end;");
oci_bind_by_name($getCarritoCount, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getCarritoCount, ":ID_USUARIO", $idUsuario, 32);
oci_execute($getCarritoCount);
oci_execute($curs);

$count = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS);
$cantidadProductos = $count['COUNT(*)'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stocktronic</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../styles/simple-sidebar.css" rel="stylesheet" />
    <link href="../styles/index.css" rel="stylesheet" />
    <link href="../styles/newFonts.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark border-bottom fixed-top">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapse_target">
            <ul class="navbar-nav list-inline mx-auto justify-content-center">
                <li class="nav-item mt-1 mr-5">
                    <a class="navbar-brand" href="/stocktronic/pages/inicio.php">
                        <img src="../images/isotipo.svg" width="20" height="20" />
                    </a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="header-link" href="/stocktronic/pages/catalogo.php?q=1">Componentes</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="header-link" href="/stocktronic/pages/catalogo.php?q=2">Herramientas</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="header-link" href="/stocktronic/pages/catalogo.php?q=3">Impresoras 3D</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="header-link" href="/stocktronic/pages/catalogo.php?q=4">Cortadores Láser</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="header-link" href="/stocktronic/pages/catalogo.php?q=5">Raspberry Pi</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="header-link" href="/stocktronic/pages/catalogo.php?q=6">Inalámbricos</a>
                </li>
                <li class="nav-item mt-1 mr-5">
                    <a class="header-link" href="/stocktronic/pages/carrito.php"><i class="fa fa-shopping-cart"></i>
                        <?php if ($cantidadProductos > 0) {
                            echo ' (' . $cantidadProductos . ')';
                        }
                        ?></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn border border-light text-light btn-sm dropdown-toggle rounded" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item font-weight-bold" href="#"><?php echo $nombreUsuario . '     ' . $apellidoUsuario ?></a>
                            <a class="dropdown-item" href="/stocktronic/pages/historial.php">Historial</a>
                            <?php
                            if ($idRol == 1 || $idRol == 2) {
                                echo '<a class="dropdown-item" href="/stocktronic/pages/tablaProductos.php">Tabla Productos</a>';
                                echo '<a class="dropdown-item" href="/stocktronic/pages/tablaEntregas.php">Tabla Entregas</a>';
                            }
                            if ($idRol == 1) {
                                echo '<a class="dropdown-item" href="/stocktronic/pages/tablaUsuarios.php">Tabla Usuarios</a>';
                                echo '<a class="dropdown-item" href="/stocktronic/pages/tablaErrores.php">Tabla Errores</a> ';
                            }
                            ?>
                            <div class="dropdown-divider"></div>
                            <a id="logout" class="dropdown-item" style='color:red'>Cerrar Sesión</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/logout.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>