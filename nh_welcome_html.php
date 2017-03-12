<?php
$name='Random nursing';
 session_start();
if(!isset($_SESSION['username'])){
    //header("Location: login_html.php");
    }
else {$name=$_SESSION['username'];}
 ?>

<html>
    <head>
        <title>NURSING HOME USER TOGGLE MENU</title>
    
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
            <h4><i> <font color=#000000 style="italic">A system to compare nursing homes across USA</font></i></h4><hr>
       </center>
        <center>
            <font color=#000000>Welcome <?php echo "$name"; ?></font>
        </center>

<form method="post">
  <label class="logoutLblPos">
  <button name="command" value="logout">LOGOUT</button>
  </label>
</form>
        <div style=" position: relative; top: 28%;">
            <ul>
            <center>
            <br>
                <a href="search_nh_html.php">SEARCH NURSING HOME</a>
                &emsp;&emsp;&emsp;
                <a href="">SEE PENALTY COUNT</a>
                &emsp;&emsp;&emsp;
                <a href="">USER FEEDBACK TO YOUR NURSING HOME</a>
                &emsp;&emsp;&emsp;
                <a href="">STAFF INFO</a>
                &emsp;&emsp;&emsp;
                <a href="">INSPECTION RESULTS</a>&emsp;&emsp;
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