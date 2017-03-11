<?php

require_once 'db_connect.php';
$conn = pg_connect( "$host $port $dbname $credentials");
  
$sql = "SELECT * FROM login";
$result = pg_query($conn, $sql);

if(! $result) 
	echo "Query failed!";
else{

	$extra = "admi";
	while($row = pg_fetch_assoc($result)) {	

		//encrypting the given non-encrypted password and setting up usernames and passwords for admins
		$username = $row['username'];
		$password = $row['password'];
		
		if($row['type'] == 'a') {
			$username_new = explode("@", $row['username'])[0];
			$encrypted = base64_encode(sha1($username_new.$extra, TRUE) . $extra);
		} else {
			$username_new = $username;
			$encrypted = base64_encode(sha1($password.$extra, TRUE) . $extra);
		}
		
		$sql = "UPDATE login SET password = '$encrypted', username = '$username_new' WHERE username = '$username'";
		$result1 = pg_query($conn, $sql);

    }

}

pg_close($conn);

?>