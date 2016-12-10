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

//Security checks Version1
//$myusername = stripslashes($myusername);
//$myusername = mysqli_real_escape_string($db,$myusername);
//$mypassword = stripslashes($mypassword);
//$mypassword = mysqli_real_escape_string($db,$mypassword);

//password salting
$salt = "qwertgfdert45t456545655";
$mypassword = $mypassword.$salt;
$mypassword = hash('sha256', $mypassword);

echo $myusername;
echo $mypassword."<br>";

//Code that checks to see if any usernames and password pairs match any in the database.
$checker = 0;
$user = $db->prepare("SELECT username FROM users WHERE username=?");
$user->bind_param("s", $myusername);
if ($user->execute()){
    $user->bind_result($dbusername);
    $dup->fetch();
}
echo $dbusername;

$pass = $db->prepare("SELECT password FROM users WHERE username=?");
$pass->bind_param("s", $myusername);
if ($pass->execute()){
    $pass->bind_result($dbpassword);
    $pass->fetch();
}
echo $dbpassword;
    
if ($dbusername == $myusername && $dbpassword == $mypassword){
    $checker = 1;
}
echo $myusername;
echo $mypassword."<br>";
//Code for getting usertype extracted for the session.
$pass = $db->prepare("SELECT userType FROM users WHERE username=?");
$pass->bind_param("s", $myusername);
if ($pass->execute()){
    $pass->bind_result($dbuserType);
    $pass->fetch();
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
