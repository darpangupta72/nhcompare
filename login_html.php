<?php
require_once 'test.php';
?>
 <html>
 <head>
  <title>LOGIN NHC</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style>
li {list-style: none;}
body{
	background-color: #F8C471;
	
}
</style>
</head>
<div top: 50%;>
	<body>
<h2> <font color=#000000>Welcome to NURSING HOME COMPARE</font></h2>
<ul>
<form method="POST">
	<li>Username: <input type="text" name="Username" /></li>
	<li>Password: <input type="password" name="Password" /></li>
	<br>
	<button name="command" value="login">LOGIN</button>
</form>
</ul>
</body>

</div>
#outPopUp {
  position: absolute;
  width: 300px;
  height: 200px;
  z-index: 15;
  top: 50%;
  left: 50%;
  margin: -100px 0 0 -150px;
  background: red;
}
</html>
