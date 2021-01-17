<?php
require("db.php");

// Gets data from URL parameters.
if(isset($_GET['add_location'])) {
    add_location();
}
if(isset($_GET['confirm_location'])) {
    confirm_location();
}

function get_all_locations(){
    $con=mysqli_connect ("127.0.0.1", 'root', 'root12345','vsmti');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $sqldata = mysqli_query($con,"
select id ,naziv,nositelj,vrijednost,status,voditelj,adresa,postanski_broj,grad,latituda,longituda as isconfirmed
from projekt
  ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
  $indexed = array_map('array_values', $rows);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}
function array_flatten($array) {
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        }
        else {
            $result[$key] = $value;
        }
    }
    return $result;
}

?>