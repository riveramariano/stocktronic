<head>
    <link href="../styles/historial.css" rel="stylesheet" />
    <link href="../styles/modal.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<?php
session_start();
$idUsuario = $_SESSION['idUsuario'];
$nombreUsuario = $_SESSION['nombreUsuario'];

// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

// Get id
$idOrden = "";

// Call the stored procedure to bring all metodos de pago
$getOrden = oci_parse($conn, "begin GET_ORDENES(:CM, :ID_USUARIO); end;");

// Pass the memory cursor into the stored procedure, Note: Idk what -1 does, but leave it there hehe
oci_bind_by_name($getOrden, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getOrden, ":ID_USUARIO", $idUsuario, 32);

// Execute the stored procedured and the memory cursor
oci_execute($getOrden);
oci_execute($curs);

?>

<body>

    <div class="wrapper rounded mt-5">
        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start">
            <a class="navbar-brand" href="#">Ordenes<p class="text-muted pl-1">Bienvenido a tú historial de ordenes <?php echo $nombreUsuario ?></p> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <ul class="nav nav-tabs w-75">
                <li class="nav-item"> <a class="nav-link active" href="#history">History</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#">Reports</a> </li>
            </ul>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Nº Orden</th>
                        <th scope="col">Metodo Pago</th>
                        <th scope="col">Nº Tarjeta</th>
                        <th scope="col">Fecha Orden</th>
                        <th scope="col">Total</th>
                        <th scope="col">Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                        // This is how you bind the values of the array to a variable
                        $idOrden = $row['ID_ORDEN'];
                        $fecOrden = $row['FEC_ORDEN'];
                        $montoTotal = $row['MONTO_TOTAL'];
                        $numTarjeta = $row['NUM_TARJETA'];
                        $metodoPago = $row['NOMBRE'];
                        echo "<tr'>
                                <td class='text-light' scope='row' name='identificador'>$idOrden</td>
                                <td class='text-light'>$metodoPago</td>
                                <td class='text-muted'>$numTarjeta</td>
                                <td class='text-light'>$fecOrden</td>
                                <td class='text-light'>₡$montoTotal</td>
                                <td class='d-flex text-light'>
                                    <button data-id='$idOrden' type='button' class='btn btn-light btn-sm btnDetalles' data-toggle='modal' data-target='#modalDetalles'>
                                        Detalles
                                    </button>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5">
                    <div class="main-content text-center">
                        <!--Header-->
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Detalles de la Orden</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <!--Body-->
                        <div class="modal-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                    </tr>
                                </thead>
                                <tbody id="display_rows">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '../components/footer.php';
    ?>
</body>

<script src="../scripts/historial.js"></script>