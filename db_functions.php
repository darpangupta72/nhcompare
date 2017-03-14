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

  // deleting user from database
  function deleteUser($username) {

    $sql = "DELETE FROM login where username = '$username'";
    $result = pg_query($this->conn, $sql);

    if(! $result)
      echo "<center>An unexpected error occurred!</center>";

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

    $sql = "CREATE VIEW T AS SELECT provnum AS provnum1, ROUND(AVG(score)::numeric, 2) AS user_score FROM feedback group by provnum1; CREATE VIEW U AS SELECT * FROM (provider_info LEFT OUTER JOIN T ON provider_info.provnum=t.provnum1);";
    $result = pg_query($this->conn, $sql);

    $sql = "CREATE VIEW NH AS SELECT provnum, provname, " . $final . " FROM U WHERE UPPER($type) = UPPER('$field') ORDER BY " . $final1 . " DESC NULLS LAST, provnum DESC; SELECT count(*) FROM NH";
    $result = pg_query($this->conn, $sql);
    $count = pg_fetch_assoc($result)['count'];
    
    $sql = "SELECT * FROM NH";
    $result = pg_query($this->conn, $sql);

    echo "<br><center>Your search returned " . $count . " results.</center><br>";

    if($count > 0) {
      
      echo "<center><table border='1'><tr><th>Provider No.</th><th>Provider Name</th><th>$names[0]</th><th>$names[1]</th><th>$names[2]</th><th>$names[3]</th><th>$names[4]</th><th>$names[5]</th><th>$names[6]</th></tr>";

      while($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><a href=\"search_nh_details.php?provnum=".$row['provnum']."\"><center>".$row['provnum']."<center/></a></td>";
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

    $sql = "DROP VIEW T, U, NH";
    $result = pg_query($this->conn, $sql);
  
  }

  function details_nh($provnum,$usertype) {

    $sql = "CREATE VIEW T AS SELECT provnum AS provnum1, ROUND(AVG(score)::numeric, 2) AS user_score FROM feedback group by provnum1; CREATE VIEW U AS SELECT * FROM (provider_info LEFT OUTER JOIN T ON provider_info.provnum=t.provnum1);";
    $result = pg_query($this->conn, $sql);

  	$sql = "SELECT * FROM U WHERE provnum = '$provnum'";
    $result = pg_query($this->conn, $sql);
    $row = pg_fetch_assoc($result);

    echo "Provider: ".$row['provnum'].", ".$row['provname']."<br>";
    echo "Address: ".$row['address'].", ".$row['city'].", ".$row['state']." ".$row['zip'].", USA<br>";
    echo "Phone: ".$row['phone']."<br>";
    echo "Ownership Type: ".$row['ownership']."<br></div>";

    echo "<center>";
    if($usertype == 'u')
    echo "<a href=\"give_feedback_html.php?provnum=".$row['provnum']."\">GIVE FEEDBACK</a>&emsp;&emsp;";
    echo "<a href=\"view_feedback.php?provnum=".$row['provnum']."\">VIEW FEEDBACK</a></center><br><br>";

    echo "<center><table border='1'><tr><th>Overall Rating</th><th>Health Inspection Rating</th><th>QM Rating</th><th>Staffing Rating</th><th>RN Staffing Rating</th><th>User Rating</th><th>No. of Certified Beds</th><th>No. of Residents in Certified Beds</th><th>Provider Type</th><th>Provider Resides in Hospital</th><th>Continuing Care Retirement Community</th><th>Special Focus Facility</th><th>With a Resident and Family Council</th><th>Automatic Sprinkler Systems</th><th>Cycle1 Health Deficiency Score</th><th>Cycle1 Health Revisit Score</th><th>Cycle1 Total Health Score</th><th>Cycle2 Health Deficiency Score</th><th>Cycle2 Health Revisit Score</th><th>Cycle2 Total Health Score</th><th>Cycle3 Health Deficiency Score</th><th>Cycle3 Health Revisit Score</th><th>Cycle3 Total Health Score</th><th>Weighted Health Survey Score</th><th>No. of Facility Reported Incidents</th><th>No. of Substantiated Complaints</th><th>Processing Date</th></tr>";

    echo "<tr>";
    echo "<td><center>".$row['overall_rating']."</center></td>";
    echo "<td><center>".$row['survey_rating']."</center></td>";
    echo "<td><center>".$row['quality_rating']."</center></td>";
    echo "<td><center>".$row['staffing_rating']."</center></td>";
    echo "<td><center>".$row['rn_staffing_rating']."</center></td>";
    echo "<td><center>".$row['user_score']."</center></td>";
    echo "<td><center>".$row['bedcert']."</center></td>";
    echo "<td><center>".$row['restot']."</center></td>";
    echo "<td><center>".$row['certification']."</center></td>";
    echo "<td><center>".$row['inhosp']."</center></td>";
    echo "<td><center>".$row['ccrc_facil']."</center></td>";
    echo "<td><center>".$row['sff']."</center></td>";
    echo "<td><center>".$row['resfamcouncil']."</center></td>";
    echo "<td><center>".$row['sprinkler_status']."</center></td>";
    echo "<td><center>".$row['cycle_1_defs_score']."</center></td>";
    echo "<td><center>".$row['cycle_1_revisit_score']."</center></td>";
    echo "<td><center>".$row['cycle_1_total_score']."</center></td>";
    echo "<td><center>".$row['cycle_2_defs_score']."</center></td>";
    echo "<td><center>".$row['cycle_2_revisit_score']."</center></td>";
    echo "<td><center>".$row['cycle_2_total_score']."</center></td>";
    echo "<td><center>".$row['cycle_3_defs_score']."</center></td>";
    echo "<td><center>".$row['cycle_3_revisit_score']."</center></td>";
    echo "<td><center>".$row['cycle_3_total_score']."</center></td>";
    echo "<td><center>".$row['weighted_all_cycles_score']."</center></td>";
    echo "<td><center>".$row['incident_cnt']."</center></td>";
    echo "<td><center>".$row['cmplnt_cnt']."</center></td>";
    echo "<td><center>".$row['filedate']."</center></td>";
    echo "</tr>";    

    echo "</table></center>";
    $sql = "DROP VIEW T, U";
    $result = pg_query($this->conn, $sql);

  }

  function store_feedback($username, $provnum, $score, $comment) {
  
    $sql = "INSERT INTO feedback(username, provnum, score, score_desc) VALUES('$username', '$provnum', '$score', '$comment')";
    $result = pg_query($this->conn, $sql);

    if(! $result) 
      return FALSE;
    return TRUE;

  }

  function show_deficiencies($provnum) {
    $sql = "CREATE VIEW V2 AS SELECT provnum as provnum_copy, defpref, tag,survey_date_output, scope, defstat, statdate, cycle_no, standard,complaint FROM deficiencies ;CREATE VIEW V1 AS SELECT * FROM provider_info, V2 WHERE provnum = provnum_copy";
    $result = pg_query($this->conn, $sql);

    $sql = "SELECT * FROM V1 WHERE provnum = '$provnum'";
    $result = pg_query($this->conn, $sql);
    $row = pg_fetch_assoc($result);

    echo "Provider: ".$row['provnum'].", ".$row['provname']."<br>";
    echo "Address: ".$row['address'].", ".$row['city'].", ".$row['state']." ".$row['zip'].", USA<br>";
    echo "Phone: ".$row['phone']."<br>";
    echo "Ownership Type: ".$row['ownership']."<br></div>";
    echo "<center><table border='1'><tr><th>defpref</th><th>tag</th><th>scope</th><th>defstat</th><th>survey date</th><th>statdate</th><th>cycle_no</th><th>standard</th><th>complaint</th><th>filedate</th></tr>";
    $result = pg_query($this->conn, $sql);
    
    while($row = pg_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td><center>".$row['defpref']."</center></td>";
      echo "<td><center><a href=\"javascript:window.open('view_tag.php?provnum=".$row['provnum']."&date=".$row['survey_date_output']."&tag=".$row['tag']."','TAG Description','width=500,height=150')\">".$row['tag']."</a></center></td>";
      echo "<td><center>".$row['scope']."</center></td>";
      echo "<td><center>".$row['defstat']."</center></td>";
      echo "<td><center>".$row['survey_date_output']."</center></td>";
      echo "<td><center>".$row['statdate']."</center></td>";
      echo "<td><center>".$row['cycle_no']."</center></td>";
      echo "<td><center>".$row['standard']."</center></td>";
      echo "<td><center>".$row['complaint']."</center></td>";;
      echo "<td><center>".$row['filedate']."</center></td>";
      echo "</tr>";    
    }
    echo "</table></center>";
    

    $sql = "DROP VIEW V1, V2";
    $result = pg_query($this->conn, $sql);   
  }
  function view_feedback($provnum) {

  	$sql = "CREATE VIEW V1 AS SELECT * FROM feedback WHERE provnum = '$provnum' ORDER BY feedback_id";
    $result = pg_query($this->conn, $sql);
    $sql = "SELECT COUNT(*) FROM V1";
    $result = pg_query($this->conn, $sql);
    $count = pg_fetch_assoc($result)['count'];
    
    $sql = "SELECT * FROM V1";
    $result = pg_query($this->conn, $sql);

    echo "<br><center>Your search returned " . $count . " results.</center><br>";

    if($count > 0) {
      
      echo "<center><table border='1'><tr><th>Feedback ID</th><th>Username</th><th>Provider Number</th><th>Score</th><th>Description</th><th>Timestamp</th></tr>";

      while($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><center>".$row['feedback_id']."</center></td>";
        echo "<td><center>".$row['username']."</center></td>";
        echo "<td><center>".$row['provnum']."</center></td>";
        echo "<td><center>".$row['score']."</center></td>";
        echo "<td><center>".$row['score_desc']."</center></td>";
        echo "<td><center>".$row['time']."</center></td>";
        echo "</tr>";    
      }

      echo "</table></center>";

    }

    $sql = "DROP VIEW V1";
    $result = pg_query($this->conn, $sql);

  }  

  function staff_info($provnum) {
    $sql = "CREATE VIEW V1 AS SELECT provname, address, city, state, zip, phone, ownership, provnum, staffing_rating, rn_staffing_rating, aidhrd, vochrd, rnhrd, totlichrd, tothrd, pthrd, exp_aide, exp_lpn, exp_rn, exp_total, adj_aide, adj_lpn, adj_rn, adj_total, filedate FROM provider_info";
    $result = pg_query($this->conn, $sql);

    $sql = "SELECT * FROM V1 WHERE provnum = '$provnum'";
    $result = pg_query($this->conn, $sql);
    $row = pg_fetch_assoc($result);

    echo "Provider: ".$row['provnum'].", ".$row['provname']."<br>";
    echo "Address: ".$row['address'].", ".$row['city'].", ".$row['state']." ".$row['zip'].", USA<br>";
    echo "Phone: ".$row['phone']."<br>";
    echo "Ownership Type: ".$row['ownership']."<br></div>";
    echo "<center><table border='1'><tr><th>staffing_rating</th><th>rn_staffing_rating</th><th>aidhrd</th><th>vochrd</th><th>rnhrd</th><th>totlichrd</th><th>tothrd</th><th>pthrd</th><th>exp_aid</th><th>exp_lpn</th><th>exp_m</th><th>exp_total</th><th>adj_aid</th><th>adj_lpn</th><th>adj_m</th><th>adj_total</th><th>filedate</th></tr>";
    $result = pg_query($this->conn, $sql);
    while($row = pg_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td><center>".$row['staffing_rating']."</center></td>";
      echo "<td><center>".$row['rn_staffing_rating']."</center></td>";
      echo "<td><center>".$row['aidhrd']."</center></td>";
      echo "<td><center>".$row['vochrd']."</center></td>";
      echo "<td><center>".$row['rnhrd']."</center></td>";
      echo "<td><center>".$row['totlichrd']."</center></td>";
      echo "<td><center>".$row['tothrd']."</center></td>";
      echo "<td><center>".$row['pthrd']."</center></td>";
      echo "<td><center>".$row['exp_aide']."</center></td>";
      echo "<td><center>".$row['exp_lpn']."</center></td>";
      echo "<td><center>".$row['exp_rn']."</center></td>";
      echo "<td><center>".$row['exp_total']."</center></td>";
      echo "<td><center>".$row['adj_aide']."</center></td>";
      echo "<td><center>".$row['adj_lpn']."</center></td>";
      echo "<td><center>".$row['adj_rn']."</center></td>";
      echo "<td><center>".$row['adj_total']."</center></td>";
      echo "<td><center>".$row['filedate']."</center></td>";
      echo "</tr>";    
    }
    echo "</table></center>";
    

    $sql = "DROP VIEW V1";
     $result = pg_query($this->conn, $sql);   
  }

  function show_penalties($provnum) {
    $sql = "CREATE VIEW V1 AS SELECT provnum, provname, address, city, state, zip, phone, ownership, filedate FROM provider_info";
    $result = pg_query($this->conn, $sql);
    // $sql = "SELECT COUNT(*) FROM V1";
    // $count1 = pg_query($this->conn, $sql)['count'];

    // $sql = "SELECT * from V1 WHERE provnum = '$provnum'";
    // $result = pg_query($this->conn, $sql);
    $sql = "SELECT * from V1 WHERE provnum = '$provnum'";
    $result = pg_query($this->conn, $sql);
    $row = pg_fetch_assoc($result);

    echo "Provider: ".$row['provnum'].", ".$row['provname']."<br>";
    echo "Address: ".$row['address'].", ".$row['city'].", ".$row['state']." ".$row['zip'].", USA<br>";
    echo "Phone: ".$row['phone']."<br>";
    echo "Ownership Type: ".$row['ownership']."<br></div>";
    echo "<center><table border='1'><tr><th>pnlty_date</th><th>pnlty_type</th><th>fine_amt</th><th>payden_strt_dt</th><th>payden_days</th><th>filedate</th></tr>";
    $sql = "SELECT penalty_date, penalty_type, fine_amt, payden_strt_dt, payden_days, filedate FROM penalties where provnum = '$provnum' ";
    $result = pg_query($this->conn, $sql);
    while($row = pg_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td><center>".$row['penalty_date']."</center></td>";
      echo "<td><center>".$row['penalty_type']."</center></td>";
      echo "<td><center>".$row['fine_amt']."</center></td>";
      echo "<td><center>".$row['payden_strt_dt']."</center></td>";
      echo "<td><center>".$row['payden_days']."</center></td>";
      echo "<td><center>".$row['filedate']."</center></td>";
      echo "</tr>";    
    }
    echo "</table></center>";
    

    $sql = "DROP VIEW V1";
    $result = pg_query($this->conn, $sql);  
  }

  function view_tag($provnum,$date,$tag) {
    $sql = "SELECT tag_desc FROM deficiencies WHERE provnum='$provnum' AND survey_date_output='$date' AND tag = '$tag'";
    $result = pg_query($this->conn, $sql);
    while($row = pg_fetch_assoc($result)){

    echo "Description of the tag is-> ".$row['tag_desc']." <br>";
    }
  }

}

?>