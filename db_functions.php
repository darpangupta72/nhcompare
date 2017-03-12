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

  function search_nh($type, $field, $order) {

    $order_list = array("overall_rating", "survey_rating", "quality_rating", "staffing_rating", "rn_staffing_rating",
                        "user_score");

    for($i = 1; $i < 6; $i++) {
      if($order_list[$i] == $order) {
        for($j = $i; $j > 0 ; $j--)
          $order_list[$j] = $order_list[$j - 1];
        $order_list[0] = $order;
      }
    }

    $final = $order_list[0];
    $final1 = $order_list[0];
    $names = array("", "", "", "", "", "", "");
    
    for($i = 0; $i < 6; $i++) {

      switch ($order_list[$i]) {

        case 'overall_rating': $names[$i] = "Overall Rating"; break; 
        case 'survey_rating': $names[$i] = "Health Inspection Rating"; break;
        case 'quality_rating': $names[$i] = "QM Rating"; break;
        case 'staffing_rating': $names[$i] = "Staffing Rating"; break;
        case 'rn_staffing_rating': $names[$i] = "RN Staffing Rating"; break;
        case 'user_score': $names[$i] = "User Rating"; break;
        default: break;
      
      }

      if($i > 0)
        $final = $final . ", " . $order_list[$i];

      $final1 = $final1 . " DESC NULLS LAST, ".$order_list[$i];  

    }

    $sql = "CREATE TABLE V1 AS SELECT * FROM provider_info; ALTER TABLE V1 ADD COLUMN user_score numeric; UPDATE V1 SET user_score = (SELECT round(AVG(score)::numeric, 2) FROM feedback GROUP BY feedback.provnum) FROM feedback WHERE V1.provnum = feedback.provnum;";
    $result = pg_query($this->conn, $sql);

    $sql = "CREATE VIEW NH AS SELECT provnum, provname, " . $final . " FROM V1 WHERE UPPER($type) = UPPER('$field') ORDER BY " . $final1 . " DESC NULLS LAST, provnum DESC; SELECT count(*) FROM NH";
    $result = pg_query($this->conn, $sql);
    $count = pg_fetch_assoc($result)['count'];
    
    $sql = "SELECT * FROM NH";
    $result = pg_query($this->conn, $sql);

    echo "<br><center>Your search returned " . $count . " results.</center><br>";

    if($count > 0) {
      
      echo "<center><table border='1'><tr><th>Provider No.</th><th>Provider Name</th><th>$names[0]</th><th>$names[1]</th><th>$names[2]</th><th>$names[3]</th><th>$names[4]</th><th>$names[5]</th><th>$names[6]</th></tr>";

      while($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><a href=\"search_nh_details.php?".$row['provnum']."\"><center>".$row['provnum']."<center/></a></td>";
        echo "<td>".$row['provname']."</td>";
        echo "<td><center>".$row[$order_list[0]]."<center/></td>";
        echo "<td><center>".$row[$order_list[1]]."<center/></td>";
        echo "<td><center>".$row[$order_list[2]]."<center/></td>";
        echo "<td><center>".$row[$order_list[3]]."<center/></td>";
        echo "<td><center>".$row[$order_list[4]]."<center/></td>";
        echo "<td><center>".$row[$order_list[5]]."<center/></td>";
        echo "</tr>";    
      }

      echo "</table></center>";

    }

    $sql = "DROP VIEW NH; DROP TABLE V1";
    $result = pg_query($this->conn, $sql);
  
  }

  function details_nh($provnum) {

  	$sql = "SELECT * FROM provider_info WHERE provnum = '$provnum'";
    $result = pg_query($this->conn, $sql);
    $row = pg_fetch_assoc($result);

    echo "<div style=\" display: block; margin-top:0px !important; margin-left:0px;\"><ul><br>";
    echo "Provider: ".$row['provnum'].", ".$row['provname']."<br>";
    echo "Address: ".$row['address'].", ".$row['city'].", ".$row['state']." ".$row['zip'].", USA<br>";
    echo "Phone: ".$row['phone']."<br>";
    echo "Ownership Type: ".$row['ownership']."<br></div>";

    // echo "<center>Provider: ".$row['provnum'].", ".$row['provname']."</center>";
    // echo "<center>Address: ".$row['address'].", ".$row['city'].", ".$row['state']." ".$row['zip'].", USA</center>";
    // echo "<center>Phone: ".$row['phone']."</center>";
    // echo "<center>Ownership Type: ".$row['ownership']."</center>";



  }  

}

?>