<?
//This code removes the users session. And also clears other sessions that are in the way.
session_start();

//This clears the username session.
if (isset($_SESSION['username']))
{
    unset($_SESSION['username']);
}

//This clears the userType session.
if (isset($_SESSION['userType']))
{
    unset($_SESSION['userType']);
}

//This sends the user back to the index page.
header("location:../index.php");
?>
