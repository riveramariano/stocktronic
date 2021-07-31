<head>
    <link href="../styles/checkout.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';

// Get the url id
$idParametro = $_GET['q'];

// Create the memory cursors to iterate through table values
$curs = oci_new_cursor($conn);
$curs2 = oci_new_cursor($conn);
$curs3 = oci_new_cursor($conn);

// Call the stored procedure to bring the list of proveedores
$getAllProveedores = oci_parse($conn, "begin GET_ALL_PROVEEDORES(:CM); end;");

// Call the stored procedure to bring the list of categorias
$getAllCategorias = oci_parse($conn, "begin GET_ALL_CATEGORIAS(:CM); end;");

// Call the stored procedure to bring the product information
$getProducto = oci_parse($conn, "begin GET_PRODUCTO(:CM, :ID_PRODUCTO); end;");

// Bind the memory cursors into the stored procedures
oci_bind_by_name($getAllProveedores, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getAllCategorias, ":CM", $curs2, -1, OCI_B_CURSOR);

oci_bind_by_name($getProducto, ":CM", $curs3, -1, OCI_B_CURSOR);
oci_bind_by_name($getProducto, ":ID_PRODUCTO", $idParametro, -1);

// Execute the stored procedures and the memory cursor
oci_execute($getAllProveedores);
oci_execute($curs);

oci_execute($getAllCategorias);
oci_execute($curs2);

oci_execute($getProducto);
oci_execute($curs3);

// This forms show another way to fetch an array
$productoEncontrado = oci_fetch_array($curs3, OCI_ASSOC + OCI_RETURN_NULLS);

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
                                <input name="id" type="text" class="form-control" placeholder="Identificador" value="<?php echo $productoEncontrado['ID_PRODUCTO']; ?>" maxlength="2" minlength="2" disabled>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="">Nombre Producto</label>
                                <input name="nombre" type="text" class="form-control" placeholder="Nombre" value="<?php echo $productoEncontrado['NOMBRE']; ?>" maxlength="2" minlength="2" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="">Descripción Producto</label>
                                <input name="desc" type="text" class="form-control" placeholder="Descripcion" value="<?php echo $productoEncontrado['DESCRIPCION']; ?>" maxlength="2" minlength="2" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="">URL Imagen</label>
                                <input name="url" type="text" class="form-control" placeholder="URL" value="<?php echo $productoEncontrado['URL_IMAGEN']; ?>" maxlength="2" minlength="2" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Precio Producto</label>
                                <input name="precio" type="number" class="form-control" placeholder="Precio" value="<?php echo $productoEncontrado['PRECIO']; ?>" maxlength="2" minlength="2">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Cantidad Producto</label>
                                <input name="cant" type="number" class="form-control" placeholder="Cantidad" value="<?php echo $productoEncontrado['CANTIDAD']; ?>" maxlength="2" minlength="2">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="metodo">Proveedor</label>
                                <select name="proveedor" class="form-control">
                                    <?php
                                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        if ($row["ID_PROVEEDOR"] == $productoEncontrado['ID_PROVEEDOR']) {
                                            echo "<option value=" . $row["ID_PROVEEDOR"] . " selected>" . $row["NOMBRE"] . "</option>";
                                        } else {
                                            echo "<option value=" . $row["ID_PROVEEDOR"] . ">" . $row["NOMBRE"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="metodo">Categoría</label>
                                <select name="categoria" class="form-control">
                                    <?php
                                    while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        if ($row2["ID_CATEGORIA"] == $productoEncontrado['ID_CATEGORIA']) {
                                            echo "<option value=" . $row2["ID_CATEGORIA"] . " selected>" . $row2["TIPO"] . "</option>";
                                        } else {
                                            echo "<option value=" . $row2["ID_CATEGORIA"] . ">" . $row2["TIPO"] . "</option>";
                                        }
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