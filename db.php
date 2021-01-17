<?php
// Opens a connection to a MySQL server.
$connection=mysqli_connect ("127.0.0.1", 'root', 'root12345','vsmti');
if (!$connection) {
    die('Not connected : ' . mysqli_connect_error());
}
