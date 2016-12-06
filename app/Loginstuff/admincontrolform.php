<?php
//This starts the sessions. And connects the database here..
session_start();
include ("dbconnect.php");    
//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];

//This displays the function contents	
displayAccessLevelInformation($accesslevel);
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accessLevel){
	if ($accessLevel == "admin") {
		?>
		<!--This is where the controls would go-->    
		<a href="admincontrolform.php">Admin Control Pannel</a>    
		<?
	}
	else 
	{
		echo "You cant enter here!";
		?>
		<!--This would lead you back to the main page-->    
		<a href="index.php">Return to index page</a>    
		<?
	}
		
}
