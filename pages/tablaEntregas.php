<head>
    <title>Errores - Stocktronic</title>
    <link href="../styles/checkout.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
    <!-- This link reference here is for the table pagination -->
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet'>
    <link href='https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css' rel='stylesheet'>
</head>

<?php
// Import header.php and conexion.php
include '../components/header.php';
include '../conexion.php';

// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

// Call the stored procedure to bring the list of products
$getAllEntregas = oci_parse($conn, "begin GET_ALL_ENTREGAS(:CM); end;");

// Bind the memory cursors into the stored procedure
oci_bind_by_name($getAllEntregas, ":CM", $curs, -1, OCI_B_CURSOR);

// Execute the stored procedures and the memory cursor
oci_execute($getAllEntregas);
oci_execute($curs);
?>

<body>

    <div class="container header-top">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mt-5">
                <h2 class="heading-section">Historial Entregas</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table" id="tblHistorial">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Fec. Entrega</th>
                                <th>Producto</th>
                                <th>Proveedor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                // Atributos from the table productos inner join categoria
                                $idEntrega = $row['ID_ENTREGAS'];
                                $fecEntrega = $row['FEC_ENTREGA'];
                                $nombreProducto = $row['NOMBRE'];
                                $cedProveedor = $row['CED_JURIDICA'];
                                // Printing the values into the table
                                echo '<tr class="text-center">
                                        <th>' . $idEntrega . '</th>
                                        <td scope="row">' . $fecEntrega . '</td>
                                        <td>' . $nombreProducto . '</td>
                                        <td>' . $cedProveedor . '</td>
                                    </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Import the footer.php
    include '../components/footer.php';
    ?>

    <!-- Add sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../scripts/deleteProducto.js"></script>
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