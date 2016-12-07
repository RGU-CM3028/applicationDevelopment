<?php
session_start();
include("../dbconnect.php"); 

//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];
	
//This displays the function contents	
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

//First half of checking for html code changes
if(isset($_POST['choice'])) {
    // it exists
} else {
    header("location:admincontrolform.php");
    die();
}
if(isset($_POST['usertype'])) {
    // it exists
} else {
    header("location:admincontrolform.php");
    die();
}
if(isset($_POST['username'])) {
    // it exists
} else {
    header("location:admincontrolform.php");
    die();
}

//HTML change safety check
if($adminchoice != "delete" || $adminchoice != "usertype" || $adminchoice != ""){
  echo "Oh no you dont get to change the html on us";
  die();
}
if($adminuserchoice != "reader" || $adminuserchoice != "admin" || $adminuserchoice != "unspecified" || $adminuserchoice != ""){
  echo "Oh no you dont get to change the html on us";
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
