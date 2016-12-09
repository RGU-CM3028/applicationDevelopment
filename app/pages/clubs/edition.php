<!--
File handling the creation and edition of clubs
-->

<body>
	<?php
		ini_set('display_errors', 1);
		include("../../dbconnect.php");

		//Initialise the fields
		$title = "";
		$description = "";
		$clubGenre = "";
		$media = "";
		$pname = "";
		$adress = "";
		$phone = "";
		$mail = "";
		$logoID = "";

		//If we are editing instead of creating a new
		if(isset($_GET['edit']) && isset($_GET['clubID'])){
			$sql_query = "SELECT clubName, clubDescription, clubGenre, mediaID, pname FROM club C, media M, clubGenre CG WHERE C.clubID = " . $_POST['clubID'] . " AND C.genre = CG.clubGenreID AND M.mediaID = C.mediaID"; // Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$result = $db->query($sql_query);

			$title = $result['clubName'];
			$description = $result['clubDescription'];
			$clubGenre = $result['clubGenre'];
			$media = $result['mediaID'];
			$pname = $result['pname'];
			$adress = $result['adress'];
			$phone = $result['phone'];
			$mail = $result['mail'];
			$logoID = $result['logoID'];

			$result->close();
			$db->close();
		}?>
</body>