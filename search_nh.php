<?php

require_once 'db_functions.php';
$db = new db_functions();

$success = FALSE;
$error_msg = "";

// both parameters received 
if (isset($_GET['type']) && isset($_GET['field'])) {

    // receiving the post params
    $type = $_GET['type'];
    $field = $_GET['field'];
    // search and display from the database where $type = $field
    $db->search_nh($type, $field);

} else {

    // required parameters missing
    $error_msg = "Required parameters missing!";

}

?>