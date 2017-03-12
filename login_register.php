
<?php

// button pressed 
if (isset($_POST['command'])) {

    switch ($_POST['command']) {
        
        case 'login':
        
        require_once('login.php');
        if($success == TRUE){
            session_start();
            $_SESSION['username']=$_POST['username'];
            $_SESSION['password']=$_POST['password'];
            $_SESSION['usertype']=$type;
            if($type=='s'||$type=='a') 
                header("Location: admin_welcome_html.php");

            if($type=='n')
                header("Location: nh_welcome_html.php");

            if($type=='u')
                header("Location: general_user_html.php");

        }
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