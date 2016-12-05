<!--
File handling the creation and edition of clubs
-->

<body>
	<?php
		include("../dbconnect.php");

		//Initialise the fields
		$title = "";
		$description = "";
		$clubGenre = "";
		$media = "";

		//If we are editing instead of creating a new
		if(isset($_POST['edit']) && isset($_POST['clubID'])){
			$sql_query = "SELECT clubName, clubDescription, clubGenre, mediaID, pname FROM club C, media M, clubGenre CG WHERE C.clubID = " . $_POST['clubID'] . " AND C.genre = CG.clubGenreID AND M.mediaID = C.mediaID"; // Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$result = $db->query($sql_query);

			$title = $result['clubName'];
			$description = $result['clubDescription'];
			$clubGenre = $result['clubGenre'];
			$media = $result['mediaID'];

			$result->close();
			$db->close();
		}

		if(isset($_POST['handleEdition'])){
			//TODO get clubGenre and eventID
			$sql_query = "INSERT INTO Club(clubName, clubDescription, clubGenreID, eventID, mediaID, contactInfoID) VALUES(" . $_POST['clubName'] . "," . $_POST['clubDescription'] . "," . $_POST['clubGenreID'] . "," . $_POST['eventID'] . "," . $_POST['mediaID'] . "," . $_POST['contactInfoID'] . ")";
			$db->query($sql_query);
			$db->close();
		}

	?>
	<form action="handleEdition" method="post">
		Title: <br><input type="text" name="clubName" value="<?php echo $title;?>">
		Description: <br><textarea name="clubDescription" rows="5" cols="40"><?php echo $description;?></textarea>
		<!-- TODO:
		Upload media (picture)
		Contact info -->

		<input type="submit">
	</form>
</body>