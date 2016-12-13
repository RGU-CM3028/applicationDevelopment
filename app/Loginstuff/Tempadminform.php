<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
</head>
<body>
    <h1>Signup Form</h1>
    <?/*
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
    <form method="post" action="TempAdmin.php">
        <p><input type="text" name="username" value="" placeholder="Username please"></p>
        <p><input type="password" name="password" value="" placeholder="Password please"></p>
        <p><input type="password" name="passwordcheck" value="" placeholder="Confirm Password please"></p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
    </form>
    
    <!-- This is used to return to the login screen-->
    <a href="../login/index.php">Return to login screen</a>
</body>
</html>
