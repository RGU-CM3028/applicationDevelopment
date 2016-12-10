<?
//This connects the database and continues the session onto this page.
include("../../inc/header.inc");
session_start();
include("../dbconnect.php");

//This code stops anyone but new users getting on this page.
$usertypeholder1 = 'admin';
$usertypeholder2 = 'reader';
$usertypeholder3 = 'NKPAG';
if ($usertypeholde1 = $_SESSION['userType'] || $usertypeholder2 = $_SESSION['userType'] || $usertypeholder3 = $_SESSION['userType'] )
{
    header("location:../../index.php");
    die();
} else 
{
    //safe
}
?>

<section>
    <div class="register-box">

        <!-- This is the form used for users to sign up -->
        <form class="register" name="signup" method="post" action="signup.php">		
            <h1>Signup Form</h1>
            <?
            //This is used to get the error message associated to the error code.
            if (isset($_GET['space'])){
                echo "<p class='error-red'>Please ensure you dont use spaces in your username or password.</p>";
            }
            if (isset($_GET['empty'])){
                echo "<p class='error-red'>Please ensure you fill all the fields.</p>";
            }
            if (isset($_GET['same'])){
                echo "<p class='error-red'>Please ensure the password fields match.</p>";
            }
            if (isset($_GET['dup'])){
                echo "<p class='error-red'>Username already taken.</p>";
            }
            ?>
             <label>Note if you attempt to put in HTML tags they will fail.</label><br>
            <label>Username</label><br>
            <input type="text" name="username" maxlength="30"><br>
            <label>Password</label><br>
            <input type="password" name="password" maxlength="25"><br>
            <label>Confirm Password</label><br>
            <input type="password" name="passwordcheck" maxlength="25"><br><br>
            <input type="submit" name="commit" value="Register">
        </form>
    </div>
</section>
<?
include("../../inc/footer.inc");
?> 
