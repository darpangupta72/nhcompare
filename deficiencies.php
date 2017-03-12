<?php
$name= '015010';
 session_start();
 if(!isset($_SESSION['username'])){
 //    header("Location: login_html.php");
 }
 else {$name=$_SESSION['username'];}
 ?>
<html>
    <head>
        <title>NORMAL USER TOGGLE MENU</title>
    
         <style>
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
            <?<?php 
                require_once('styling.php');
            ?>
    </head>
    
    <body>
        <center>
            <h2 > <font color=#000000>NURSING HOME COMPARE</font></h2>
            <h4> <font color=#000000><i>A system to compare nursing homes across USA</i></font></h4><hr>
        </center>
        <form method="post">
            <label class="logoutLblPos">
                <button name="command" value="logout">LOGOUT</button>
            </label>
        </form>
        <div style=" position: absolute; top: 25%; left: 0%">
            <ul>
                <form action = "deficiencies.php" method="POST">
                    <?php echo "<input type=\"hidden\" name=\"provnum\" value=\"$name\">"; ?>
                    <input type="submit" value="Show">
                </form>
            </ul>            
        </div>
    </body>

</html>    

<?php

require_once 'db_functions.php';
$db = new db_functions();

if(isset($_POST['command'])) {
    session_unset();
    session_destroy();
    header("Location: login_html.php");
}

if(isset($_POST['provnum'])) {

    $provnum=$_POST['provnum'];
    echo "<div style=\" margin-top:0px !important; margin-left:25%;\"><ul><br>";
    $db->show_deficiencies($provnum);

}

?>