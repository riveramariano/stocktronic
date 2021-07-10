<?php

// Declare connection variables, Note: We'll need to change the username & password to = st
$username = 'test';
$password = 'test';
$dbname = 'localhost/orcl';

// Initialize the connection with Oracle
$conn = oci_connect($username, $password, $dbname, 'AL32UTF8') or die(oci_error());

// Note: In this file we can't close the connection, if we do that, the file won't do anything, try changing it if don't believe me hehe

?>