<?php
function get_usuario($conn, $id)
{
    $curs = oci_new_cursor($conn);
    $query = oci_parse($conn, "begin GET_USUARIO(:CM, :id); end;");

    oci_bind_by_name($query, ":CM", $curs, -1, OCI_B_CURSOR);
    oci_bind_by_name($query, ":id", $id, -1);

    oci_execute($query);
    oci_execute($curs);

    return $curs;
}
