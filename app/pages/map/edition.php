<!--
File handling the creation and edition of points, area and path
-->

	<?php
		include("../../dbconnect.php");
    include("../../inc/header.inc");

    if(!(isset($_SESSION['userType']))) {
      //header('location:./');
      echo "1";
    } else if($_SESSION['userType'] !== 'NKAPG' ||
    $_SESSION['userType'] !== 'admin') {
        //header('location:./');
      echo "2";
    }

		//If we are editing instead of creating a new
    // if clubID is setted, we update
		if(isset($_GET['clubID'])){
      echo "<h1> Update your club </h1>";
			$sql_query = "SELECT clubName, clubDescription, clubGenreID, pname, adress, phone, email FROM club WHERE clubID = " . $_GET['clubID']; // Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$queryResult = $db->query($sql_query);

        while ($row = $queryResult->fetch_array()) {
          $title = $row['clubName'];
  				$description = $row['clubDescription'];
  				$clubGenreID = $row['clubGenreID'];
  				$pname = $row['pname'];
  				$adress = $row['adress'];
  				$phone = $row['phone'];
  				$email = $row['email'];
        }
    } else {
      echo "<h1> Create a new club </h1>";
      //Initialise the fields
      $title = "";
      $description = "";
      $clubGenreID = "";
      $media = "";
      $pname = "";
      $adress = "";
      $phone = "";
      $email = "";
    }

    if(isset($_POST['submitAdd'])) {
      $sql_query = "INSERT INTO Club (clubName, clubDescription, clubGenreID,
        logoID, pname, adress, phone, email) VALUES ('"
      . $_POST['clubName'] . "',' "
      . $_POST['clubDescription'] . "',' "
      . $_POST['clubGenreID'] . "',
        0,' "
      . $_POST['pname'] . "',' "
      . $_POST['adress'] . "',' "
      . $_POST['phone'] . "',' "
      . $_POST['email'] . "');";

      if ($db->query($sql_query) === TRUE) {
      	    echo "New club created successfully";
      	} else {
      	    echo "Error: " . $sql_query . "<br>" . $db->error;
      	}
    }
    if(isset($_POST['submitUpdate'])) {

        $sql_query = "UPDATE Club
        SET clubName='".$_POST['clubName']."',
        clubDescription='".$_POST['clubDescription']."',
        clubGenreID='".$_POST['clubGenreID']."',
        pname='".$_POST['pname']."',
        adress='".$_POST['adress']."',
        phone='".$_POST['phone']."',
        email='".$_POST['email']."'
         WHERE clubID='".$_GET['clubID']."'";

        if ($db->query($sql_query) === TRUE) {
              //header("location:clubDetails.php?clubID=".$_GET['clubID']);
          } else {
              echo "Error: " . $sql_query . "<br>" . $db->error;
          }
      }
	?>
	<form action="" method="POST">
		Title : <br>
    <input type="text" name="clubName" value=<?php echo "\"" . $title . "\"";?>><br>
		Description : <br>
    <textarea name="clubDescription" rows="5" cols="40"><?php echo $description;?></textarea><br>
    <input type='number' name="clubGenreID" value=<?php echo "\"" . $clubGenreID . "\"";?>><br>
    <br>Contact info<br>
		Name: <br><input type="text" name="pname" value=<?php echo "\"" . $pname . "\"";?>><br>
		Address: <br><input type="text" name="adress" value=<?php echo "\"" . $adress . "\"";?>><br>
		Phone: <br><input type="tel" name="phone" value=<?php echo "\"" . $phone . "\"";?>><br>
		Email: <br><input type="email" name="email" value=<?php echo "\"" . $email . "\"";?>><br>

    <? if(isset($_GET['clubID'])) {
      echo "<input type='submit' name='submitUpdate' value='Update club'>";
    } else {
      echo "<input type='submit' name='submitAdd' value='Add club'>";
    }
    ?>
    <a href='./'>Back to the map</a>
	</form>
</body>

<?
include('../../inc/footer.inc');
?>  
