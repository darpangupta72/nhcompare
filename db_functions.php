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
	  $extra = "admi";
 	  $pass = base64_encode(sha1($password.$extra, true) . $extra);
	
    while($row = pg_fetch_assoc($result)) {	
      if($row['password'] == $pass)   
        return TRUE;
    }

    return FALSE;

  }

  // checking if username already exists
  function isExistUsername($username) {

    $sql = 'SELECT username FROM login';
    $result = pg_query($this->conn, $sql);

    while($row = pg_fetch_assoc($result)) { 
      if($row['username'] == $username)   
        return TRUE;
    }

    return FALSE;

  }

  // storing new user in database
  function storeUser($username, $password, $type = 'u') {

    //encrypting the given non-encrypted password
		$extra = "admi";
		$encrypted = base64_encode(sha1($password.$extra, true) . $extra);
	  $password_new = $encrypted;
  
    $sql = "INSERT INTO login VALUES('$username', '$password_new', '$type')";
    $result = pg_query($this->conn, $sql);

    if(! $result) 
      return FALSE;
    return TRUE;

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

  function getType($username) {

    $sql = "SELECT type FROM login WHERE username = '$username'";
    $result = pg_query($this->conn, $sql);
    $row = pg_fetch_assoc($result);
    return $row['type'];

  }

  function search_nh($type, $field) {

    $sql = "CREATE VIEW NH AS SELECT provnum, provname FROM provider_info WHERE UPPER($type) = UPPER('$field');" . 
           " SELECT count(*) FROM NH";
    $result = pg_query($this->conn, $sql);
    $count = pg_fetch_assoc($result)['count'];
    
    $sql = "SELECT * FROM NH";
    $result = pg_query($this->conn, $sql);

    echo "<br><center>Your search returned " . $count . " results.</center><br>";

    if($count > 0) {
      
      echo "<center><table border='1'><tr><th>Provider No.</th><th>Provider Name</th></tr>";

      while($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['provnum']."</td>";
        echo "<td>".$row['provname']."</td>";
        echo "</tr>";    
      }

      echo "</table></center>";

    }

    $sql = "DROP VIEW NH";
    $result = pg_query($this->conn, $sql);
  
  }

}

?>