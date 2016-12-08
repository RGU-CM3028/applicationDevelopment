 <?
     // imports the header/navigation
    include("../../inc/header2.inc");
    include('../../dbconnect.php');
    
    //This connects the database and continues the session onto this page.
    //session_start();
	
    //This prepares the accesslevel.
    $accesslevel = $_SESSION['userType'];
	
    //This displays the function contents	
    displayAccessLevelInformation($accesslevel);
	
    //This is the function doing its magic on a set piece of code.	
    function displayAccessLevelInformation($accesslevel){
	    if ($accesslevel == "admin"  || $accesslevel == "reader" || $accesslevel == "NKPAG") {
		    
		    //This sends already signed in users back to the index page
		    header("location:index.php");
		    die();
	    } else {
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
            <?
        }
    }
    // imports the footer
    include("../../inc/footer.inc");
?>
