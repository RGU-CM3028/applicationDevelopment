<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
</head>
<body>

<?
session_start();
include ("db_connect.php");

if (isset($_SESSION['username']))
{
    echo "<p>Hello " . $_SESSION['username'] . "</p>";
    $sql = "SELECT * FROM users WHERE username='". $_SESSION['username'] . "'";
    $result = $db->query($sql);
    while($row = $result->fetch_array())
    {
        echo "<p>User type is " . $row['userType'] . "</p>";
    }
    ?>
    
    <a href="logout.php">Logout</a>
    
    <?
} else {
?>
    <h1>Login</h1>
    <form method="post" action="checklogin.php">
    <p><input type="text" name="username" value="" placeholder="Username"></p>
    <p><input type="password" name="password" value="" placeholder="Password"></p>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>
    
    <a href="signupform.php">Signup</a>
    
<? } ?>
</body>
</html>
