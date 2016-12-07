<?
// imports the header/navigation
include("../../inc/header.inc");
//This starts the sessions. And connects the database here.
session_start();
include("../dbconnect.php"); 
	
//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];
	
//This displays the function contents	
displayAccessLevelInformation($accesslevel);
	
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accesslevel){
	//This checks to see if the user is an admin or not.
	if ($accesslevel != "admin") {
		//This sends already signed in users back to the index page
		header("location:../index.php");
		die();
	}
}
?>
	
<!--This is the control panel for the admin-->
<h1>Admin control panel</h1>
<!-- This is the form used for the admin to control other users privilages -->
<p>Note: You cant delete yourself. This is so there is always an admin on the system.</p>
<?
	
//This nabs basic user info so the page says who is on it.
if (isset($_SESSION['username'])){
    	echo "<p>Hello " . $_SESSION['username'] . "</p>";
    	$sql = "SELECT * FROM users WHERE username='". $_SESSION['username'] . "'";
    	$result = $db->query($sql);
    	while($row = $result->fetch_array()){
        	echo "<p>User type is " . $_SESSION['userType'] . "</p>";
    	}
	if (isset($_GET['Same'])){
            echo "<p><font color='red'>Please ensure you dont pick your own username.</font></p>";
        }
        if (isset($_GET['nodata'])){
            echo "<p><font color='red'>Please ensure you pick a valid user.</font></p>";
        }
        if (isset($_GET['fail'])){
            echo "<p><font color='red'>Please don't edit the html.</font></p>";
        }
        if (isset($_GET['select'])){
            echo "<p><font color='red'>Please pick a option on what to do to the profile.</font></p>";
        }?>
        <form method="post" action="admincontrol.php">
		
		<!--This is how the admin will select how to edit the profiles-->
		<p>Please select what you want to do with the profile:
		<select name='choice'>
			<option value="">Select...</option>
			<option value="delete">Delete user</option>
			<option value="usertype">Change usertype</option>
		</select>
		</p>
		
		<!--This is how the admin will select what usertype to give a user-->
		<p>If you are changing a users "usertype", please select it here:
		<select name='usertype'>
			<option value="">Select...</option>
			<option value="reader">reader</option>
			<option value="admin">admin</option>
			<option value="unspecified">Unspecified</option>
		</select>
		</p>
		
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
    	<a href="../login/logout.php">Logout</a>
	<a href="../index.php">Return to login screen</a>
	<?
}
// imports the footer
include("../../inc/footer.inc");
    ?> 
