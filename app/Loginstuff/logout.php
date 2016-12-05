<?
//This code removes the users session. And also clears other sessions that are in the way.
session_start();
if (isset($_SESSION['username']))
{
    unset($_SESSION['username']);
}
if (isset($_SESSION['Signupfail']))
{
    unset($_SESSION['Signupfail']);
}
if (isset($_SESSION['Loginfail']))
{
    unset($_SESSION['Loginfail']);
}
header("location:index.php");
?>
