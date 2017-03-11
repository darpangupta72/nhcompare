<?php

 session_start();
 if(!isset($_SESSION['username']))
 {
    //header("Location: login_html.php");
 }
 else{$name=$_SESSION['username'];}
?>
 
<html>
    <head>
        <title>SEARCH NURSING HOME</title>
    
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

        <form method="post">
            <label class="logoutLblPos">
                <button name="command" value="logout">LOGOUT</button>
            </label>
        </form>

        <div style=" position: absolute; top: 30%; left:0cm">
            <ul>
                <form action = "search_nh_html.php" method="POST">
                    <li>Zip Code: <input type="text" name="zip" /></li><br>
                    <li>Zip Code: <input type="text" name="zip" /></li><br>
                    <li>Zip Code: <input type="text" name="zip" /></li><br>
                    <li>Zip Code: <input type="text" name="zip" /></li><br>
                    <li>Zip Code: <input type="text" name="zip" /></li><br>
                    <li>Zip Code: <input type="text" name="zip" /></li><br>
                    <li>&emsp;&emsp;&emsp;<button name="command" value="submit">SUBMIT</button></li>
                </form>
            </ul>
        </div>

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
            require_once 'db_connect.php';
            $conn = pg_connect("$host $port $dbname $credentials");
            $zip=$_POST['zip'];
            $sql = "SELECT provnum, provname, state FROM provider_info WHERE state = '$zip'";
            $result = pg_query($conn,$sql);

            echo "<center><table border='1'><tr><th>Provider No.</th><th>Provider Name</th><th>Zip Code</th></tr>";

            while($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['provnum']."</td>";
                echo "<td>".$row['provname']."</td>";
                echo "<td>".$row['state']."</td>";
                echo "</tr>";    
            }

            echo "</table></center>";
            break;
        default:
            # code...
            break;
    }
}
?>