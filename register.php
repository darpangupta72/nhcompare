<?php

require_once 'db_functions.php';
$db = new db_functions();

$success = FALSE;
$error_msg = "";

// all parameters received 
if (isset($_POST['username']) && isset($_POST['password'])) {

    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];

    // checking if username is already registered or password field is less than 8 characters
    if($db->isExistUsername($username)) {

        $error_msg = "Username already in use!";
    
    } else if(strlen($password) < 8) {

        $error_msg = "Password should be of minimum 8 characters!";

    } else {

        // creating and storing the new user
        $user = $db->storeUser($username, $password);

        // checking if user successfully registered
        if ($user) 
            $success = TRUE;
        else
            $error_msg = "An error occurred during registration!";

    }

} else {

    // required parameters missing
    $error_msg = "Required parameters missing!";

}

?>