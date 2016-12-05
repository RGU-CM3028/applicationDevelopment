<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Control Pannel</title>
</head>
<body>

<?
//This starts the sessions. And connects the database here.
session_start();
include ("dbconnect.php");    
        
//This checks to see if the user is logged in or not. If the user is logged in then the user is able to see the following text.
if (isset($_SESSION['username']))
{
    echo "<p>Hello " . $_SESSION['username'] . "</p>";
    $sql = "SELECT * FROM users WHERE username='". $_SESSION['username'] . "'";
    $result = $db->query($sql);
    while($row = $result->fetch_array())
    {
        echo "<p>User type is " . $_SESSION['userType'] . "</p>";
        echo "<p>Welcome to the admin control pannel.</p>";
    }
    ?>
    
     <!--This is a link to go back to the index page-->
    <a href="lindex.php">Index page</a>
    <!--This is a link to logout the site-->
    <a href="logout.php">Logout</a>
    
    <?
}
    //If the user isnt logged in then they see the following form. To log in.
    else
{
?>
    
    <!--This is the form header-->
    <h1>Admin Control</h1> 
    
    <?   
    <!--This is placeholder till I finish the security on the main login stuff-->
    <form method="post" action="admincontrol.php">
    <p><input type="text" name="placeholder" value="" placeholder="Username please"></p>
    <p><input type="password" name="placeholder" value="" placeholder="Password please"></p>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>

<? } ?>

</body>
</html>
