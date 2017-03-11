 <html>
 <head>
  <title>LOGIN NHC</title>
  
 <style>
li {list-style: none;}
body{
	background-color: #FFFFFF;
	background: url(123.jpg) center;
}
</style>
</head>
<body>
<center>
<h2> <font color=#000000>Welcome to NURSING HOME COMPARE</font></h2>
</center>
<div style=" position: absolute; top: 20%; left: 38%">
<ul>
<center>
<form action = "login_html.php" method="POST">
	<li>Username:<input type="text" name="username" /></li>
	<li>Password:  <input type="password" name="password" /></li>
	<br>
	<li>&emsp;&emsp;&emsp;&emsp;<button name="command" value="login">LOGIN</button> &emsp; <button name="command" value="register">SIGN UP</button> </li>
</form>
</center>
</ul>
</div>
</body>
<center>
<?php
error_reporting(0);
// button pressed 
require_once('login_register.php');
?>
</center>
</html>
