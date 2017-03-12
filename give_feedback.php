<?php

require_once 'db_functions.php';
$db = new db_functions();

// all parameters received 
if (isset($_POST['username']) && isset($_POST['provnum']) && isset($_POST['score']) && isset($_POST['comment'])) {

    // receiving the post params
    $username = $_POST['username'];
    $provnum = $_POST['provnum'];
    $score = $_POST['score'];
    $comment = $_POST['comment'];
    // search and display from the database where $type = $field
    if($db->store_feedback($username, $provnum, $score, $comment) == FALSE)
    	echo "<center>An unexpected error occurred!</center>";
    else
    	header("Location: search_nh_details.php?provnum=" . $provnum."&feedback=yes");

} else {

    // required parameters missing
    $error_msg = "Required parameters missing!";
    echo "<center>$error_msg</center>";

}

?>