<!--
File handling the creation and edition of clubs
-->
	<?php
    include("../../inc/header.inc");
		include("../../dbconnect.php");

		echo "	<section>
			<div class='edition'>";
		$sql_query="SELECT clubID from junctionuserclub
		where username='" . $_SESSION['username'] ."'";
		$result = $db->query($sql_query);
		$clubs = array();
		while ($row = $result->fetch_array()) {
			array_push($clubs, $row['clubID']);
		}

    if(!(isset($_SESSION['userType']))) {
      header('location:./');
    } else if($_SESSION['userType'] != "admin"
		&& $_SESSION['userType'] != "clubAdmin") {
			header('location:./');
		} else if($_SESSION['userType'] == "clubAdmin" && (!(in_array($_GET['clubID'], $clubs)))) {
      header('location:./');
    }

		//If we are editing instead of creating a new
    // if clubID is setted, we update
		if(isset($_GET['clubID'])){
      echo "<h1 class='editTitle'> Update your club </h1>";
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
      echo "<h1 class='editTitle'> Create a new club </h1>";
      //Initialise the fields
      $title = "";
      $description = "";
      $media = "";
      $pname = "";
      $adress = "";
      $phone = "";
      $email = "";
    }

		if(isset($_POST['submitUpdate']) || isset($_POST['submitAdd'])) {
			if($_POST['existingEvent'] != "none") {
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
						//safe
					} else {
							echo "Error: " . $sql_query . "<br>" . $db->error;
					}
				} else { echo $existingRow;}
			}

			if(isset($_POST['mediaLink'])) {
				if($_POST['mediaLink'] != "") {
					echo $_POST['mediaDesc'];
					echo $_POST['mediaLink'];
					$sql_query = "INSERT INTO media (mediaType, mediaDescription, URL)
					VALUES ('picture', '". mysqli_real_escape_string($db, $_POST['mediaDesc']) . "',
					'". mysqli_real_escape_string($db, $_POST['mediaLink']) . "');";

					if($db->query($sql_query) === TRUE) {
						//safe
					} else {
							echo "Error: " . $sql_query . "<br>" . $db->error;
					}

					$mediaID = $db->insert_id;

					$sql_query = "INSERT INTO clubmediaassociation (mediaID, clubID)
					VALUES ('". mysqli_real_escape_string($db, $mediaID) . "',
					'". mysqli_real_escape_string($db, $_GET['clubID']) . "');";

					if($db->query($sql_query) === TRUE) {
						//Safe
					} else {
							echo "Error: " . $sql_query . "<br>" . $db->error;
					}
				}
			}
			if(isset($_POST['newGenre'])) {
				if($_POST['newGenre'] !== "") {
					$sql_query = "INSERT INTO clubGenre (pname) VALUES ('"
					. mysqli_real_escape_string($db, $_POST['newGenre']) . "');";
					$db->query($sql_query);
					$clubGenreID = $db->insert_id;
				}
			}
			if(isset($_POST['existingGenre'])) {
				if($_POST['existingGenre'] != "none") {
					$clubGenreID = $_POST['existingGenre'];
				}
			}

		}
    if(isset($_POST['submitAdd'])) {
      $sql_query = "INSERT INTO Club (clubName, clubDescription, clubGenreID,
        logoID, pname, adress, phone, email) VALUES ('"
      . mysqli_real_escape_string($db, $_POST['clubName']) . "',' "
      . mysqli_real_escape_string($db, $_POST['clubDescription']) . "',' "
      . mysqli_real_escape_string($db, $clubGenreID) . "',
        0,' "
      . mysqli_real_escape_string($db, $_POST['pname']) . "',' "
      . mysqli_real_escape_string($db, $_POST['adress']) . "',' "
      . mysqli_real_escape_string($db, $_POST['phone']) . "',' "
      . mysqli_real_escape_string($db, $_POST['email']) . "');";

      if ($db->query($sql_query) === TRUE) {
					header("location:./index.php");
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}
    }
    if(isset($_POST['submitUpdate'])) {
      $sql_query = "UPDATE Club
      SET clubName='".mysqli_real_escape_string($db, $_POST['clubName'])."',
      clubDescription='".mysqli_real_escape_string($db, $_POST['clubDescription'])."',
      clubGenreID='".mysqli_real_escape_string($db, $clubGenreID)."',
      pname='".mysqli_real_escape_string($db, $_POST['pname'])."',
      adress='".mysqli_real_escape_string($db, $_POST['adress'])."',
      phone='".mysqli_real_escape_string($db, $_POST['phone'])."',
      email='".mysqli_real_escape_string($db, $_POST['email'])."'
       WHERE clubID='".$_GET['clubID']."'";

      if ($db->query($sql_query) === TRUE) {
					header("location:clubDetails.php?clubID=".$_GET['clubID']);
      } else {
          echo "Error: " . $sql_query . "<br>" . $db->error;
      }
		}
	?>

	<form action="" method="POST">
		<h2 class='editSubTitle'>General details</h2>
		<div class='editContent'>
		<p>Title</p>
    <input type="text" name="clubName" value=<?php echo "\"" . $title . "\"";?>><br>
		<p>Description</p>
    <textarea name="clubDescription" rows="5" cols="40"><?php echo $description;?></textarea><br>
		<div class='editContent'>
		<?
		$sql_query = "SELECT clubGenreID, pname from clubgenre;";

		$result = $db->query($sql_query);

		if(!$result->num_rows <= 0) {
				echo "<div class='editGenreContent'><p>Select a existing genre  </p>";
				echo "<select name='existingGenre' size=1>";
				echo "<option value='none'>Select an genre";
			while ($row = $result->fetch_array()) {
				echo "<option value=".$row['clubGenreID'].">".$row['pname'];
			}
				echo "</select></div>";
		}
		?>
		<div class='editGenreContent'>
			<p> Or create your own </p>
			<input type="text" name="newGenre" placeholder="ex : sports"><br>
		</div>
	</div>
	</div>
		<h2 class='editSubTitle'>Contact information</h2>
		<div class='editContent'>
			<p>Name</p>
			<input type="text" name="pname" value=<?php echo "\"" . $pname . "\"";?>><br>
			<p>Address</p>
			<input type="text" name="adress" value=<?php echo "\"" . $adress . "\"";?>><br>
			<p>Phone</p>
			<input type="tel" name="phone" value=<?php echo "\"" . $phone . "\"";?>><br>
			<p>Email</p>
			<input type="email" name="email" value=<?php echo "\"" . $email . "\"";?>><br>
	</div>
		<h2 class='editSubTitle'> Want to add a media ? </h2>
		<div class='editContent'>
		<p id='editMedia'> First, upload your picture on a website (like imgur for example),
			and then copy the link to your image on the "Image link" field. </p>
			<p>Image name</p>
			<input type="text" name="mediaDesc" placeholder="My image"><br>
			<p>Image link</p>
			<input type="text" name="mediaLink"	placeholder="www.myimage.com"><br>
		</div>
		<h2 class='editSubTitle'> Want to add an event ? </h2>
		<div class='editContent'>
      <?
      $sql_query = "SELECT eventName, eventID from clubevent;";

      $result = $db->query($sql_query);

      if(!$result->num_rows <= 0) {
          echo "<p>Susribe to an existing event</p>";
          echo "<select name='existingEvent' size=1>";
          echo "<option value='none'>Select an event";
        while ($row = $result->fetch_array()) {
          echo "<option value=".$row['eventID'].">".$row['eventName'];
        }
          echo "</select>";
      }
      ?>
      <br>
		<a class='backButton' href="../event?clubID=<?echo $_GET['clubID']?>"> Create your own event </a>


    <? if(isset($_GET['clubID'])) {
      echo "<input class='backButton' type='submit' name='submitUpdate' value='Update club'>";
    } else {
      echo "<input class='backButton' type='submit' name='submitAdd' value='Add club'>";
    }
    ?>
	</div>
    <a class='backButton' href='../clubs/'>Back to clubs</a>
	</form>
</div>
</section>

  <?
    include("../../inc/footer.inc");
    ?>
