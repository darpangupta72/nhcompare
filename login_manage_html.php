<?php
$name= '';$usertype='s';
 session_start();
 if(!isset($_SESSION['username'])){
 //    header("Location: login_html.php");
 }
 else {$name=$_SESSION['username'];
        $usertype=$_SESSION['usertype'];}
?>

<html>
    <head>
        <title>LOGIN MANAGEMENT SYSTEM</title>
    
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
                <form action = "login_manage_html.php" method="POST">
                    Operation: <select name="type" id="type">
                            <option value = "insert">Insert</option>
                            <option value = "delete">Delete</option>
                        </select>
                    &emsp;&emsp;<input type="submit" value="Change">
                </form>
            </ul>            
        </div>
    </body>
</html>


<?php

if(isset($_POST['type'])){

    $command=$_POST['type'];$name='';
    echo "<div style=\" position: absolute; top: 35%; left: 38%\"><ul>";
    echo "<center><form action = \"login_manage_html.php\" method=\"POST\">";
    echo "<li>Username:<input type=\"text\" name=\"username\" /></li>";

    switch ($command) {
        case 'insert':
            $name='Insert';
            echo "<li>Password:  <input type=\"password\" name=\"password\" /></li><br>";
            echo "<li>Usertype: <select name=\"type\" id=\"type\">";
             echo "<option value = \"u\">General User</option>";
             echo "<option value = \"n\">Nursing Home</option>";
             if($usertype=='s')
                echo "<option value = \"a\">Admin</option>";
            echo "</select></li><br>";
            break;
        case 'delete':
            $name = 'Delete';
            echo "<br>";
            break;
        default:
            $name='No Value Set';
            echo "<br>";
            break;
    }
    echo "<li><center><button name=\"command\" value=\"$command\">$name</button></center></li>";            
    echo "</form></center></ul></div>";
}    

if(isset($_POST['command'])) {
    switch ($_POST['command']) {
        case 'logout':
            session_unset();
            session_destroy();
            header("Location: login_html.php");
            break;
        case 'insert':
        case 'delete':
            echo "<center><div style=\" \">";
            require_once 'login_manage.php';
            echo "</div></center>";
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