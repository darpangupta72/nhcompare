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
            <?php 
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

        <?php
            require_once 'logout_home.php';
        ?>
        <div style=" position: relative; top: 28%;">
            <ul>
            <center>
            <br>
                <a href="search_nh_html.php">SEARCH NURSING HOME</a>
                &emsp;&emsp;&emsp;
                <a href="penalties.php">SEE PENALTY COUNT</a>
                &emsp;&emsp;&emsp;
                <?php echo "<a href=\"view_feedback.php?provnum=".$name."\">VIEW FEEDBACK</a>"; ?>
                &emsp;&emsp;&emsp;
                <a href="staff_info.php">STAFF INFO</a>
                &emsp;&emsp;&emsp;
                <a href="deficiencies.php">INSPECTION RESULTS</a>&emsp;&emsp;
            </center>
            </ul>
        </div>
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
?>