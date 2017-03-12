<?php
$name= 'Random user';
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
        <center>
            <font color=#000000>Welcome <?php echo "$name"; ?></font>
        </center>

<form method="post">
  <label class="logoutLblPos">
  <button name="command" value="logout">LOGOUT</button>
  </label>
</form>

        <div style=" position: relative; top: 50%;">
            
            <ul>
            <center>
                <br>
                <a href="search_nh_html.php">SEARCH NURSING HOMES</a>
                &emsp;&emsp;&emsp;
                <a href="give_feedback_html.php">GIVE FEEDBACK</a>
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