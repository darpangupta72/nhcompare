<?php

require_once 'db_functions.php';
$db = new db_functions();

// command type set 
if (isset($_POST['command'])) {

	if($_POST['command'] == "insert") {

		if(isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type'])) {

			if(($_POST['usertype'] == 'a' && ($_POST['type'] == 'n' || $_POST['type'] == 'u')) || ($_POST['usertype'] == 's' && ($_POST['type'] == 'a' || $_POST['type'] == 'n' || $_POST['type'] == 'u'))) {

				$username = $_POST['username'];
				$password = $_POST['password'];
				$type = $_POST['type'];
				$error_msg = "";

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
        				$user = $db->storeUser($username, $password, $type);

        				// checking if user successfully registered
        				if ($user) 
            				echo "<center>User successfully registered.</center";
        				else $error_msg = "An error occurred during registration!";

        			}

        			echo "<center>" . $error_msg . "</center>";

        		}

			else echo "<center>Incorrect parameter values!</center";

		}

		else echo "<center>Required parameters missing!</center";

	}

	else if($_POST['command'] == "delete") { 

		if(isset($_POST['usertype']) && isset($_POST['username'])) {

			$username = $_POST['username'];
			if($db->isExistUsername($username) == TRUE) {

				$type = $db->getType($username);
				if(($_POST['usertype'] == 'a' && ($type == 'n' || $type == 'u')) || ($_POST['usertype'] == 's' && ($type == 'a' || $type == 'n' || $type == 'u'))) {
					
					$db->deleteUser($username);
					echo "<center>User successfully deleted.</center";
				
				}

				else echo "<center>Incorrect parameter values!</center";

			}

			else echo "<center>Given user does not exist in database!</center>"; 

		} 

		else echo "<center>Required parameters missing!</center";
	
	}

	else echo "<center>Incorrect parameter values!</center";

} else {

    // required parameters missing
    echo "<center>Required parameters missing!</center";

}

?>