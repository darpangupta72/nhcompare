<?php
require_once 'db_functions.php';
$db = new db_functions();

if(isset($_GET['provnum'])&&isset($_GET['date'])&&isset($_GET['tag'])) {
	$provnum=$_GET['provnum'];
	$date=$_GET['date'];
	$tag=$_GET['tag'];
	$db->view_tag($provnum,$date,$tag);
}
?>