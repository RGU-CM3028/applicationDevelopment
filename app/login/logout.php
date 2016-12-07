<?
//This code removes the users session. And also clears other sessions that are in the way.
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
//header("location:index.php");
?>
