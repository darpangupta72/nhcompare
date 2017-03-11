<?php

// button pressed 
if (isset($_POST['command'])) {

    switch ($_POST['command']) {
        
        case 'login':
        require_once('login.php');
        break;
        
        case 'register':
        require_once('register.php');
        break;
    
    }

}

if($success == TRUE)
{
	header("Location: admin_welcome_html.php");
}
else if($success == FALSE && $error_msg == "") {}
else {
	echo $error_msg;
}
?>