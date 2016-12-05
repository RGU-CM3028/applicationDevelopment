<?php
include ("db_connect.php");
//This is the fields from the signup form
$myusername = $_POST["username"];
$mypassword = $_POST["password"];
$passwordcheck = $_POST["passwordcheck"];
//This checks if there is any spaces in the user entered data
if (strpos($myusername, ' ') !== false) {
    $userspace = 'true';
}
if (strpos($mypassword, ' ') !== false) {
    $passspace = 'true';
}
if (strpos($passwordcheck, ' ') !== false) {
    $pass2space ='true';
}
//This tests to see if there is any spaces in the text
if($userspace=='true' || $passspace=='true' || $pass2space=='true') {
    header("location:signupform.php?space=1");
    die();
}
//This checks to see if the fields are empty or not.
if(empty($myusername) || empty($mypassword) || empty($passwordcheck))
    {
    header("location:signupform.php?empty=1");
    die();
}
//This checks to see if the username is taken or not.
$dup = mysql_query("SELECT username FROM users WHERE username='$myusername'");
$userchecker = mysql_fetch_assoc($dup);
if(mysql_num_rows($dup) >0){
    header("location:signupform.php?dup=1");
    die();
}
//This checks if the password is 100% what the user typed
if($mypassword==$passwordcheck)
{
    $myusername = stripslashes($myusername);
    $myusername = mysql_real_escape_string($myusername);
    $mypassword = stripslashes($mypassword);
    $mypassword = mysql_real_escape_string($mypassword);
    $passwordcheck = stripslashes($passwordcheck);
    $passwordcheck = mysql_real_escape_string($passwordcheck);
    $sql = "INSERT INTO users (username, password, userType) VALUES ('". $myusername ."', '" .$mypassword."', 'reader')";
    if (mysqli_query($db, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
    session_start();
    $_SESSION['username'] = $myusername;
    header("location:index.php");
    $sql = "INSERT INTO users (username, password, userType) VALUES ('". $myusername ."', '" .$mypassword."', 'reader')";
} else {
    header("location:signupform.php?same=1");
    die();
}
?>
