<?
    //This connects the database and continues the session onto this page.
    //include("../../inc/header.inc");
    session_start();
    include("../dbconnect.php");
	
$usertypeholder1 = 'admin';
$usertypeholder2 = 'reader';
$usertypeholder3 = 'NKPAG';
   if ($usertypeholde1 = $_SESSION['userType'] || $usertypeholder2 = $_SESSION['userType'] || $usertypeholder3 = $_SESSION['userType'] ){
	?>
	    
	    <!--This is the header for the form-->
            <h1>Signup Form</h1>
	
            <?
            //This is used to get the error message associated to the error code.
            if (isset($_GET['space'])){
                echo "<p><font color='red'>Please ensure you dont use spaces in your username or password.</font></p>";
            }
            if (isset($_GET['empty'])){
                echo "<p><font color='red'>Please ensure you fill all the fields.</font></p>";
            }
            if (isset($_GET['same'])){
                echo "<p><font color='red'>Please ensure the password fields match.</font></p>";
            }
            if (isset($_GET['dup'])){
                echo "<p><font color='red'>Username already taken.</font></p>";
            }
            ?>
    
            <!-- This is the form used for users to sign up -->
            <form method="post" action="signup.php">
                <p><input type="text" name="username" value="" placeholder="Username please"></p>
                <p><input type="password" name="password" value="" placeholder="Password please"></p>
                <p><input type="password" name="passwordcheck" value="" placeholder="Confirm Password please"></p>
                <p class="submit"><input type="submit" name="commit" value="Login"></p>
            </form>
    
            <!-- This is used to return to the login screen-->
            <a href="../../index.php">Return to login screen</a>
            <?
} else {
	header("location:../../index.php");
	die();
}
	
  include("../../inc/footer.inc");
    ?> 
