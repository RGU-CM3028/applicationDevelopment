<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//This connects the database here. And continues the session.
session_start();
include("../dbconnect.php"); 

//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];
	
//This displays the function contents and protects this page from outside influence if they arnt admins.
displayAccessLevelInformation($accesslevel);
	
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accesslevel){
	//This checks to see if the user is an admin or not. This protects the site from any html attack
	if ($accesslevel != "admin") {
		//This sends already signed in users back to the index page
		header("location:../index.php");
		die();
	}
}

//First half of checking for html code changes. This ensures no code past this is activated if the user somehow changed the html to access this page
$adminchoice = "";
$adminuserchoice = "";
$adminusername = "";
if(isset($_POST['choice'])) {
//safe
} else {
    header("location:admincontrolform.php?Fail=1");
    die();
}
if(isset($_POST['usertype'])) {
//safe
} else {
    header("location:admincontrolform.php?Fail=1");
    die();
}
if(isset($_POST['username'])) {
//Safe
} else {
    header("location:admincontrolform.php?Fail=1");
    die();
}

//information from the index form.
$adminchoice = $_POST["choice"];
$adminuserchoice = $_POST["usertype"];
$adminusername = $_POST["username"];

//Security checks Version1
$adminchoice = stripslashes($adminchoice);
$adminchoice = mysqli_real_escape_string($db,$adminchoice);
$adminuserchoice = stripslashes($adminuserchoice);
$adminuserchoice = mysqli_real_escape_string($db,$adminuserchoice);
$adminusername = stripslashes($adminusername);
$adminusername = mysqli_real_escape_string($db,$adminusername);

//This checks to see if any info was edited in the html(by the user) or is empty.
$checkname = mysqli_query($db, "SELECT * from users WHERE username = '$adminusername'");
if (!$checkname) {
    die('Query failed to execute for some reason');
}
if (mysqli_num_rows($checkname) > 0) {
//safe
} else {
    header("location:admincontrolform.php?nodata=1");
    die();
}

//This takes the user out to the control panel again if they chose themselfs to be edited.
if ($adminusername == $_SESSION['username']){
	header("location:admincontrolform.php?same=1");
   	die();
} else {
	//safe
}

//needs rest of code
if($adminchoice == "delete"){
	$query = "DELETE FROM users WHERE username = '".$adminusername."' LIMIT1";
	header("location:admincontrolform.php");
    	die();
} elseif($adminchoice == "usertype") {
	$sql = "UPDATE users SET userType='".$adminuserchoice."' WHERE username='".$adminusername."'";
	header("location:admincontrolform.php");
    	die();
} elseif($adminchoice == "") {
	header("location:admincontrolform.php?select=1");
    	die();
}
?>
