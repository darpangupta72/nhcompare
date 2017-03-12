<?php

 session_start();
 if(!isset($_SESSION['username']))
 {
    //header("Location: login_html.php");
 }
 else{$name=$_SESSION['username'];}
?>
 
<!DOCTYPE html>
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

        <div style=" position: absolute; top: 30%; left:-1cm">
            <ul>
                <form action = "search_nh_html.php" method="GET">
                    <li>Search On: <select name="type" id="type">
                            <option value="select">--SELECT--</option>
                            <option value = "city">City</option>
                            <option value = "county_name">County Name</option>
                            <option value = "county_ssa">County SSA Code</option>
                            <option value = "state">State</option>
                            <option value = "zip">Zip Code</option>
                        </select>
                    </li><br>
                    <input type="submit" value="Show">
                </form>
            </ul>
        </div>

    </body>

</html>

<?php
if(isset($_GET['command'])) {

    switch ($_GET['command']) {

        case 'logout':

            session_unset();
            session_destroy();
            header("Location: login_html.php");
            break;
        
        case 'submit':
            require_once 'search_nh.php';
            break;
        default:
            # code...
            break;
    }

}

if(isset($_GET['type'])){
                $type=$_GET['type'];$name='';

                if($type=="select"){}
                else {
                    switch ($type) {
                        case 'city': $name = 'City'; break;
                        case 'state': $name = 'State'; break;
                        case 'county_name': $name = 'County Name'; break;
                        case 'county_ssa': $name = 'County SSA Code'; break;
                        case 'zip': $name = 'Zip Code'; break;
                        default: $name = 'WTF!!'; break;
                    }

                    echo "<div style=\" position: absolute; top: 50%; left:-1cm\"><ul>";
                    echo "<form action = \"search_nh_html.php\" method=\"GET\">";
                    echo "<input type=\"hidden\" name=\"type\" value=\"$type\">";
                    echo "<li> $name: <input type=\"text\" name=\"field\" /></li><br>";
                    echo "<li>&emsp;&emsp;&emsp;<button name=\"command\" value=\"submit\">SUBMIT</button></li></form></ul></div>";  
                }
}

?>