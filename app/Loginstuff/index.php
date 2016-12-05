<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
</head>
<body>

<?
//This starts the sessions. And connects the database here..
session_start();
include ("dbconnect.php");    
        
//This checks to see if the user is logged in or not. If the user is logged in then the user is able to see the following text.
if (isset($_SESSION['username']))
{
    $accesslevel = $_SESSION['userType'];
    displayAccessLevelInformation($accesslevel);
    
    function displayAccessLevelInformation($accessLevel)
    {
        if ($accessLevel == 'reader')
        {
            
        ?>
        <!--This is a link to logout the site-->
        <a href="logout.php">Logout</a>
        <?
            
            echo "<p style = \"background-color: lightgreen\">You are currently logged in as a standard user</p>";
        }
        elseif ($accessLevel == 'admin') 
        {
    
    ?>        
    <!--This is a link to logout the site-->
    <a href="logout.php">Logout</a>
    <!--This leads to the admin page-->
    <a href="admincontrolform.php">Admin Control Pannel</a>
    <?
            
            echo "<p<p style = \"background-color: red\">You are currently logged in as a root user</p>";
            echo "<p<p style = \"background-color: red\">You now have access to additional administrative features</p>";
        }
    }
    
    
    
    //Test alpha
    
}
    //If the user isnt logged in then they see the following form. To log in.
    else
{
?>
    
    <!--This is the form header-->
    <h1>Login</h1>  
    <!--This is the form used to login-->
    <form method="post" action="checklogin.php">
    <p><input type="text" name="username" value="" placeholder="Username please"></p>
    <p><input type="password" name="password" value="" placeholder="Password please"></p>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>
    
    <!--This is a link to signup to the site-->
    <a href="signupform.php">Signup</a>

<? } ?>

</body>
</html>
