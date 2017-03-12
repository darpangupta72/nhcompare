<?php
$name= '';$provnum='';
 session_start();
 if(!isset($_SESSION['username'])){
 //    header("Location: login_html.php");
 }
 else {$name=$_SESSION['username'];}
 
 if(isset($_GET['provnum'])){
    $provnum = $_GET['provnum'];
 }
 ?>
<html>
    <head>
        <title>GIVE FEEDBACK</title>
    
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

        <center><div style=" position: relative; top: 20%;">
            <ul><?php echo "Welcome $name, we would like to know your feedback about $provnum<br>"; ?><br>
                <form action = "give_feedback_html.php" id="feedback" method="POST">
                    <?php 
                        echo "<input type=\"hidden\" name=\"username\" value=\"$name\">";
                        echo "<input type=\"hidden\" name=\"provnum\" value=\"$provnum\">";
                    ?>
                    <li>Score: <select name="score" id="score">
                            <option >1</option>
                            <option >2</option>
                            <option >3</option>
                            <option >4</option>
                            <option >5</option>
                        </select>
                    </li><br>
                    <textarea name="comment" id="comment" cols="50" rows="5" maxlength="250" form="feedback">Enter text here(upto 250 characters)...</textarea>
                    <li><button name="command" value="submit">SUBMIT</button></li>
                </form>
            </ul>
        </div></center>
    </body>
</html>    

<?php
if(isset($_POST['command'])) {
    switch ($_POST['command']) {
        case 'logout':

            session_unset();
            session_destroy();
            header("Location: login_html.php");
            break;
        
        case 'submit':
            echo "<center><div style=\" display: block; margin-top:80px !important;\"><ul>";
            require_once 'give_feedback.php';
            echo "</div></center>";
            break;
        default:
            # code...
            break;
    }
}
?>