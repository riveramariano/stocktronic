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
                            <div class="form-group col-sm-12">
                                <label>Nombre Producto</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Descripción Producto</label>
                                <input id="desc" name="desc" type="text" class="form-control" placeholder="Descripcion" value="" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>URL Imagen</label>
                                <input id="url" name="url" type="text" class="form-control" placeholder="URL" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Precio Producto</label>
                                <input id="precio" name="precio" type="number" class="form-control" placeholder="Precio" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Cantidad Producto</label>
                                <input id="cant" name="cantidad" type="number" class="form-control" placeholder="Cantidad" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Proveedor</label>
                                <select id="selectProveedor" name="proveedor" class="form-control">
                                    <?php
                                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        echo "<option value=" . $row["ID_PROVEEDOR"] . " selected>" . $row["NOMBRE"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Categoría</label>
                                <select id="selectCategoria" name="categoria" class="form-control">
                                    <?php
                                    while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        echo "<option value=" . $row2["ID_CATEGORIA"] . " selected>" . $row2["TIPO"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <button id="btnInsert" type="submit" name="submitBtn" class="btn btn-primary btn-block">Agregar Producto</button>
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