<?php
$name= '';$usertype='s';
 session_start();
 if(!isset($_SESSION['username'])){
     header("Location: login_html.php");
 }
 else {$name=$_SESSION['username'];
        $usertype=$_SESSION['usertype'];}
?>

<html>
    <head>
        <title>CHANGE PASSWORD</title>
    
         <style>
            li{list-style: none; }
            body{
                    background-color: #FFFFFF;
                    background: url(123.jpg) center;
                }
            h1, h2, h3, h5, h6 {
                 padding: 0;
                 margin-bottom: 0;
            }

            h4{   
                margin-top: 0.15cm;
                margin-bottom: 0.4cm;
            }
        </style>
            <?php 
                require_once('styling.php');
            ?>
        
    </head>
    
    <body>
        <center>
            <h2> <font color=#000000>NURSING HOME COMPARE</font></h2>
            <h4> <i><font color=#000000 >A system to compare nursing homes across USA</font></i></h4><hr>
        </center>
        <?php
            require_once 'logout_home.php';
        ?>
        <div style=" position: absolute; top: 25%; left: 38%">
            <ul>
                <form action = "change_pass_html.php" method="POST">
                    <li>Enter New Password:  <input type="password" name="password" /></li><br>
                    <li>Confirm Password:  <input type="password" name="passwordc" /></li><br>
                    <li><center><button name="command" value="change">CHANGE PASSWORD</button></center></li>
                </form>
            </ul>            
        </div>
    </body>
</html>


<?php

require_once 'db_functions.php';
$db = new db_functions();


if(isset($_POST['command'])) {
    switch ($_POST['command']) {
        case 'logout':
            session_unset();
            session_destroy();
            header("Location: login_html.php");
            break;
        case 'change':
            $pass=$_POST['password'];$passc=$_POST['passwordc'];
            if($pass != $passc){ echo "<center>Passwords do not match!!</center>";}
            else{
            $db->editUser($name,$pass);
            }
            break;
        case 'home':
            if($usertype == 'a' || $usertype == 's')
                header("Location: admin_welcome_html.php");
            else if($usertype == 'n')
                    header("Location: search_nh_html.php");
                 else
                    header("Location: general_user_html.php");                
            break;   
        default:
            break;
    }
}

?>