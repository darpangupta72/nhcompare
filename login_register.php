
<?php

// button pressed 
if (isset($_POST['command'])) {

    switch ($_POST['command']) {
        
        case 'login':
        
        require_once('login.php');
        if($success == TRUE){
            session_start();
            $_SESSION["username"]=$_POST['username'];
            $_SESSION["password"]=$_POST['password'];
            header("Location: admin_welcome_html.php");}
        else if($success == FALSE && $error_msg == "") {    
        }
        else 
            echo $error_msg;
        break;
        
        case 'register':
        
        require_once('register.php');
        if($success == TRUE) 
        //header("Location: login_html.php");
            echo "Successfully registered.";
        else if($success == FALSE && $error_msg == "") { }
        else 
            echo $error_msg;
        break;
    
    }

}


?>