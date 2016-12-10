<?php
//Code that connects the database here.
include("../dbconnect.php");

//html change safety check. This is to catch out any attempt to change variables and so on in the html.
$myusername = "";
$mypassword = "";
if(isset($_POST['username'])) {
    // id index exists
} else {
    header("location:../index.php?Loginfail=2");
    die();
}
if(isset($_POST['password'])) {
    // id index exists
} else {
    header("location:../index.php?Loginfail=2");
    die();
}

//information from the index form.
$myusername = $_POST["username"];
$mypassword = $_POST["password"];

//Removes html tags from the username.
$myusername = strip_tags($myusername);
$mypassword = strip_tags($mypassword);
$passwordcheck = strip_tags($passwordcheck);

//password salting
$salt = "qwertgfdert45t456545655";
$mypassword = $mypassword.$salt;
$mypassword = hash('sha256', $mypassword);

//This gets the username from the database.
$checker = 0;
$user = $db->prepare("SELECT username FROM users WHERE username=?");
$user->bind_param("s", $myusername);
if ($user->execute()){
    $user->bind_result($dbusername);
    $user->fetch();
    $user->close();
}

//This gets the password from the database.
$user = $db->prepare("SELECT password FROM users WHERE username=?");
$user->bind_param("s", $myusername);
if ($user->execute()){
    $user->bind_result($dbpassword);
    $user->fetch();
    $user->close();
}

//This compares the usernames and passwords with each other, and if they match a counter goes up by one.
if ($dbusername == $myusername && $dbpassword == $mypassword){
    $checker = 1;
}

//Code for getting usertype extracted for the session.
$pass = $db->prepare("SELECT userType FROM users WHERE username=?");
$pass->bind_param("s", $myusername);
if ($pass->execute()){
    $pass->bind_result($dbuserType);
    $pass->fetch();
    $pass->close();
}

//This checks if any pairs matched or not. And send the user back to the index page.
//If the user managed to log in the username and usertype is saved as a session.
if($checker==1){
    session_start();
      $_SESSION['username'] = $dbusername;
      $_SESSION['userType'] = $dbuserType;
    header("location:../index.php");
} else {
    header("location:../index.php?Loginfail=1");
}
