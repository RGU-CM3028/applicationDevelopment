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
include("../dbconnect.php");

//This prepares the accesslevel.
$accesslevel = $_SESSION['userType'];
	
//This displays the function contents	
displayAccessLevelInformation($accesslevel);
//This is the function doing its magic on a set piece of code.	
function displayAccessLevelInformation($accessLevel){
	if ($accessLevel == "admin") {
		?>
		<!--This leads to the admin page-->    
		<a href="../AdminControl/admincontrolform.php">Admin Control Pannel</a>    
		<?
	}
}
	
//This checks to see if the user is logged in or not. If the user is logged in then the user is able to see the following text.
if (isset($_SESSION['username'])){
    echo "<p>Hello " . $_SESSION['username'] . "</p>";
    $sql = "SELECT * FROM users WHERE username='". $_SESSION['username'] . "'";
    $result = $db->query($sql);
    while($row = $result->fetch_array()){
        echo "<p>User type is " . $_SESSION['userType'] . "</p>";
    }
    ?>
    <!--This is a link to logout the site-->
    <a href="logout.php">Logout</a>
    <?
	
}
    //If the user isnt logged in then they see the following form. To log in.
    else{
?>
    
    <!--This is the form header-->
    <h1>Login</h1> 
    
    <?
    //This is the error message for if there is a login fail.
    if(isset($_GET["Loginfail"]))  
    {  
        echo "<p><font color='red'>Please make sure you enter the correct information.</font></p>";  
 }  
    ?>
    
    <!--This is the form used to login-->
    <form method="post" action="checklogin.php">
    <p><input type="text" name="username" value="" placeholder="Username please"></p>
    <p><input type="password" name="password" value="" placeholder="Password please"></p>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>
    
    <!--This is a link to signup to the site-->
    <a href="signupform.php">Signup</a>
    <a href="../loginstuff/Tempadminform.php">Temp Admin signup</a>
<? } ?>

</body>
</html>
