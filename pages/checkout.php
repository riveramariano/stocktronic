<?php
// Import header.php and conexion.php
include "../components/header.php";
include '../conexion.php';


// Create a memory cursor to iterate through table values
$curs = oci_new_cursor($conn);

// Call the stored procedure to bring all metodos de pago
$getAllMetodoPago = oci_parse($conn, "begin GET_ALL_METODOPAGO(:CM); end;");

// Pass the memory cursor into the stored procedure, Note: Idk what -1 does, but leave it there hehe
oci_bind_by_name($getAllMetodoPago, ":CM", $curs, -1, OCI_B_CURSOR);

// Execute the stored procedured and the memory cursor
oci_execute($getAllMetodoPago);
oci_execute($curs);

// After pressing the button the "isset" func. is going to search for the inputs with the following names:
if (isset($_POST['submitBtn'])) {
    // Set the input values to a variable
    $numeroTarjeta = $_POST['tarjeta'];
    $direccion1 = $_POST['dir1'];
    $direccion2 = $_POST['dir2'];
    $telefono = $_POST['telefono'];
    $total = $_SESSION['total'];
    $idUsuario = 1;
    $metodoPago = $_POST['metodo'];

    // Call the stored procedure to insert
    $insertInfoPago = oci_parse($conn, "begin INSERT_INFOPAGO(:I_NUM_TARJETA, :I_DIR_FACTURACION, :I_DIR_FACTURACION2, :I_TELEFONO, 5000, :I_ID_USUARIO, :I_ID_METODOPAGO); end;");

    // Pass the parameters into the stored procedure, Note: You can only assign a variable as a parameter value in the stored procedure, that's the goal of $idUsuario
    oci_bind_by_name($insertInfoPago, ":I_NUM_TARJETA", $numeroTarjeta, 32);
    oci_bind_by_name($insertInfoPago, ":I_DIR_FACTURACION", $direccion1, 32);
    oci_bind_by_name($insertInfoPago, ":I_DIR_FACTURACION2", $direccion2, 32);
    oci_bind_by_name($insertInfoPago, ":I_TELEFONO", $telefono, 32);
    // oci_bind_by_name($insertInfoPago, ":I_TOTAL", $total, 32);
    oci_bind_by_name($insertInfoPago, ":I_ID_USUARIO", $idUsuario, 32);
    oci_bind_by_name($insertInfoPago, ":I_ID_METODOPAGO", $metodoPago, 32);

    // Execute de stored procedure
    oci_execute($insertInfoPago);

    // Redirect to "confirmacion.php" after the insert is accomplished
    header('Location:confirmacion.php');
}
?>

<body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout form</h2>
            <p class="lead">Below is an example</p>
        </div>
    </div>

    <div class="container">
        <h2 class="mb-3 text-uppercase">Método de pago</h2>

        <!-- Form starting line -->
        <form action="" method="post">
            <!-- First row -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">Selecciona un método de pago</label>
                    <select name="metodo" class="form-control">
                        <?php
                        // Fetch the array of the first stored procedure to create a new option for each metodo de pago
                        while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
                            // This is how you bind the values of the array to a variable
                            $id = $row['ID_METODOPAGO'];
                            $nombre = $row['NOMBRE'];
                            // You gotta use this sintax to insert a php variable into a html attribute, useful for dinamic id's
                            echo '<option value="' . $id . '">' . $nombre . '</option>';
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
            </div>

            <!-- Second row -->
            <div class="row mb-5">
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">Número de tarjeta</label>
                    <input name="tarjeta" type="text" class="form-control" maxlength="16" minlength="16" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-3">
                    <label for="firstName" class="form-label">Mes</label>
                    <select class="form-control">
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-3">
                    <label for="firstName" class="form-label">Año</label>
                    <select class="form-control" required>
                        <option value="1">2021</option>
                        <option value="2">2022</option>
                        <option value="3">2023</option>
                        <option value="4">2024</option>
                        <option value="5">2025</option>
                        <option value="6">2026</option>
                        <option value="7">2027</option>
                        <option value="8">2028</option>
                        <option value="9">2029</option>
                        <option value="10">2030</option>
                    </select>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-2">
                    <label for="firstName" class="form-label">Código de seguridad</label>
                    <input id="firstName" type="text" class="form-control" maxlength="3" minlength="3" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
            </div>

            <!-- Third row -->
            <div class="row mb-3">
                <div class="col-sm-10">
                    <h2 class="text-uppercase">Información de Facturación</h2>
                </div>
            </div>

            <!-- Fourth row -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">Nombre</label>
                    <input type="text" class="form-control" placeholder="Mariano" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" placeholder="Salazar" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" placeholder="Carrión" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
            </div>

            <!-- Fifth row -->
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">Dirección de facturación</label>
                    <input name="dir1" type="text" class="form-control" placeholder="San José, Curridabat" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">Dirección de facturación (segunda linea)</label>
                    <input name="dir2" type="text" class="form-control" placeholder="Casa G-30, 25mts norte farmacia" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
            </div>

            <!-- Sixth row -->
            <div class="row mb-5">
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">País</label>
                    <select class="form-control">
                        <option value="1">Costa Rica</option>
                    </select>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">Código postal o zip</label>
                    <input id="firstName" type="text" class="form-control" maxlength="6" minlength="5" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
                <div class="col-sm-4">
                    <label for="firstName" class="form-label">Teléfono</label>
                    <input name="telefono" type="text" class="form-control" maxlength="20" minlength="8" required>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
            </div>

            <!-- Seventh row -->
            <div class="row">
                <div class="col-sm-4">
                    <button name="submitBtn" type="submit" class="btn btn-primary">Finalizar Compra</button>
                    <div class="invalid-feedback">Valid first name is required</div>
                </div>
            </div>
        </form>
        <!-- Form finish line -->
    </div>
</body>

<!-- We'll need to free the statments and close the conn here -->