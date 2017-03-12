<?php
	if(isset($_POST['command'])) {
		$name=$_POST['username']; $scoredesc=$_POST['command'];
		echo "Received $name $scoredesc";
	}
?>