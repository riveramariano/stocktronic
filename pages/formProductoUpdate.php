<head>
    <link href="../styles/formsButtons.css" rel="stylesheet" />
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

?>

<body>

    <main class="page payment-page header-top">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Actualizar Producto</h2>
                </div>

                <!-- Begin Form -->
                <form action="" method="post">
                    <div class="card-details">
                        <h3 class="title text-uppercase">Actualizar Producto</h3>
                        <div class="row">
                            <?php
                            // Fetch the array of the first stored procedure to create a new option for each metodo de pago
                            while (($row3 = oci_fetch_array($curs3, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                $idProducto = $row3['ID_PRODUCTO'];
                                $nombreProducto = $row3['NOMBRE'];
                                $descProducto = $row3['DESCRIPCION'];
                                $urlProducto = $row3['URL_IMAGEN'];
                                $precioProducto = $row3['PRECIO'];
                                $cantProducto = $row3['CANTIDAD'];
                                $idProveedor = $row3['ID_PROVEEDOR'];
                                $idCategoria = $row3['ID_CATEGORIA'];
                                echo '<div class="form-group col-sm-4">
                                        <label id="idVal">ID Producto</label>
                                        <input id="idProducto" name="id" type="number" class="form-control" placeholder="Identificador" value="' . $idProducto . '" disabled>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label id="nomVal">Nombre Producto</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="' . $nombreProducto . '" required>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label id="descVal">Descripción Producto</label>
                                        <input id="desc" name="desc" type="text" class="form-control" placeholder="Descripcion" value="' . $descProducto . '" required>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label id="urlVal">URL Imagen</label>
                                        <input id="url" name="url" type="text" class="form-control" placeholder="URL" value="' . $urlProducto . '"  required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label id="precioVal">Precio Producto</label>
                                        <input id="precio" name="precio" type="number" class="form-control" placeholder="Precio" value="' . $precioProducto . '" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label id="cantVal">Cantidad Producto</label>
                                        <input id="cant" name="cantidad" type="number" class="form-control" placeholder="Cantidad" value="' . $cantProducto . '" required>
                                    </div>';
                            }
                            ?>
                            <div class="form-group col-sm-6">
                                <label id="proveedorVal">Proveedor</label>
                                <select id="selectProveedor" name="proveedor" class="form-control">
                                    <?php
                                    while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        if ($row["ID_PROVEEDOR"] == $idProveedor) {
                                            echo "<option value=" . $row["ID_PROVEEDOR"] . " selected>" . $row["NOMBRE"] . "</option>";
                                        } else {
                                            echo "<option value=" . $row["ID_PROVEEDOR"] . ">" . $row["NOMBRE"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="categoriaVal">Categoría</label>
                                <select id="selectCategoria" name="categoria" class="form-control">
                                    <?php
                                    while (($row2 = oci_fetch_array($curs2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        if ($row2["ID_CATEGORIA"] == $idCategoria) {
                                            echo "<option value=" . $row2["ID_CATEGORIA"] . " selected>" . $row2["TIPO"] . "</option>";
                                        } else {
                                            echo "<option value=" . $row2["ID_CATEGORIA"] . ">" . $row2["TIPO"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <a href="tablaProductos.php"><button id="cancelar" type="button" class="btn btn-block ">Cancelar</button></a>
                            </div>
                            <div class="form-group col-sm-6">
                                <button id="btnUpdate" type="submit" class="btn btn-block">Actualizar Producto</button>
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