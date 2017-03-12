<?php

require_once 'db_functions.php';
$db = new db_functions();

$success = FALSE;
$error_msg = "";

// both parameters received 
if (isset($_POST['zip'])) {

    // receiving the post params
    $zip = $_POST['zip'];
    // get the user by username and password
    $db->search_nh($zip);

} else {

    // required parameters missing
    $error_msg = "Required parameters missing!";

}

?>