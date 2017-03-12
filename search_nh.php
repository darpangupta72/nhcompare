<?php

require_once 'db_functions.php';
$db = new db_functions();

// both parameters received 
if (isset($_GET['type']) && isset($_GET['field']) && isset($_GET['order'])) {

    // receiving the get params
    $type = $_GET['type'];
    $field = $_GET['field'];
    $order = $_GET['order'];
    // search and display from the database where $type = $field
    $db->search_nh($type, $field, $order);

} else {

    // required parameters missing
    $error_msg = "Required parameters missing!";
    echo "<center>$error_msg</center>";

}

?>