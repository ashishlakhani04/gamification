
<?php include '../includes/db.php' ?>
<?php 

	if(isset($_GET['id']))
	{

	$delQuery= "delete from studenttbl where id = '".$_GET['id']."'";

	$delResult = mysqli_query($connection,$delQuery);

	if(!$delResult)

	{
		die("Error");
	}

	header("Location: students.php");

	}




?>