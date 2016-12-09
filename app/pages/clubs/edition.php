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
		$email = "";
		$logoID = "";

		//If we are editing instead of creating a new
		if(isset($_GET['edit']) && isset($_GET['clubID'])){
			$sql_query = "SELECT clubName, clubDescription, clubGenreID, mediaID, pname, adress, phone, email FROM club WHERE clubID = " . $_GET['clubID']; // Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$queryResult = $db->query($sql_query);
			$result = $queryResult->fetch_assoc()

			$title = $result['clubName'];
			$description = $result['clubDescription'];
			$clubGenreID = $result['clubGenreID'];
			$media = $result['mediaID'];
			$pname = $result['pname'];
			$adress = $result['adress'];
			$phone = $result['phone'];
			$email = $result['email'];
			$logoID = $result['logoID'];
			echo "get clubID : " . $_GET["clubID"] . " ; clubName : " . $title;
			$db->close();
		}

		if(isset($_POST["handleCreation"])){

			//TODO once everything else is done : http://us2.php.net/manual/en/features.file-upload.php
			// and https://www.owasp.org/index.php/Unrestricted_File_Upload

			$uploaddir = '/var/www/uploads/';
			$uploadfile = $uploaddir . basename($_FILES['media']['name']);

			if (move_uploaded_file($_FILES['media']['tmp_name'], $uploadfile)) {
			    echo "Image is valid, and was successfully uploaded.\n";
			} else {
			    echo "Image upload failed\n";
			}


			//Insert into media and get the generated id
			$sql_query = "INSERT INTO Media(mediaType, mediaDescription, URL) VALUES('picture', 'Club Logo', '" . $uploadfile . "')";
			$db->query($sql_query);

			$mediaID = $db->insert_id;
			$mediaID = 0;

			//TODO get clubGenre and eventID
			$sql_query = "INSERT INTO club (clubName, clubDescription, logoID, pname, adress, phone, email) VALUES('" . $_POST['clubName'] . "','" . $_POST['clubDescription'] . "','" . $mediaID . "','" . $_POST['pname'] . "','" .  $_POST['adress'] . "','" .  $_POST['phone'] . "','" .  $_POST['email'] . "')";
			if ($db->query($sql_query) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $query . "<br>" . $db->error;
			}

			$db->close();
		}

		if(isset($_POST["handleEdition"])){

			//TODO once everything else is done : http://us2.php.net/manual/en/features.file-upload.php
			// and https://www.owasp.org/index.php/Unrestricted_File_Upload

			$uploaddir = '/var/www/uploads/';
			$uploadfile = $uploaddir . basename($_FILES['media']['name']);

			if (move_uploaded_file($_FILES['media']['tmp_name'], $uploadfile)) {
			    echo "Image is valid, and was successfully uploaded.\n";
			} else {
			    echo "Image upload failed\n";
			}


			//Insert into media and get the generated id
			$sql_query = "INSERT INTO Media(mediaType, mediaDescription, URL) VALUES('picture', 'Club Logo', '" . $uploadfile . "')";
			$db->query($sql_query);

			$mediaID = $db->insert_id;
			$mediaID = 0;

			//TODO get clubGenre and eventID
			$sql_query = "UPDATE club SET clubName='" . $_POST['clubName'] . "', 
			clubDescription = '" . $_POST['clubDescription'] . "', 
			mediaID = '" . $mediaID . "',
			pname = '" . $_POST['pname'] . "',
			adress = '" .  $_POST['adress'] . "',
			phone = '" .  $_POST['phone'] . "',
			email = '" .  $_POST['email'] . "')";
			if ($db->query($sql_query) === TRUE) {
			    echo "Club edited successfully";
			} else {
			    echo "Error: " . $query . "<br>" . $db->error;
			}

			$db->close();
		}

	?>
	<form action="" method="post">
		Title: <br><input type="text" name="clubName" value=<?php echo "\"" . $title . "\"";?>><br>
		Description: <br><textarea name="clubDescription" rows="5" cols="40"><?php echo $description;?></textarea><br>

    	<br>Contact info<br>
		Name: <br><input type="text" name="pname" value=<?php echo "\"" . $pname . "\"";?>><br>
		adress: <br><input type="text" name="adress" value=<?php echo "\"" . $adress . "\"";?>><br>
		phone: <br><input type="text" name="phone" value=<?php echo "\"" . $phone . "\"";?>><br>
		email: <br><input type="text" name="email" value=<?php echo "\"" . $email . "\"";?>><br>

		Select image to upload:
    	<input type="file" name="media">

    	<?php if(isset($_GET["edit"])) {echo "<input type=\"submit\" name=\"handleEdition\">";} else {echo "<input type=\"submit\" name=\"handleCreation\">";}
    	?>
		
	</form>
</body>