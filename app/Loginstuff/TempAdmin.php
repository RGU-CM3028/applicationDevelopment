<?php
//This connects the database here.
include("../dbconnect.php");

//This is the fields from the signup form.
$myusername = $_POST["username"];
$mypassword = $_POST["password"];
$passwordcheck = $_POST["passwordcheck"];

//This declairs the boolians so they dont cause an error
$userspace = 'false';
$passspace = 'false';
$pass2space = 'false';

//This checks to see if their is any spaces in the variables
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
    header("location:Tempadminform.php?space=1");
    die();
}

//This checks to see if the fields are empty or not.
if(empty($myusername) || empty($mypassword) || empty($passwordcheck))
    {
    header("location:Tempadminform.php?empty=1");
    die();
}

//This checks to see if the username is taken or not.
$dup = mysqli_query($db, "SELECT username FROM users WHERE username='$myusername'");
$userchecker = mysqli_fetch_assoc($dup);
if(mysqli_num_rows($dup) >0){
    header("location:Tempadminform.php?dup=1");
    die();
} 

//This compares the passwords. If the match then the user is created. If not then the user is told to check again.
if($mypassword==$passwordcheck) {
    
    $mypassword = password_hash($mypassword, PASSWORD_BCRYPT, array( 'cost' => 12));
    
    $sql = "INSERT INTO users (username, password, userType) VALUES ('". $myusername ."', '" .$mypassword."', 'admin')";
    if (mysqli_query($db, $sql)) {        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['userType'] = 'admin';
    header("location:../index.php");
    $sql = "INSERT INTO users (username, password, userType) VALUES ('". $myusername ."', '" .$mypassword."', 'admin')";
    
} else {
    header("location:Tempadminform.php?same=1");
    die();
}
?>
