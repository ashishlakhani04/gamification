<?php 
	session_start();
	
		unset($_SESSION['user']);
		session_destroy();
		header("Cache-Control", "no-cache, no-store, must-revalidate"); 
		header("location: form.php");
?>