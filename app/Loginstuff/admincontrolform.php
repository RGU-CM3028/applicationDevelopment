<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
</head>
<body>
	
    	<?
	//Thus starts the sessions. And connects the database here.
    	session_start();
    	include ("dbconnect.php");  
		
    	//This prepares the accesslevel.
    	$accesslevel = $_SESSION['userType'];
		
	//This displays the function contents	
    	displayAccessLevelInformation($accesslevel);
if (isset($_SESSION['username'])){
    echo "<p>Hello " . $_SESSION['username'] . "</p>";
    $sql = "SELECT * FROM users WHERE username='". $_SESSION['username'] . "'";
    $result = $db->query($sql);
    while($row = $result->fetch_array()){
        echo "<p>User type is " . $_SESSION['userType'] . "</p>";
    }
	
	
    	//This is the function doing its magic on a set piece of code.	
    	function displayAccessLevelInformation($accesslevel){
		if ($accesslevel == "admin") {
			?>
            		<h1>Signup Form</h1>	
            		<!-- This is the form used for users to sign up -->
            		<form method="post" action="signup.php">
                		<p><input type="text" name="username" value="" placeholder="Username please"></p>
                		<p><input type="password" name="password" value="" placeholder="Password please"></p>
                		<p><input type="password" name="passwordcheck" value="" placeholder="Confirm Password please"></p>
                		<p class="submit"><input type="submit" name="commit" value="Login"></p>
            		</form>
    
            		<!-- This is used to return to the login screen-->
            		<a href="index.php">Return to login screen</a>
            		<?
        	} else {
			//This sends non admins back to the index page
		    	header("location:index.php");
		    	die();
		}
	}
	?>	
	</body>
</html>
