<head>
    <link href="../styles/formsButtons.css" rel="stylesheet" />
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

// Call the stored procedure to bring the list of categorias
$getAllCategorias = oci_parse($conn, "begin GET_ALL_CATEGORIAS(:CM); end;");


// Bind the memory cursors into the stored procedures
oci_bind_by_name($getAllProveedores, ":CM", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($getAllCategorias, ":CM", $curs2, -1, OCI_B_CURSOR);

// Execute the stored procedures and the memory cursor
oci_execute($getAllProveedores);
oci_execute($curs);

oci_execute($getAllCategorias);
oci_execute($curs2);
?>

<body>

    <main class="page payment-page header-top">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Agregar Producto</h2>
                </div>

                <!-- Begin Form -->
                <form action="" method="post">
                    <div class="card-details">
                        <h3 class="title text-uppercase">Agregar Producto</h3>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label id="nomVal">Nombre Producto</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label id="descVal">Descripción Producto</label>
                                <input id="desc" name="desc" type="text" class="form-control" placeholder="Descripcion" value="" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label id="urlVal">URL Imagen</label>
                                <input id="url" name="url" type="text" class="form-control" placeholder="URL" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="precioVal">Precio Producto</label>
                                <input id="precio" name="precio" type="number" class="form-control" placeholder="Precio" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="cantVal">Cantidad Producto</label>
                                <input id="cant" name="cantidad" type="number" class="form-control" placeholder="Cantidad" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="proveedorVal">Proveedor</label>
                                <select id="selectProveedor" name="proveedor" class="form-control">
                                    <?php
                                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        echo "<option value=" . $row["ID_PROVEEDOR"] . ">" . $row["NOMBRE"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="categoriaVal">Categoría</label>
                                <select id="selectCategoria" name="categoria" class="form-control">
                                    <?php
                                    while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        echo "<option value=" . $row2["ID_CATEGORIA"] . ">" . $row2["TIPO"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <a href="tablaProductos.php"><button id="cancelar" type="button" class="btn btn-block ">Cancelar</button></a>
                            </div>
                            <div class="form-group col-sm-6">
                                <button id="btnInsert" type="submit" class="btn btn-block">Agregar Producto</button>
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

    <!-- This script calls the ajax to update producto -->
    <script src="../scripts/formProducto.js"></script>

</body>

<!-- We'll need to free the statments and close the conn here -->