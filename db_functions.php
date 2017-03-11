<?php

class db_functions {

  private $conn;

  function __construct() {

    // connecting to database
    require_once 'db_connect.php';
    $this->conn = pg_connect( "$host $port $dbname $credentials");

  }

  function __destruct() {  

    //closing connection
    pg_close($this->conn);
    
  }

  // get user by username and password
  function getUser($username, $password) {

    $sql = "SELECT * FROM login WHERE username = '$username'";
    $result = pg_query($this->conn, $sql);

	  //encryption(Assuming encrypted password is saved in database)
	  //$extra = "admi";
 	  //$pass = base64_encode(sha1($password.$extra, true) . $extra);
	
    while($row = pg_fetch_assoc($result)) {	
      if($row['password'] == $password)   
        return TRUE;
    }

    return FALSE;

  }

  // checking if username already exists
  function isExistUsername($username) {

    $sql = 'SELECT username FROM users';
    $result = mysqli_query( $this->conn, $sql );

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
      if($row['username']==$username)
        return true;
    }

    return false;

  }

  // storing new user in database
  function storeUser($username, $passwordne, $name, $email, $mobile, $hostel_apartments, $type) {

    //encrypting the given non-encrypted password
		$extra = "admi";
		$encrypted = base64_encode(sha1($passwordne.$extra, true) . $extra);
	    $password=$encrypted;
  
    $sql = "INSERT INTO users(username, password, name, emailId, mobile, hostel_apartments, userType) VALUES('$username', '$password', '$name', '$email', 
      '$mobile', '$hostel_apartments', '$type')";
    $result = mysqli_query( $this->conn, $sql );

    if(! $result ) 
      return false;
    return true;

  }

  // editing user details in database
  function editUser($id, $passwordne, $name, $email, $mobile) {

    //encrypting the given non-encrypted password
    $extra = "admi";
    $encrypted = base64_encode(sha1($passwordne.$extra, true) . $extra);
    $password=$encrypted;
  
    $sql = "UPDATE users SET password = '$password', name='$name', emailId = '$email', mobile = '$mobile' WHERE userId = $id";
    $result = mysqli_query( $this->conn, $sql );

    if(! $result )
      return false;
    return true;

  }

}

?>