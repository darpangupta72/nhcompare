<?php
session_start();
?>
 
<?php

require_once 'db_functions.php';
$db = new db_functions();

$success = FALSE;
$error_msg = "";
$type = "";

// both parameters received 
if (isset($_POST['username']) && isset($_POST['password'])) {

    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];

    // get the user by username and password
    $user = $db->getUser($username, $password);

    // checking if credentials are correct
    if ($user == TRUE) {
        $success = TRUE;
        $type = $db->getType($username);
    } else {
        $error_msg = "Incorrect credentials. Please try again!";
    } 

} else {

    // required parameters missing
    $error_msg = "Required parameters missing!";

}

?>