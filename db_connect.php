<?php

$u_agent = $_SERVER['HTTP_USER_AGENT']; 

// database configuration variables
$host = "host = localhost";
$port = "port = 5432";
            
// First get the platform
// For Darpan, Pranjal
if (preg_match('/linux/i', $u_agent)) {
	$dbname = "dbname = nhc";
	$credentials = "user = postgres password = Dddddd1.";
} elseif (preg_match('/windows|win32/i', $u_agent)) {
	$dbname = "dbname = postgres";
	$credentials = "user = postgres password = mihir.k";
}

?>