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

//Code that checks to see if any usernames and password pairs match any in the database.
$checker = 0;
$user = $db->prepare("SELECT username FROM users WHERE username=?");
$user->bind_param("s", $myusername);
if ($user->execute()){
    $user->bind_result($dbusername);
    $dup->fetch();
}

$pass = $db->prepare("SELECT password FROM users WHERE username=?");
$pass->bind_param("s", $myusername);
if ($pass->execute()){
    $pass->bind_result($dbpassword);
    $pass->fetch();
}
if ($dbusername == $myusername && $dbpassword == $mypassword){
    $checker = 1;
}

//$sql = "SELECT * FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "' LIMIT 1;";
//$result = $db->query($sql);
//$checker = 0;
//while($row = $result->fetch_array()) {
    //$checker = 1;
//}

//Code for getting usertype extracted for the session.
$userType = "";
$boom = "SELECT userType FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "' LIMIT 1;";
$result = $db->query($boom);
while($row = $result->fetch_array()){
  $userType = $row['userType'];
}

//This checks if any pairs matched or not. And send the user back to the index page.
//If the user managed to log in the username and usertype is saved as a session.
if($checker==1){
    session_start();
      $_SESSION['username'] = $myusername;
      $_SESSION['userType'] = $userType;
    header("location:../index.php");
} else {
    header("location:../index.php?Loginfail=1");
}
