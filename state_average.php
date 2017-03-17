<?php
$name='';$usertype='n';
 session_start();
 if(!isset($_SESSION['username']))
 {
    header("Location: login_html.php");
 }
 else{$name=$_SESSION['username'];$usertype=$_SESSION['usertype'];}
?>
 
<!DOCTYPE html>
    <head>
        <title>STATE AVERAGE</title>
    
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
        <div style=" position: absolute; top: 20%; left:0cm">
            <ul>
                <form action = "state_average.php" method="GET">
                    <li>STATE <input type="text" name="state"/></li><br>
                    <input type="submit" value="SUBMIT">
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
        
        case 'home':
            if($usertype == 'a' || $usertype == 's')
                header("Location: admin_welcome_html.php");
            else if($usertype == 'n')
                    header("Location: nh_welcome_html.php");
                 else
                    header("Location: general_user_html.php");   
            break;             
        default:
            break;
    }

}

if(isset($_GET['state'])) {
    $state=$_GET['state'];
    $sql="SELECT * FROM averages WHERE state='$state'";

    require_once 'db_connect.php';
        $conn = pg_connect("$host $port $dbname $credentials");
        $result = pg_query($conn, $sql);
        echo "<br><br><br><center> STATE RESULTS</center><br>";
        echo "<center><table border='1'><tr><th>State</th><th>Cycle 1 standard</th><th>Cycle 2 standard</th><th>Cycle 3 standard</th><th>Cycle 1 complaint</th><th>Cycle 2 complaint</th><th>Cycle 3 complaint</th><th>No of fines</th><th>Fine Amount</th></tr>";

        $rowpv = pg_fetch_assoc($result); 
        echo "<tr>";
        echo "<td><center>".$rowpv['state']."</center></td>";
        echo "<td><center>".$rowpv['st_1']."</center></td>";
        echo "<td><center>".$rowpv['st_2']."</center></td>";
        echo "<td><center>".$rowpv['st_3']."</center></td>";
        echo "<td><center>".$rowpv['c_1']."</center></td>";
        echo "<td><center>".$rowpv['c_2']."</center></td>";
        echo "<td><center>".$rowpv['c_3']."</center></td>";
        echo "<td><center>".$rowpv['num']."</center></td>";
        echo "<td><center>".$rowpv['sum']."</center></td>";
        echo "</tr>";    

        echo "</table></center>";
        if(!$result){ echo "<center>Something went wrong!</center>";
        pg_close($conn);
}

}

?>