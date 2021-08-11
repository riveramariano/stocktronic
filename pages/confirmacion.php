<head>
    <title>Confirmación - Stocktronic</title>
    <link href="../styles/confirmacion.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<?php
include "../components/header.php";

$nombreUsuario = $_SESSION['nombreUsuario'];
$apellidoUsuario = $_SESSION['apellidoUsuario'];

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

// Get id
$idOrden = "";
$totalOrden = 0;
$totalInfoPago = 0;

// Call the stored procedure to bring all metodos de pago
$getOrden = oci_parse($conn, "begin GET_ORDEN(:CM); end;");

// Pass the memory cursor into the stored procedure, Note: Idk what -1 does, but leave it there hehe
oci_bind_by_name($getOrden, ":CM", $curs, -1, OCI_B_CURSOR);

// Execute the stored procedured and the memory cursor
oci_execute($getOrden);
oci_execute($curs);

?>

<body>
    <div class="container header-top mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5"> <img src="../images/isotipoDark.svg" width="40"> </div>
                    <div class="invoice p-5">
                        <h5>Tú orden ha sido confirmada!</h5> <span class="font-weight-bold d-block mt-4">Hola <?php echo $nombreUsuario . ' ' . $apellidoUsuario ?></span> <span>Tú orden ha sido confirmada y podrás ver los detalles de esta en tú historial</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <?php
                                        while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                            $idOrden = $row['ID_ORDEN'];
                                            $fecOrden = $row['FEC_ORDEN'];
                                            $totalOrden = $row['MONTO_TOTAL'];
                                            $numTarjeta = $row['NUM_TARJETA'];
                                            $dirFacturacion = $row['DIR_FACTURACION'];
                                            $totalInfoPago = $row['TOTAL'];
                                            $metodoPago = $row['NOMBRE'];

                                            echo "<td>
                                                    <div class='py-2'> <span class='d-block text-muted mb-2'>Fec. Orden</span> <span>$fecOrden</span> </div>
                                                </td>
                                                <td>
                                                    <div class='py-2'> <span class='d-block text-muted mb-2'>No. Orden</span> <span>$idOrden</span> </div>
                                                </td>
                                                <td>
                                                    <div class='py-2'> <span class='d-block text-muted mb-2'>Método Pago</span> <span>$metodoPago</span> </div>
                                                </td>
                                                <td>
                                                    <div class='py-2'> <span class='d-block text-muted mb-2'>Dir. Facturación</span> <span>$dirFacturacion</span> </div>
                                                </td>";
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <?php
                                    // Declare de memory cursor and the stored procedure
                                    $curs2 = oci_new_cursor($conn);
                                    $getDetalleOrden = oci_parse($conn, "begin GET_DETALLE_ORDENES(:CM, $idOrden); end;");

                                    // Bind the memory cursor to the stored procedure
                                    oci_bind_by_name($getDetalleOrden, ":CM", $curs2, -1, OCI_B_CURSOR);

                                    // Execute the calls to the database
                                    oci_execute($getDetalleOrden);
                                    oci_execute($curs2);

                                    while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        $precio = $row2['PRECIO'];
                                        $cantidad = $row2['CANTIDAD'];
                                        $urlImagen = $row2['URL_IMAGEN'];
                                        $nombre = $row2['NOMBRE'];

                                        echo "<tr>
                                                <td width='20%'> <img src='$urlImagen' width='80' height='70' /> </td>
                                                <td width='60%'> <span class='font-weight-bold'>$nombre</span>
                                                    <div class='product-qty'> <span class='d-block mt-2'>Cantidad: $cantidad</span></div>
                                                </td>
                                                <td width='20%'>
                                                    <div class='text-right'> <span class='font-weight-bold'>₡$precio</span> </div>
                                                </td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <?php echo "<div class='text-right'> <span>₡$totalInfoPago</span> </div>"; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Impuestos:</span> </div>
                                            </td>
                                            <td>
                                                <?php
                                                $tax = $totalInfoPago * 0.13;
                                                echo "<div class='text-right'> <span class='text-danger'>₡$tax</span> </div>";
                                                ?>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Monto total</span> </div>
                                            </td>
                                            <td>
                                                <?php
                                                $totalInfoPago += $tax;
                                                // I did a trick and didn't print the total orden 'cause it's wrong
                                                echo "<div class='text-right'> <span class='font-weight-bold'>₡$totalInfoPago</span> </div>";
                                                ?>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p class="font-weight-bold mb-0">Gracias por confiar en nosotros!</p> <span>Stocktronic Team</span>
                    </div>
                    <div class="d-flex justify-content-between footer p-3"> <span>Regresar a la<a href="inicio.php"> página principal</a></span> <span>Agosto, 2021</span> </div>
                </div>
            </div>
        </div>
    </div>
</body>