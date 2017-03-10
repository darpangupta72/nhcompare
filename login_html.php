<?php
require_once 'test.php';
?>
 <html>
 <head>
  <title>LOGIN NHC</title>
  
 <style>
li {list-style: none;}
body{
	background-color: #FFFFFF;
	background: url(123.jpg) no-repeat center;
}
</style>
</head>
<body>
<center>
<h2> <font color=#000000>Welcome to NURSING HOME COMPARE</font></h2>
</center>
<div style=" position: relative; 
  		top: 20%;"
  	>
<ul>
<center>
<form method="POST">
	<li>Username:<input type="text" name="Username" /></li>
	<li>Password:  <input type="password" name="Password" /></li>
	<br>
	<li>&emsp;&emsp;&emsp;&emsp;<button name="command" value="login">LOGIN</button> &emsp; <button name="command" value="register">SIGN UP</button> </li>
</form>
</center>
</ul>
</div>
</body>
</html>
