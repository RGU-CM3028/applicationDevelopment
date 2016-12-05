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
//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];
    
//This displays the function contents	
displayAccessLevelInformation($accesslevel);
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accessLevel){
	if ($accessLevel == "admin") {
	    ?>
	    <!--Admin control pannel-->    
	    <form method="post" action="admincontrol.php">
        <p><input type="text" name="placeholder" value="" placeholder="placeholder"></p>
        <p><input type="password" name="placeholder" value="" placeholder="placeholder"></p>
        <p class="submit"><input type="submit" name="commit" value="Placeholder"></p>
        </form>
        <a href="index.php">Return to login screen</a>
	    <?
        echo "<p>User type is " . $_SESSION['userType'] . "</p>";
        echo "<p>Welcome to the admin control pannel.</p>";
	} else {
            echo "<p>No access allowed. Please head to another page.<p>
            ?>
            <a href="index.php">Return to login screen</a>
            <?
    }
}
?>

</body>
</html>
