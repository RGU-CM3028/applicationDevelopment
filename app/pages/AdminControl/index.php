<?
include("../../inc/header.inc");

//This connects the database here.
include("../../dbconnect.php");

//This ensures if the user is an admin or not.
$usertypeholder = 'admin';
if ($usertypeholder = $_SESSION['userType']){
	//safe
} else {
	header("location:../../index.php");
	die();
}
?>

<section>
    <div id="admin-control">
        <!--This is the control panel for the admin-->
        <h2>Admin control panel</h2>
        <br>

<?
    //This gets basic user info so the page knows who is logged in.
    if (isset($_SESSION['username'])){
        echo "<p>Currently logged in as " . $_SESSION['username'] . "</p>";
        $sql = "SELECT * FROM users WHERE username='". $_SESSION['username'] . "'";
        $result = $db->query($sql);
        while($row = $result->fetch_array()){
            echo "<p>The current user type is " . $_SESSION['userType'] . "</p>";
        }
			}

?>

        <!-- This is the form used for the admin to control other users privilages -->
				<form class="admincontrol" name="admincontrol" method="post" action="admincontrol2.php">

        <?
            //These are the error messages that appear on this page when the code comes back for it.
            if (isset($_GET['same']))
            {
                echo "<p class='error-red'>Please ensure you dont pick your own username.</font></p>";
            }
            if (isset($_GET['nodata']))
            {
                echo "<p class='error-red'>Please ensure you pick a valid user.</font></p>";
            }
            if (isset($_GET['Fail']))
            {
                echo "<p class='error-red'>Please don't edit the html.</font></p>";
            }
            if (isset($_GET['select']))
            {
                echo "<p class='error-red'>Please pick a option on what to do to the profile.</font></p>";
            }
            if (isset($_GET['delete']))
            {
                echo "<p class='error-green'>Record deleted.</font></p>";
            }
            if (isset($_GET['update']))
            {
                echo "<p class='error-green'>Record updated.</font></p>";
            }
        ?>

            <!--This is how the admin will say what user is going to be edited or deleted-->
            <span>This account cannot be deleted or altered as this is the System Administrator.</span><br>
            <label>Please select a user</label><br>
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
            <br>

            <!--This is how the admin will select how to edit the profiles-->
						<label>Please select what you want to do with the profile</label><br>
            <select name='choice'>
                <option value="">Select...</option>
                <option value="delete">Delete user</option>
                <option value="usertype">Change usertype</option>
            </select>
            <br>

            <!--This is how the admin will select what usertype to give a user-->
						<label>If you are changing a users "usertype", please select it here</label><br>
            <select name='usertype'>
                <option value="">Select...</option>
                <option value="reader">reader</option>
                <option value="admin">admin</option>
                <option value="clubAdmin">clubAdmin</option>
                <option value="NKPAG">NKPAG</option>
            </select>
            <br>

						<label>If you are setting a user to clubdmin, please select the
							club he will manage </label><br>
							<select name='clubID'>
								<option value=''>Select...</option>;
									<?
									$boom = "SELECT * FROM club";
									$result = $db->query($boom);
									while($row = $result->fetch_array()){
										echo "<option value='"
										. $row['clubID'] ."'>"
										. $row['clubName'] ."</option>";
									}
									?>
								</select>
            <input type="submit" name="commit" value="Submit">
        </form>
    </div>
</section>

<?
  include("../../inc/footer.inc");
?>
