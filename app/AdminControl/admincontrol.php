<?php
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

//This checks to see if the username exists or not
$dup = mysqli_query($db, "SELECT username FROM users WHERE username='$myusername'");
$userchecker = mysqli_fetch_assoc($dup);
if(mysqli_num_rows($dup) =0){
    header("location:admincontrolform.php?dup=1");
    die();
} else {
	echo "Thank you for following the rules";
}


//This takes the user out to the control panel again if they chose themselfs to be edited.
if ($adminusername == $_SESSION['username']){
	header("location:admincontrolform.php?Fail=2");
   	die();
} else {
	echo "You are safe";
}

//needs rest of code
if($adminchoice == "delete"){
  echo "delete oh noes";
} elseif($adminchoice == "usertype") {
  echo "usertype bro";
} elseif($adminchoice == "") {
  echo "Nothing is there";
}

//reference
//choice values = "", "delete", "usertype"
//usertype values - "", "reader", "admin", "unspecified"
//username values = "", $row['username']
//$sql = "DELETE FROM MyGuests WHERE id=3";
//$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
