<?php
	if(isset($_POST['command'])) {
		$name=$_POST['username']; $provnum=$_POST['provnum']; $score=$_POST['score']; $scoredesc=$_POST['comment'];
		echo "Received $name $provnum $score $scoredesc";
	}
?>