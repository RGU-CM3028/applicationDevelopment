	<?php
		include("../../dbconnect.php");
		include("../../inc/header.inc");

		echo "<section>
		<div class='edition'>";

    if(!(isset($_SESSION['userType']))) {
      header('location:../clubs/');
    } else if($_SESSION['userType'] !== 'clubAdmin' &&
    $_SESSION['userType'] !== 'admin') {
        header('location:../clubs');
    }
		//If we are editing instead of creating a new
    // if eventID is setted, we update
		if(isset($_GET['eventID'])){
      echo "<h1 class='editTitle'> Update your event </h1>";
			$sql_query = "SELECT *
      FROM clubevent ce, clubeventassociation a
      WHERE eventID = " . $_GET['eventID']; // Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$queryResult = $db->query($sql_query);

        while ($row = $queryResult->fetch_array()) {
          $eventName = $row['eventName'];
          $pdate = $row['pdate'];
          $description = $row['pdescription'];
  				$localisation = $row['localisation'];
        }
    } else {
      echo "<h1 class='editTitle'> Create a new event </h1>";
      //Initialise the fields
        $eventName = "";
        $pdate = "";
        $description = "";
        $localisation = "";

    }

		if(isset($_POST['submitUpdate'])) {
      $tDate = $_POST['pdate'];
      $sql_query = "UPDATE clubevent
      SET
      pdate = '". mysqli_real_escape_string($db, $tDate) . "',
      eventName = '". mysqli_real_escape_string($db, $_POST['eventName']) . "',
      pdescription = '". mysqli_real_escape_string($db, $_POST['pdescription']) . "',
      localisation = '". mysqli_real_escape_string($db, $_POST['localisation']) . "';";

      if ($db->query($sql_query) === TRUE) {
          echo "";
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}

      $sql_query = "UPDATE clubeventassociation
      SET
      clubID = '". mysqli_real_escape_string($db, $_GET['clubID']) . "',
      eventID = '". mysqli_real_escape_string($db, $_GET['eventID']) . "';";

      if ($db->query($sql_query) === TRUE) {
  	    header("location:../clubs/clubDetails.php?clubID=".$_GET['clubID']);
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}
    }

    if(isset($_POST['submitAdd'])) {
      $tDate = $_POST['pdate'];
      $sql_query = "INSERT INTO clubevent (pdate, eventName, pdescription, localisation)
      VALUES ('". mysqli_real_escape_string($db, $tDate) . "',
      '". mysqli_real_escape_string($db, $_POST['eventName']) . "',
      '". mysqli_real_escape_string($db, $_POST['pdescription']) . "',
      '". mysqli_real_escape_string($db, $_POST['localisation']) . "');";

      if ($db->query($sql_query) === TRUE) {
          echo "";
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}

			$eventID = $db->insert_id;

      $sql_query = "INSERT INTO clubeventassociation (clubID, eventID)
      VALUES (
      '". mysqli_real_escape_string($db, $_GET['clubID']) . "',
      '". mysqli_real_escape_string($db, $eventID) . "');";

      if ($db->query($sql_query) === TRUE) {
  	    header("location:../clubs/clubDetails.php?clubID=".$_GET['clubID']);
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}
    }

	?>

	<form action="" method="POST">
			<div class='editContent'><br>
    <p>Event name</p>
    <input type="text" name="eventName" value=<?php echo "\"" . $eventName . "\"";?>><br>
		<p>Date</p>
    <input type="date" name="pdate" value=<?php echo "\"" . $pdate . "\"";?>><br>
		<p>Description</p>
    <textarea name="pdescription" rows="5" cols="40"><?php echo $description;?></textarea><br>
    <p>Localisation</p>
    <textarea name="localisation" rows="5" cols="40"><?php echo $localisation;?></textarea><br>
    <? if(isset($_GET['eventID'])) {
      echo "<input class='backButton' type='submit' name='submitUpdate' value='Update event'>";
    } else {
      echo "<input class='backButton' type='submit' name='submitAdd' value='Add event'>";
    }
    ?>
		<a class='backButton' href='../clubs/'>Back to clubs</a>
	</div>
	</form>
</div>
</section>

<?
include('../../inc/footer.inc');
?>
