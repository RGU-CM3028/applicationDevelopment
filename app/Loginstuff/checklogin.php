<?php
include ("dbconnect.php");

//information from the index form.
$myusername = $_POST["username"];
$mypassword = $_POST["password"];

//Security checks version1
$myusername = stripslashes($myusername);
$myusername = mysqli_real_escape_string($db,$myusername);
$mypassword = stripslashes($mypassword);
$mypassword = mysqli_real_escape_string($db,$mypassword);

//checking to see if any usernames and password pairs match any in the database.
$sql = "SELECT * FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "'";
$result = $db->query($sql);
$checker = 0;
while($row = $result->fetch_array()) {
    $checker = 1;
}

//Code for getting usertype extracted
$userType = "";
$boom = "SELECT userType FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "'";
$result = $db->query($boom);
while($row = $result->fetch_array()){
$userType = $row['userType'];
}   

//This checks if any pairs matched or not. And send the user back to the index page.
if($checker==1){
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['userType'] = $userType;
    header("location:index.php");
} else {
    header("location:index.php?Loginfail=1");
}
