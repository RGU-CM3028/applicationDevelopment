<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Control panel</title>
</head>
<body>
	
<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//This starts the sessions. And connects the database here.
session_start();
include ("dbconnect.php");  
	
//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];
	
//This displays the function contents	
displayAccessLevelInformation($accesslevel);
	
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accesslevel){
	//This checks to see if the user is an admin or not.
	if ($accesslevel != "admin") {
		//This sends already signed in users back to the index page
		header("location:index.php");
		die();
	}
}
	
//This nabs basic user info so the page says who is on it.
if (isset($_SESSION['username'])){
    	echo "<p>Hello " . $_SESSION['username'] . "</p>";
    	$sql = "SELECT * FROM users WHERE username='". $_SESSION['username'] . "'";
    	$result = $db->query($sql);
    	while($row = $result->fetch_array()){
        	echo "<p>User type is " . $_SESSION['userType'] . "</p>";
    	}
    	?>
	
	<!--This is the control panel for the admin-->
	<h1>Admin control panel</h1>
        <!-- This is the form used for the admin to control other users privilages -->
        <form method="post" action="admincontrol.php">
        	<p><input type="text" name="username" value="" placeholder="Username"></p>
                <p><input type="password" name="password" value="" placeholder="Password please"></p>
		
		<p>Please select a user:</p>
		
		<?
	    	$sql = "SELECT * FROM users";
    		$result = $db->query($sql);
		echo "<select name='username'>";
		echo "<option value="">Select...</option>";
    		while($row = $result->fetch_array()){
        		echo "<option value='" . $row['username'] ."'>" . $row['username'] ."</option>";
    		}
		echo "</select>";
		?>
		
                <p class="submit"><input type="submit" name="commit" value="Submit"></p>
        </form>
    	<!--This is a link to logout the site-->
    	<a href="logout.php">Logout</a>
	<a href="index.php">Return to login screen</a>
	<?
}
    ?> 
</body>
</html>
