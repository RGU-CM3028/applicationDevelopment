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
$myusername = stripslashes($myusername);
$myusername = filter_var($myusername, FILTER_SANITIZE_STRING);
//$myusername = htmlspecialchars($myusername, ENT_QUOTES, "ISO-8859-1");

//$myusername =  mysqli_real_escape_string($db, $myusername);
echo $myusername;
die();

//Security checking V1.
$myusername = stripslashes($myusername);
$myusername = filter_var($myusername, FILTER_SANITIZE_STRING);
$myusername = htmlspecialchars($myusername, ENT_QUOTES, "ISO-8859-1");
$mypassword = stripslashes($mypassword);
$mypassword = filter_var($mypassword, FILTER_SANITIZE_STRING);
$mypassword = htmlspecialchars($mypassword, ENT_QUOTES, "ISO-8859-1");
$passwordcheck = stripslashes($passwordcheck);
$passwordcheck = filter_var($passwordcheck, FILTER_SANITIZE_STRING);
$passwordcheck = htmlspecialchars($passwordcheck, ENT_QUOTES, "ISO-8859-1");

//This declairs the boolians so they dont cause an error
$userspace = 'false';
$passspace = 'false';
$pass2space = 'false';

//test to get &# out of a string.
if (strpos($myusername, '&#') !== false) {
    $userspace = 'true';
}
if (strpos($mypassword, '&#') !== false) {
    $userspace = 'true';
}
if (strpos($mypassword, '&#') !== false) {
    $userspace = 'true';
}

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
$dup = mysqli_query($db, "SELECT username FROM users WHERE username='$myusername'");
$userchecker = mysqli_fetch_assoc($dup);
if(mysqli_num_rows($dup) >0){
    header("location:index.php?dup=1");
    die();
} 

//Encrypts the password
$salt = "qwertgfdert45t456545655";
$mypassword = $mypassword.$salt;
$mypassword = hash('sha256', $mypassword);
$passwordcheck = $passwordcheck.$salt;
$passwordcheck = hash('sha256', $passwordcheck);

//This compares the passwords. If the match then the user is created. If not then the user is told to check again.
if($mypassword==$passwordcheck) {
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
    header("location:index.php?same=1");
    die();
}
?>
