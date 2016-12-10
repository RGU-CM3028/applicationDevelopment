<?php
//This connects the database here.
include("../../dbconnect.php");

//html change safety check. This is to catch out any attempt to change variables and so on in the html.
$myusername = "";
$mypassword = "";
$passwordcheck = "";
if(isset($_POST['username'])) {
    // it exists
} else {
    header("location:index.php");
    die();
}
if(isset($_POST['password'])) {
    // it exists
} else {
    header("location:index.php");
    die();
}
if(isset($_POST['passwordcheck'])) {
    // it exists
} else {
    header("location:index.php");
    die();
}
//This is the fields from the signup form.
$myusername = $_POST["username"];
$mypassword = $_POST["password"];
$passwordcheck = $_POST["passwordcheck"];
$myusertype = 'reader';

//Hashing password for password security
$salt = "qwertgfdert45t456545655";
$mypassword = $mypassword.$salt;
$mypassword = hash('sha256', $mypassword);
$passwordcheck = $passwordcheck.$salt;
$passwordcheck = hash('sha256', $passwordcheck);

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
    header("location:index.php?space=1");
    die();
}

//This checks to see if the fields are empty or not.
if(empty($myusername) || empty($mypassword) || empty($passwordcheck))
    {
    header("location:index.php?empty=1");
    die();
}

//This checks to see if the username is taken or not.
$dup = $db->prepare("SELECT username FROM users WHERE username=?");
$dup->bind_param("s", $myusername);
if ($dup->execute()){
    $dup->bind_result($username);
    $dup->fetch();
}
echo $username;
die();

if($username == $myusername){
    header("location:index.php?dup=1");
    die();
}

//This compares the passwords. If the match then the user is created. If not then the user is told to check again.
if($mypassword==$passwordcheck) {
    
    //This prepared statement protects the inserting of data input of the database
    $stmt = $db->prepare("INSERT INTO users (username, password, userType) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $myusername, $mypassword, $myusertype);
    $stmt->execute();  
    
    //This is meant to recover the info used for the session
    $get = $db->prepare("SELECT username FROM users WHERE username=?");
    $get->bind_param("s", $myusername);
    if ($get->execute()){
        $get->bind_result($username);
        $get->fetch();
    }
    
    //This is the session
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['userType'] = 'reader';
    header("location:index.php");    
} else {
    header("location:index.php?same=1");
    die();
}
?>
