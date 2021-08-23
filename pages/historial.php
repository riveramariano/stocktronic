<head>
    <title>Historial - Stocktronic</title>
    <link href="../styles/newFonts.css" rel="stylesheet" />
    <link href="../styles/historial.css" rel="stylesheet" />
    <link href="../styles/modal.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
    <!-- This link reference here is for the table pagination -->
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet'>
    <link href='https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css' rel='stylesheet'>
</head>

<?php
// The first thing is always start the session
// session_start();

// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';

// Get the user id and the user name from the session
$idUsuario = $_SESSION['idUsuario'];
$nombreUsuario = $_SESSION['nombreUsuario'];

// Call the stored procedure to bring the bougth historial of the user
$getOrdenes = oci_parse($conn, "begin GET_ORDENES(:CM, :ID_USUARIO); end;");

// Create a memory cursor to iterate through the stored procedure
$curs = oci_new_cursor($conn);

// Bind the memory cursor and the user id into the stored procedure
oci_bind_by_name($getOrdenes, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getOrdenes, ":ID_USUARIO", $idUsuario, 32);

// Execute the stored procedured and the memory cursor
oci_execute($getOrdenes);
oci_execute($curs);
?>

<body>
    <?php
    if ($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<div class='container'>
            <div class='row justify-content-center'>
                <div class='col-md-6 text-center mt-5'>
                    <h2 class='heading-section'>Historial de Compras</h2>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='table-wrap'>
                        <table class='table' id='tblHistorial'>
                            <thead class='thead-dark'>
                                <tr class='text-center'>
                                    <th>#</th>
                                    <th>Método Pago</th>
                                    <th>Número Tarjeta</th>
                                    <th>Fec. Orden</th>
                                    <th>Monto Total</th>
                                    <th>Detalles Orden</th>
                                </tr>
                            </thead>
                            <tbody>";

        while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
            // Fetch the table values into variables
            $idOrden = $row['ID_ORDEN'];
            $fecOrden = $row['FEC_ORDEN'];
            $montoTotal = $row['MONTO_TOTAL'];
            $numTarjeta = $row['NUM_TARJETA'];
            $metodoPago = $row['NOMBRE'];
            // Print the table rows
            echo "<tr class='alert text-center' role='alert'>
                    <td scope='row' name='identificador'>$idOrden</td>
                    <td>$metodoPago</td>
                    <td>$numTarjeta</td>
                    <td>$fecOrden</td>
                    <td>₡$montoTotal</td>
                    <td>
                        <button data-id='$idOrden' type='button' class='btn btn-sm btnDetalles' data-toggle='modal' data-target='#modalDetalles'>
                            Detalles
                        </button>
                    </td>
                </tr>";
        }

        echo "</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>";
        include '../components/footer.php';
    } else {
        echo '<div id="outer" class="container mt-5 header-top">
                <div id="inner">
                    <h1 class="text-center mt-3">Historial de Compras</h1>
                    <p class="text-center">Aun no has realizado compras</p>
                    <a class="d-flex justify-content-center fs" href="inicio.php">Empecemos!</a>
                </div>
            </div>';
    }
    ?>
    <!-- <div class="container header-top">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mt-5">
                <h2 class="heading-section">Historial de Compras</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table" id="tblHistorial">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Método Pago</th>
                                <th>Número Tarjeta</th>
                                <th>Fec. Orden</th>
                                <th>Monto Total</th>
                                <th>Detalles Orden</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                            //     // Fetch the table values into variables
                            //     $idOrden = $row['ID_ORDEN'];
                            //     $fecOrden = $row['FEC_ORDEN'];
                            //     $montoTotal = $row['MONTO_TOTAL'];
                            //     $numTarjeta = $row['NUM_TARJETA'];
                            //     $metodoPago = $row['NOMBRE'];
                            //     // Print the table rows
                            //     echo "<tr class='alert text-center' role='alert'>
                            //                 <td scope='row' name='identificador'>$idOrden</td>
                            //                 <td>$metodoPago</td>
                            //                 <td>$numTarjeta</td>
                            //                 <td>$fecOrden</td>
                            //                 <td>₡$montoTotal</td>
                            //                 <td>
                            //                     <button data-id='$idOrden' type='button' class='btn btn-sm btnDetalles' data-toggle='modal' data-target='#modalDetalles'>
                            //                         Detalles
                            //                     </button>
                            //                 </td>
                            //             </tr>";
                            // }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Modal -->
    <div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5">
                    <div class="main-content text-center">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Detalles de la Orden</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div>
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Producto</th>
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

    <script src="../scripts/historial.js"></script>

    <!-- Scripts for the table pagination -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <!-- Script for the buttons in general -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>

    <!-- This one is for the Excel button -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- This two are for the PDF button -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- This two are for the Print button -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

</body>