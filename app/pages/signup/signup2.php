<?php
$aqq="SELECT *FROM users WHERE username=?";
$sss=mysqli_prepare($db, $sqq);
$sss->bind_param("sss", $auu);
$auu=$_POST['username'];
$pea=$_POST['password'];
$peas=$_POST['passwordcheck'];
$sss->execute();
if(!empty($auu) && !empty(!$pea) && !empty(!$peas) && $sss->fetch()<1){
    $iq = "INSERT INTO users (username, password, userType) VALUES (?,?,?)";
    $iqq = mysqli_prepare($db, $iq);
    $iq->bind_param("sss", $names, $passes, $usertype);
    $names = $_POST["username"];
    $passes = $_POST["password"];
    $usertype = 'readder';
    $iqq->execute();
    $_SESSION['username'] = $names;
    $_SESSION['userType'] = 'reader';
    header("location:index.php");
}
//This checks to see if the fields are empty or not.
if(empty($myusername) || empty($mypassword) || empty($passwordcheck))
    {
    header("location:index.php?empty=1");
    die();
}
?>
