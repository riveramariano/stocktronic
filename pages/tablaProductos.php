<head>
    <link href="../styles/catalogo.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
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
    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-bordered mt-5" id="tblProductos">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Accion</th>
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
                        echo '<tr>
                                <th scope="row">' . $nombre . '</th>
                                <td class="text-center"><img class="" src="' . $urlImagen . '" alt="" width="100" height="100" /></td>
                                <td>' . $precio . '</td>
                                <td>' . $cantidad . '</td>
                                <td>' . $tipo . '</td>
                                <td class="text-center"><button class="btn btn-success">Actualizar</button> <button class="btn btn-danger">Eliminar</button></td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    // Import the footer.php
    include '../components/footer.php';
    ?>

    <!-- Add sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/tablaProductos.js"></script>
    <script src="../scripts/sweetalert2.js"></script>

    <!-- This one call the ajax to add carrito -->
    <script src="../scripts/addCarrito.js"></script>

    <!-- Usuful scripts? I think we could delete some, try deleting them one by one hehe -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>