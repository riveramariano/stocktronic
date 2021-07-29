<head>
    <link href="../styles/checkout.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';

// Create the memory cursors to iterate through table values
$curs = oci_new_cursor($conn);
$curs2 = oci_new_cursor($conn);

// Call the stored procedure to bring the list of proveedores
$getAllProveedores = oci_parse($conn, "begin GET_ALL_PROVEEDORES(:CM); end;");

// Call the stored procedure to bring the list of products
$getAllCategorias = oci_parse($conn, "begin GET_ALL_CATEGORIAS(:CM); end;");

// Bind the memory cursors into the stored procedures
oci_bind_by_name($getAllProveedores, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getAllCategorias, ":CM", $curs2, -1, OCI_B_CURSOR);

// Execute the stored procedures and the memory cursor
oci_execute($getAllProveedores);
oci_execute($curs);

oci_execute($getAllCategorias);
oci_execute($curs2);

/*
// After pressing the button the "isset" func. is going to search for the inputs with the following names:
if (isset($_POST['submitBtn'])) {
    // Set the input values to a variable
    $idProducto = $_POST['id'];
    $nombreProducto = $_POST['nombre'];
    $descProducto = $_POST['desc'];
    $urlProducto = $_POST['url'];
    $precioProducto = $_SESSION['precio'];
    $cantProducto = $_SESSION['cant'];
    $proveedorProducto = $_POST['proveedor'];
    $categoriaProducto = $_POST['categoria'];

    // Call the stored procedure to insert
    $updateProducto = oci_parse($conn, "begin UPDATE_PRODUCTO(:ID, :NOMBRE, :DESC, :URL, :PRECIO, :CANTIDAD, :PROVEEDOR, :CATEGORIA); end;");

    // Bind the parameters into the stored procedure, this is strictly neccesary
    oci_bind_by_name($updateProducto, ":ID", $idProducto, -1);
    oci_bind_by_name($updateProducto, ":NOMBRE", $nombreProducto, -1);
    oci_bind_by_name($updateProducto, ":DESC", $descProducto, -1);
    oci_bind_by_name($updateProducto, ":URL", $urlProducto, -1);
    oci_bind_by_name($updateProducto, ":PRECIO", $precioProducto, -1);
    oci_bind_by_name($updateProducto, ":CANTIDAD", $cantProducto, -1);
    oci_bind_by_name($updateProducto, ":PROVEEDOR", $proveedorProducto, -1);
    oci_bind_by_name($updateProducto, ":CATEGORIA", $categoriaProducto, -1);

    // Execute de stored procedure
    oci_execute($updateProducto);

    // Redirect to "confirmacion.php" after the insert is accomplished
    header('Location: tablaProductos.php');
}
*/
?>

<body class="bg-light">

    <main class="page payment-page">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Formulario</h2>
                    <p>Este formulario tiene la función de actualizar la información de un producto específico.</p>
                </div>

                <!-- Begin Form -->
                <form action="" method="post">
                    <div class="card-details">
                        <h3 class="title text-uppercase">Actualizar Producto</h3>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="">ID Producto</label>
                                <input name="id" type="text" class="form-control" placeholder="Identificador" maxlength="2" minlength="2" required>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="">Nombre Producto</label>
                                <input name="nombre" type="text" class="form-control" placeholder="Nombre" maxlength="2" minlength="2" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="">Descripcion Producto</label>
                                <input name="desc" type="text" class="form-control" placeholder="Descripcion" maxlength="2" minlength="2" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="">URL Imagen</label>
                                <input name="url" type="text" class="form-control" placeholder="URL" maxlength="2" minlength="2" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Precio Producto</label>
                                <input name="precio" type="text" class="form-control" placeholder="Precio" maxlength="2" minlength="2">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Cantidad Producto</label>
                                <input name="cant" type="text" class="form-control" placeholder="Cantidad" maxlength="2" minlength="2">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="metodo">Proveedor</label>
                                <select name="proveedor" class="form-control">
                                    <?php
                                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        // This is how you bind the values of the array to a variable
                                        $id = $row['ID_PROVEEDOR'];
                                        $nombreProveedor = $row['NOMBRE'];
                                        // You gotta use this sintax to insert a php variable into a html attribute, useful for dinamic id's
                                        echo '<option value="' . $id . '">' . $nombreProveedor . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="metodo">Categoria</label>
                                <select name="categoria" class="form-control">
                                    <?php
                                    while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        // This is how you bind the values of the array to a variable
                                        $id = $row2['ID_CATEGORIA'];
                                        $tipoProducto = $row2['TIPO'];
                                        // You gotta use this sintax to insert a php variable into a html attribute, useful for dinamic id's
                                        echo '<option value="' . $id . '">' . $tipoProducto . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <button id="submitBtn" name="submitBtn" class="btn btn-success btn-block">Actualizar Producto</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php
    include '../components/footer.php';
    ?>

    <!-- Add sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/sweetalert2.js"></script>

    <!-- This script calls the ajax to update producto -->
    <script src="../scripts/proceduresProducto.js"></script>

</body>

<!-- We'll need to free the statments and close the conn here -->