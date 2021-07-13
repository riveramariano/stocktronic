<head>
    <link href="../styles/historial.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

// Get id
$idOrden = "";

// Call the stored procedure to bring all metodos de pago
$getOrden = oci_parse($conn, "begin GET_ORDENES(:CM, 1); end;");

// Pass the memory cursor into the stored procedure, Note: Idk what -1 does, but leave it there hehe
oci_bind_by_name($getOrden, ":CM", $curs, -1, OCI_B_CURSOR);

// Execute the stored procedured and the memory cursor
oci_execute($getOrden);
oci_execute($curs);

// Start the session to get the total amount value from carrito.php
session_start();

?>

<body>

    <div class="wrapper rounded mt-5">
        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start">
            <a class="navbar-brand" href="#">Ordenes<p class="text-muted pl-1">Bienvenido a tú historial de ordenes</p> </a>
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
                        <th scope="col" class="text-right">Detalles</th>
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
                                <td class='d-flex justify-content-end align-items-center text-light'>
                                    <button name='btnDet' type='submit' class='btn btn-light btn-sm' data-toggle='modal' data-target='#modalCart'>D</button>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal: modalCart -->
    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
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
                        <tbody>
                            <?php
                            

                            $curs2 = oci_new_cursor($conn);
                            $getDetalleOrden = oci_parse($conn, "begin GET_DETALLE_ORDENES(:CM, 1); end;");
                            oci_bind_by_name($getDetalleOrden, ":CM", $curs2, -1, OCI_B_CURSOR);

                            // Execute de stored procedure
                            oci_execute($getDetalleOrden);
                            oci_execute($curs2);

                            while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                // This is how you bind the values of the array to a variable
                                $idDetalle = $row2['ID_DETALLEORDEN'];
                                $urlImagen = $row2['URL_IMAGEN'];
                                $precio = $row2['PRECIO'];
                                $cantidad = $row2['CANTIDAD'];
                                $nombre = $row2['NOMBRE'];
                                echo "<tr'>
                                        <th scope='row'>$idDetalle</th>
                                        <td>$nombre</td>
                                        <td>$cantidad</td>
                                        <td>₡$precio</td>
                                        <td><img src='$urlImagen' width='50' height='50' /></td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal: modalCart -->

    <?php
    include '../components/footer.php';
    ?>

</body>