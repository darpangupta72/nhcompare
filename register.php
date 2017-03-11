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

    // checking if username is of appropriate length
    if(strlen($username) < 6 || strlen($username) > 15)
        $error_msg = "Username should be b/w 6 and 15 characters long!";
    // checking if username is available
    else if($db->isExistUsername($username))
        $error_msg = "Username already in use!";
    // checking if password is of appropriate length
    else if(strlen($password) < 6 || strlen($password) > 15) 
        $error_msg = "Password should be b/w 6 and 15 characters long!";
    // all checks passed; add user to database
    else {
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