<?php

 session_start();
 if(!isset($_SESSION['username']))
 {
    header("Location: login_html.php");
 }
 $name=$_SESSION['username'];
 ?>
 
<html>
    <head>
        <title>ADMIN TOGGLE MENU</title>
    
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
            <h2> <font color=#000000>NURSING HOME COMPARE</font></h2>
            <h4> <i><font color=#000000 >A system to compare nursing homes across USA</font></i></h4><hr>
        </center>

        <center>
            <font color=#000000>Welcome <?php echo "$name"; ?></font>
        </center>

<form method="post">
  <label class="logoutLblPos">
  <button name="command" value="logout">LOGOUT</button>
  </label>
</form>
        <div style=" position: relative; 
            top: 20%;">
            <ul>
            <center>

                <a href="general_user_html.php">GENERAL USER SCREEN</a>
                &emsp;&emsp;
                <a href="nh_welcome_html.php">NURSING HOME USER SCREEN</a>
                &emsp;&emsp;
                <a href="login_manage_html.php">LOGIN MANAGEMENT</a>
            </center>
            </ul>
        </div>
    </body>

</html>

<?php
if(isset($_POST['command']))
{
    session_unset();
    session_destroy();
    header("Location: login_html.php");
}
?>