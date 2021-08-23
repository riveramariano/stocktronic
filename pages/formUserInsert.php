<head>
    <link href="../styles/formsButtons.css" rel="stylesheet" />
    <link href="../styles/checkout.css" rel="stylesheet" />
    <link href="../images/isotipo.svg" type="image" rel="shortcut icon" />
</head>

<?php
// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';
include './usuarioSP/getTipos.php';
?>

<body>
    <main class="page payment-page header-top">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Agregar Usuario</h2>
                </div>

                <!-- Begin Form -->
                <form action="" method="post">
                    <div class="card-details">
                        <h3 class="title text-uppercase">Agregar Usuario</h3>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label id="nomVal">Nombre</label>
                                <input id="nombre" name="nombre" maxlength="20" type="text" class="form-control" placeholder="Nombre" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="appVal">Primer Apellido</label>
                                <input id="apellido1" name="apellido1" maxlength="20" type="text" class="form-control" placeholder="Primer Apellido" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="app2Val">Segundo Apellido</label>
                                <input id="apellido2" name="apellido2" maxlength="20" type="text" class="form-control" placeholder="Segundo Apellido" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="emailVal">Correo Electrónico</label>
                                <input id="email" name="email" type="mail" maxlength="80" class="form-control" placeholder="Correo Electrónico" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="passVal">Contraseña</label>
                                <input id="password" name="password" type="password" maxlength="15" class="form-control" placeholder="Contraseña" value="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label id="tipoVal">Tipo de usuario</label>
                                <select id="selectTipo" name="selectTipo" class="form-control">
                                    <?php
                                    $dataCategorias = get_roles($conn);
                                    while (($row = oci_fetch_array($dataCategorias, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                                        echo "<option value=" . $row["ID_ROL"] . ">" . $row["TIPO"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="container">

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <a href="tablaUsuarios.php"><button id="cancelar" type="button" class="btn btn-block ">Cancelar</button></a>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <button id="btnInsert" type="submit" class="btn btn-block">Crear usuario</button>
                                    </div>
                                </div>
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
    <script src="../scripts/formUsuario.js"></script>

</body>

<!-- We'll need to free the statments and close the conn here -->