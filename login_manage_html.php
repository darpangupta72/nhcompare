<html>
    <head>
        <title>LOGIN MANAGEMENT SYSTEM</title>
    
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
            <?<?php 
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

        <div style=" position: absolute; top: 25%; left: 38%">
            <ul>
                <form action = "login_manage_html.php" method="POST">
                    <li>Type of Operation: <select name="command" id="command">
                            <option value = "insert">Insert</option>
                            <option value = "delete">Delete</option>
                            <option value = "a">State</option>
                        </select>
                    </li><br>
                    <input type="submit" value="Change">
                </form>
            </ul>            
        </div>
    </body>
</html>


<?php
if(isset($_POST['command'])) {
    session_unset();
    session_destroy();
    header("Location: login_html.php");
}

if(isset($_POST['type'])){
    $type=$_POST['type'];$name='';
    echo "<div style=\" position: absolute; top: 25%; left: 38%\"><ul>";
    echo "<center><form action = "login_manage.php" method="POST">";
    echo "<input type=\"hidden\" name=\"type\" value=\"$type\">";
    echo "<li>Username: <input type=\"text\" name=\"username\" /></li>";

    if($type == )
                        <li>Password:  <input type="password" name="password" /></li>
                        <br>
                        <li>Search On: <select name="type" id="type">
                            <option value = "u">County Name</option>
                            <option value = "n">County SSA Code</option>
                            <option value = "a">State</option>
                        </select>
                    </li><br>
                        <li>&emsp;&emsp;&emsp;&emsp;<button name="command" value="login">LOGIN</button> &emsp; <button name="command" value="register">SIGN UP</button> </li>
                    </form>
                </center>
            </ul>
?>