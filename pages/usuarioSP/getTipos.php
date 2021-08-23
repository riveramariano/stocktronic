<?php
function get_roles($conn)
{
    $curs = oci_new_cursor($conn);
    $query = oci_parse($conn, "begin GET_ALL_ROLES(:CM); end;");

    oci_bind_by_name($query, ":CM", $curs, -1, OCI_B_CURSOR);

    oci_execute($query);
    oci_execute($curs);

    return $curs;
}
