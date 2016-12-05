<?php
include ("db_connect.php");
//information from the index form

$myusername = $_POST["username"];
$mypassword = $_POST["password"];

//checking to see if any usernames and password pairs match any in the database
$myusername = stripslashes($myusername);
$myusername = mysqli_real_escape_string($db,$myusername);
$mypassword = stripslashes($mypassword);
$mypassword = mysqli_real_escape_string($db,$mypassword);

$sql = "SELECT * FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "'";
//The following code checks to see if any match
$result = $db->query($sql);
$checker = 0;
while($row = $result->fetch_array()) {
    $checker = 1;
}

//Test code for getting usertype extracted
$boom = "SELECT usertype FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "'";
$result = $db->query($boom);
while($row = $result->fetch_array()){
$userType = $row['userType'];
echo $userType;    
    
//This deals with if any matched or not. And send the user back to the index page
if($checker==1){
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['userType'] = $userType;
    header("location:index.php");
} else {
    header("location:index.php?Loginfail=1");
}
