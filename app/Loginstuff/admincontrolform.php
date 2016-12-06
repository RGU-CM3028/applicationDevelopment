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
	$boom = "SELECT * FROM users";
    	$result = $db->query($boom);
    	while($row = $result->fetch_array()){
        	echo "<p>All users are: " . $row['username'];
    	}
    	?>
	
	<!--This is the control panel for the admin-->
	<h1>Admin control panel</h1>
        <!-- This is the form used for the admin to control other users privilages -->
	<p>Note: You cant delete yourself. This is so there is always an admin on the system.</p>
	
        <form method="post" action="admincontrol.php">
		
		<!--This is how the admin will select how to edit the profiles-->
		<p>Please select what you want to do with the profile:</p>
		<input type="radio" name="complete" value="" id="safe" />
 			<label for="safe">Dont do a thing</label>
		<input type="radio" name="complete" value="delete" id="delete" />
 			<label for="delete">Delete a user</label>
 		<input type="radio" name="complete" value="usertype" id="usertype" />
 			<label for="usertype">Change usertype</label>
		
		<!--This is how the admin will select what usertype to give a user-->
		<p>If you are changing a users "usertype", please select it here:</p>
		<input type="radio" name="type" value="" id="safe" />
 			<label for="safe">Dont do a thing</label>
		<input type="radio" name="type" value="reader" id="reader" />
 			<label for="single1">reader</label>
 		<input type="radio" name="type" value="admin" id="admin" />
 			<label for="type">admin</label>
		<input type="radio" name="type" value="" id="" />
 			<label for="type">Unspecified</label>
		
		<!--This is how the admin will say what user is going to be edited or deleted-->
		<p>Please select a user:
		<select name='username'>
			<option value="">Select...</option>
			<?
			$boom = "SELECT * FROM users";
    			$result = $db->query($boom);
    			while($row = $result->fetch_array()){
				echo "<option value='" . $row['username'] ."'>" . $row['username'] ."</option>";
    			}
			?>
		</select>
		</p>
		

		
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
