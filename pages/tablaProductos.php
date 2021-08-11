<head>
    <title>Inventario - Stocktronic</title>
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
$getAllProductos = oci_parse($conn, "begin GET_ALL_PRODUCTOS(:CM); end;");

// Bind the memory cursors into the stored procedure
oci_bind_by_name($getAllProductos, ":CM", $curs, -1, OCI_B_CURSOR);

// Execute the stored procedures and the memory cursor
oci_execute($getAllProductos);
oci_execute($curs);
?>

<body>

    <div class="container header-top">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mt-5">
                <h2 class="heading-section">Inventario Stocktronic</h2>
                <a href="formProductoInsert.php"><button class="btn btn-primary mt-3 mb-4">Agregar Producto</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table" id="tblHistorial">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                // Atributos from the table productos inner join categoria
                                $idProducto = $row['ID_PRODUCTO'];
                                $nombre = $row['NOMBRE'];
                                $descripcion = $row['DESCRIPCION'];
                                $urlImagen = $row['URL_IMAGEN'];
                                $precio = $row['PRECIO'];
                                $cantidad = $row['CANTIDAD'];
                                $idProveedor = $row['ID_PROVEEDOR'];
                                $idCategoria = $row['ID_CATEGORIA'];
                                $tipo = $row['TIPO'];
                                // Printing the values into the table
                                echo '<tr class="text-center">
                                        <th>' . $idProducto . '</th>
                                        <td scope="row">' . $nombre . '</td>
                                        <td class="text-center"><img class="" src="' . $urlImagen . '" alt="" width="100" height="100" /></td>
                                        <td>' . $precio . '</td>
                                        <td>' . $cantidad . '</td>
                                        <td>' . $tipo . '</td>
                                        <td class="text-center">
                                            <a href="formProductoUpdate.php?q=' . $idProducto . '"><button class="btn btn-success btn-md">Actualizar</button></a>
                                            <button data-id="' . $idProducto . '" type="button" class="btn btn-danger btn-md btnDelete">Eliminar</button>
                                        </td>
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

    <script src="../scripts/tablaProductos.js"></script>
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