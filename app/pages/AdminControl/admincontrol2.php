<?php
//This connects the database here. And continues the session.
session_start();
include("../../dbconnect.php"); 

//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];
	
//This displays the function contents and protects this page from outside influence if they arnt admins.
displayAccessLevelInformation($accesslevel);
	
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accesslevel){
	//This checks to see if the user is an admin or not. This protects the site from any html attack
	if ($accesslevel != "admin") {
		//This sends already signed in users back to the index page
		header("location:../../index.php");
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
    header("location:index.php?Fail=1");
    die();
}
if(isset($_POST['usertype'])) {
	//safe
} else {
    header("location:index.php?Fail=1");
    die();
}
if(isset($_POST['username'])) {
	//Safe
} else {
    header("location:index.php?Fail=1");
    die();
}

//information from the index form.
$adminchoice = $_POST["choice"];
$adminuserchoice = $_POST["usertype"];
$adminusername = $_POST["username"];

/*//Security checks Version1
$adminchoice = stripslashes($adminchoice);
$adminchoice = mysqli_real_escape_string($db,$adminchoice);
$adminuserchoice = stripslashes($adminuserchoice);
$adminuserchoice = mysqli_real_escape_string($db,$adminuserchoice);
$adminusername = stripslashes($adminusername);
$adminusername = mysqli_real_escape_string($db,$adminusername);*/


$check = $db->prepare("SELECT username FROM users WHERE username=?");
$check->bind_param("s", $adminusername);
if ($check->execute()){
	$check->bind_result($username);
        $check->fetch();
        $check->close();
    }

if ($username == $adminusername) {
	//safe
} else {  
	header("location:index.php?nodata=1");
    	die();
}

//This takes the user out to the control panel again if they chose themselfs to be edited.
if ($username == $_SESSION['username']){
	header("location:index.php?same=1");
   	die();
} else {
	//safe
}

//This is the code that deletes the user the admin selected.
if($adminchoice == "delete"){
	$stmt = $db->prepare("DELETE FROM users WHERE username =?");
        $stmt->bind_param("s", $username);
        $stmt->execute();  
        $stmt->close();
	header("location:index.php?nodata=1");
    	die();
}
	/*$check = $db->prepare("SELECT username FROM users WHERE username=?");
	$check->bind_param("s", $adminusername);
	if ($check->execute()){
		$check->bind_result($username);
        	$check->fetch();
        	$check->close();
    	}
	if ($username == $adminusername) {
		header("location:index.php?nodata=1");
    		die();
	} 
} */

//This is the code that updates the user with the info the admin selected.
elseif($adminchoice == "usertype") {
	$stmt = $db->prepare("UPDATE users SET userType=? WHERE username=?");
        $stmt->bind_param("ss", $adminuserchoice, $username);
        $stmt->execute();  
        $stmt->close();
	header("location:index.php?update=1");
    	die();
}
	
	
	/*
	if (mysqli_query($db, $sql)) {    
		header("location:index.php?update=1");
    		die();
    	} else {
        	echo "Error: " . $sql . "<br>" . mysqli_error($db);
    	}
} */

//This takes the user back to the control panel with an error message
elseif($adminchoice == "") {
	header("location:index.php?select=1");
    	die();
}
?>
