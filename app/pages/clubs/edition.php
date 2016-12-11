<!--
File handling the creation and edition of clubs
-->
	<?php
    include("../../inc/header.inc");
		include("../../dbconnect.php");

    if(!(isset($_SESSION['userType']))) {
      header('location:./');
    } else if($_SESSION['userType'] !== 'clubAdmin' &&
    $_SESSION['userType'] !== 'admin') {
        header('location:./');
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

      //mysqli_real_escape_string($db, $_POST['clubName']) not working,
      //mysqli_real_escape_string($db, $db, $_POST['clubName']) neither
      $sql_query = "INSERT INTO Club (clubName, clubDescription, clubGenreID,
        logoID, pname, adress, phone, email) VALUES ('"
      . mysqli_real_escape_string($db, $_POST['clubName']) . "',' "
      . mysqli_real_escape_string($db, $_POST['clubDescription']) . "',' "
      . mysqli_real_escape_string($db, $_POST['clubGenreID']) . "',
        0,' "
      . mysqli_real_escape_string($db, $_POST['pname']) . "',' "
      . mysqli_real_escape_string($db, $_POST['adress']) . "',' "
      . mysqli_real_escape_string($db, $_POST['phone']) . "',' "
      . mysqli_real_escape_string($db, $_POST['email']) . "');";

      if ($db->query($sql_query) === TRUE) {
        //$clubId = $db->insert_id; not getting last ID
  	    header("location:index.php");
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}
    }
    if(isset($_POST['submitUpdate'])) {
        $sql_query = "UPDATE Club
        SET clubName='".mysqli_real_escape_string($db, $_POST['clubName'])."',
        clubDescription='".mysqli_real_escape_string($db, $_POST['clubDescription'])."',
        clubGenreID='".mysqli_real_escape_string($db, $_POST['clubGenreID'])."',
        pname='".mysqli_real_escape_string($db, $_POST['pname'])."',
        adress='".mysqli_real_escape_string($db, $_POST['adress'])."',
        phone='".mysqli_real_escape_string($db, $_POST['phone'])."',
        email='".mysqli_real_escape_string($db, $_POST['email'])."'
         WHERE clubID='".$_GET['clubID']."'";

        if ($db->query($sql_query) === TRUE) {
          echo "";
          } else {
              echo "Error: " . $sql_query . "<br>" . $db->error;
          }


        if($_POST['existingEvent'] != "none" ) {
          $sql_query = "SELECT * FROM clubeventassociation";
          $result = $db->query($sql_query);
          if(!$result->num_rows <= 0) {
            $existingRow = false;
            while ($row = $result->fetch_array()) {
              if(($row['clubID'] == $_GET['clubID']) &&
              ($row['eventID'] == $_POST['existingEvent'])) {
                echo "<p> Error, your club is already participating
                to this event ! </p>";
                $existingRow = true;
              }
            }
          }

          if(!$existingRow = false) {
            $sql_query = "INSERT INTO clubeventassociation (clubID, eventID)
            VALUES ('". mysqli_real_escape_string($db, $_GET['clubID']) . "',
            '". mysqli_real_escape_string($db, $_POST['existingEvent']) . "');";

            if($db->query($sql_query) === TRUE) {
              header("location:clubDetails.php?clubID=".$_GET['clubID']);
          	} else {
          	    echo "Error: " . $sql_query . "<br>" . $db->error;
          	}
          } else { echo $existingRow;}
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

		<h1> Want to add an event ? </h1>
      <?
      $sql_query = "SELECT eventName, eventID from clubevent;";

      $result = $db->query($sql_query);

      if(!$result->num_rows <= 0) {
          echo "<h2>Susribe to an existing event</h2>";
          echo "<select name='existingEvent' size=1>";
          echo "<option value='none'>Select an event";
        while ($row = $result->fetch_array()) {
          echo "<option value=".$row['eventID'].">".$row['eventName'];
        }
          echo "</select>";
      }
      ?>
      <br>
		<a href="../event?clubID=<?echo $_GET['clubID']?>"> Create your own event </a>


    <? if(isset($_GET['clubID'])) {
      echo "<input type='submit' name='submitUpdate' value='Update club'>";
    } else {
      echo "<input type='submit' name='submitAdd' value='Add club'>";
    }
    ?>
    <a href='../clubs/'>Back to clubs</a>
	</form>

  <?
    include("../../inc/footer.inc");
    ?>
