<?php
$name= '';$usertype='a';
 session_start();
 if(!isset($_SESSION['username'])){
 //    header("Location: login_html.php");
 }
 else {$name=$_SESSION['username'];$usertype=$_SESSION['usertype'];}
 ?>
<html>
    <head>
        <title>PENALTY COUNT</title>
    
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
                <?php
                    if($usertype == 'a' || $usertype == 'n' || $usertype == 's') {
                        echo "<form action = \"penalties.php\" method=\"POST\">";
                            if($usertype == 'n') 
                                echo "<input type=\"hidden\" name=\"provnum\" value=\"$name\">";
                            else if($usertype == 'a' || $usertype == 's') 
                                echo "<li>Provider No.: <input type=\"text\" name=\"provnum\">";
                        echo "<input type=\"submit\" value=\"Show\"></form></li>";
                    }
                    else echo "You are not authorised to view inspection results";                    
                ?>
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
    if($usertype != 'n' ||$usertype != 'a' ||$usertype != 's'){
        echo "<div style=\" margin-top:0px !important; margin-left:25%;\"><ul><br>";
        $db->show_penalties($provnum);
    }
    else {}

}

?>