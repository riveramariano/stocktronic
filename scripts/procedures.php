<?php
function login($conn)
{
    $emailusuario = $_POST['email'];
    $passusuario = $_POST['psw'];

    $curs = oci_new_cursor($conn);

    $login = oci_parse($conn, "begin LOGIN(:CM, :email, :passwrd); end;");

    oci_bind_by_name($login, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($login, ":email", $emailusuario, 32);
    oci_bind_by_name($login, ":passwrd", $passusuario, 32);

    oci_execute($login);
    oci_execute($curs);

    $row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS);

    $_SESSION['loggedUser'] = 1;
    $_SESSION['idUsuario'] = $row['ID_USUARIO'];
    $_SESSION['nombreUsuario'] = $row['NOMBRE'];
    $_SESSION['apellidoUsuario'] = $row['APELLIDO1'];
    $_SESSION['idRol'] = $row['ID_ROL'];

    header('Location: pages/inicio.php ');
};

function get_products($conn, $categoria)
{
    $curs = oci_new_cursor($conn);

    $getProductos = oci_parse($conn, "begin GET_PRODUCTOS(:CM, :ID_CATEGORIA); end;");

    oci_bind_by_name($getProductos, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($getProductos, ":ID_CATEGORIA", $categoria, -1);

    oci_execute($getProductos);
    oci_execute($curs);

    return $curs;
}

function get_products_random($conn)
{
    $curs = oci_new_cursor($conn);
    $query = oci_parse($conn, "begin GET_PRODUCTS_RANDOM(:CM); end;");

    oci_bind_by_name($query, ":CM", $curs, -1, OCI_B_CURSOR);

    oci_execute($query);
    oci_execute($curs);

    return $curs;
}

function get_categoria($conn, $categoria)
{
    $curs = oci_new_cursor($conn);
    $query = oci_parse($conn, "begin GET_CATEGORIA(:CM, :ID_CATEGORIA); end;");

    oci_bind_by_name($query, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($query, ":ID_CATEGORIA", $categoria, -1);

    oci_execute($query);
    oci_execute($curs);

    return $curs;
}

function get_lowest_price($conn, $categoria)
{
    $curs = oci_new_cursor($conn);
    $query = oci_parse($conn, "begin GET_LOWEST_PRICE(:CM,:ID_CATEGORIA); end;");

    oci_bind_by_name($query, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($query, ":ID_CATEGORIA", $categoria, -1);

    oci_execute($query);
    oci_execute($curs);

    return $curs;
}
