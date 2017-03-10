<?php
require_once('login.php');
require_once('register.php');
// button pressed 
if (isset($_POST['command'])) {

    switch ($_POST['command']) {
        
        case 'login':
        include 'login.php';
        break;
        
        case 'register':
        include 'register.php';
        break;
    
    }

}

?>