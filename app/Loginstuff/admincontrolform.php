<?php
//This starts the sessions. And connects the database here..
session_start();
include ("dbconnect.php");    
//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];

//This displays the function contents	
displayAccessLevelInformation($accesslevel);
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accessLevel){
	
	//If the user is an admin, the following code works
	if ($accessLevel == "admin") {
		?>
		<!--This is the control panel instructions(version1)-->    
		<p>This is where the admin would select a user from the dropbox of all users, then selects who they want to make an admin.</p> 
		<p>This is also where the admin can delete users.</p>
		<p>This is where the admin .</p>

		<!--This is where the controls would go(version1)--> 
		<h1>Admin controls</h1>
    		<form method="post" action="admincontrols.php">
    			<p><input type="text" name="username" value="" placeholder="Username please"></p>
    			<p><input type="password" name="password" value="" placeholder="Placeholder please"></p>
    			<p class="submit"><input type="submit" name="commit" value="Submit"></p>
			<p>Please select a user:
				<select name="formuser">
					<option value="">Select...</option>
					<?
					$sql = "SELECT username FROM users";
					$result = mysqli_query($sql);
					while ($row = mysqli_fetch_array($result)) {
    						echo "<option value='" . $row['username'] ."'>" . $row['username'] ."</option>";
					}
					?>
				</select>
			</p>
    		</form>

            	<!-- This is used to return to the login screen-->
            	<a href="index.php">Return to login screen</a>
		<?
	}
	//Otherwise the code sends the user back to the index page.
	else {
		header("location:index.php");
		die();
	}
		
}
