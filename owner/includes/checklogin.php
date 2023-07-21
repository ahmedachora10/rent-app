<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
function check_login()
{
	if(strlen($_SESSION['top_id'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="logout.php";		
		$_SESSION["userid"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>