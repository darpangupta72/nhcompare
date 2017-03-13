<?php
$name= 'Random user';$usertype='u';
 session_start();
 if(!isset($_SESSION['username'])){
 //    header("Location: login_html.php");
 }
 else {$name=$_SESSION['username'];$usertype=$_SESSION['usertype'];}
 ?>
<html>
    <head>
        <title>NORMAL USER TOGGLE MENU</title>
    
         <style>
            li{list-style: none;}
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
            <h2 > <font color=#000000>NURSING HOME COMPARE</font></h2>
            <h4> <font color=#000000><i>A system to compare nursing homes across USA</i></font></h4><hr>
        </center>
        <?php
            require_once 'logout_home.php';
            if($usertype='s'||$usertype='a') {
                echo "<form action = \"view_feedback.php\" method=\"GET\">";
                echo "<li>Provider No.: <input type=\"text\" name=\"provnum\">";
                echo "<input type=\"submit\" value=\"Show\"></form></li>";
            }
    
        ?>

    </body>

</html>    

<?php
if(isset($_POST['command']))
{   
    switch ($_POST['command']) {
        case 'logout':
            session_unset();
            session_destroy();
            header("Location: login_html.php");
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
require_once 'db_functions.php';
$db = new db_functions();

// provnum parameter received 
if (isset($_GET['provnum'])) {

    // receiving the get params
    $provnum = $_GET['provnum'];
    // search and display from the database where $type = $field
    $db->view_feedback($provnum);
    
} else {

    // required parameters missing
    $error_msg = "Required parameters missing!";
    echo "<center>$error_msg</center>";

}

?>