<?php
include ("dbconnect.php");

//This is the fields from the signup form
$myusername = $_POST["username"];
$mypassword = $_POST["password"];
$passwordcheck = $_POST["passwordcheck"];
$myusername = stripslashes($myusername);
$myusername = mysqli_real_escape_string($db, $myusername);
$mypassword = stripslashes($mypassword);
$mypassword = mysqli_real_escape_string($db, $mypassword);
$passwordcheck = stripslashes($passwordcheck);
$passwordcheck = mysqli_real_escape_string($db, $passwordcheck);
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
$dup = mysqli_query("SELECT username FROM users WHERE username='$myusername'");
$userchecker = mysqli_fetch_assoc($dup);
if(mysqli_num_rows($dup) >0){
    header("location:signupform.php?dup=1");
    die();
}
//This checks if the password is 100% what the user typed
if($mypassword==$passwordcheck)
{
    $sql = "INSERT INTO users (username, password, userType) VALUES ('". $myusername ."', '" .$mypassword."', 'reader')";
    if (mysqli_query($db, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['userType'] = 'reader';
    header("location:index.php");
    $sql = "INSERT INTO users (username, password, userType) VALUES ('". $myusername ."', '" .$mypassword."', 'reader')";
} else {
    header("location:signupform.php?same=1");
    die();
}
?>
