<?php

$server = "localhost";

$username = "root";

$password = "";

$database = "GamificationDB";

$connection = mysqli_connect($server,$username,$password,$database);

if(!$connection)
{
	die ("Error: ".mysql_error($connection));
}



 ?>