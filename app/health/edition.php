<!--
File handling the creation and edition of events
-->

<body>
	<?php
		include("../dbconnect.php");

		date_default_timezone_set('UTC');
		$title = "";
		$content = "";

		//If we are editing instead of creating a new
		if(isset($_POST['edit']) && isset($_POST['eventID'])){
			$sql_query = "SELECT * FROM hwnews WHERE HWNewsID = " . $_POST['eventID']; // Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$result = $db->query($sql_query);
			$title = $result['name'];
			$content = $result['text'];

			$result->close();
			$db->close();
		}

		if(isset($_POST['handleEdition'])){
			$sql_query = "INSERT INTO HWNews(HWNewsDate, HWNewsName, HWNewsText) VALUES(" . $_POST['name'] . "," . $_POST['text'] . "," . date(DATE_RFC2822) . ")";
			$db->query($sql_query);
			$db->close();
		}

	?>
	<form action="handleEdition" method="post">
		Title: <br><input type="text" name="name" value="<?php echo $title;?>">
		Content: <br><textarea name="text" rows="5" cols="40"><?php echo $content;?></textarea>
		<input type="submit">
	</form>
</body>