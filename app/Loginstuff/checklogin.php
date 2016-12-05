<?php
include ("db_connect.php");
//information from the index form
$myusername = $_POST["username"];
$mypassword = $_POST["password"];
//Need to possibly get this working for security
//$myusername = mysqli_real_escape_string($myusername);
//$mypassword = mysqli_real_escape_string($mypassword);
//$myusername = stripcslashes($myusername);
//$mypassword = stripcslashes($mypassword);
//checking to see if any usernames and password pairs match any in the database
$myusername = stripslashes($myusername);
$myusername = mysql_real_escape_string($myusername);
$mypassword = stripslashes($mypassword);
$mypassword = mysql_real_escape_string($mypassword);
$sql = "SELECT * FROM users WHERE username ='". $myusername ."' and password ='". $mypassword . "'";
//The following code checks to see if any match
$result = $db->query($sql);
$checker = 0;
while($row = $result->fetch_array()) {
    $checker = 1;
}
    
    
//This deals with if any matched or not. And send the user back to the index page
if($checker==1){
    session_start();
    $_SESSION['username'] = $myusername;
    header("location:index.php");
} else {
    session_start();
    echo "Incorrect user credentials";
    header("location:index.php");
}
