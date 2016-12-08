<?php
//Code that connects the database here.
include("../dbconnect.php");
//html change safety check. This is to catch out any attempt to change variables and so on in the html.
$myusername = "";
$mypassword = "";
if(isset($_POST['username1'])) {
    // id index exists
} else {
    header("location:../index.php?Loginfail=2");
    die();
}
if(isset($_POST['password2'])) {
    // id index exists
} else {
    header("location:../index.php?Loginfail=2");
    die();
}
    
//information from the index form.
$myusername = $_POST["username1"];
$mypassword = $_POST["password1"];

echo $_POST["username1"];
echo $_POST["password2"];

//Security checks Version1
$myusername = stripslashes($myusername);
$myusername = filter_var($myusername, FILTER_SANITIZE_STRING);
$myusername = htmlspecialchars($myusername, ENT_QUOTES, "ISO-8859-1");
//$myusername = mysqli_real_escape_string($db,$myusername);
$mypassword = stripslashes($mypassword);
$mypassword = mysqli_real_escape_string($db,$mypassword);
$salt = "qwertgfdert45t456545655";
$mypassword = $mypassword.$salt;
$mypassword = hash('sha256', $mypassword);

//Code that checks to see if any usernames and password pairs match any in the database.
$sql = "SELECT * FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "' LIMIT 1;";
$result = $db->query($sql);
$checker = 0;
while($row = $result->fetch_array()) {
    $checker = 1;
}

echo $mypassword;		
echo $myusername;		
die();

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
