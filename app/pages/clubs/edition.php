<!--
File handling the creation and edition of clubs
-->

<body>
	<?php
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
		if(isset($_POST['edit']) && isset($_POST['clubID'])){
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
		}

		if(isset($_POST['handleEdition'])){

			//TODO once everything else is done : http://us2.php.net/manual/en/features.file-upload.php
			// and https://www.owasp.org/index.php/Unrestricted_File_Upload

			//Handle image upload
			/*$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["media"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["handleEdition"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}


			//Insert into media and get the generated id
			$sql_query = "INSERT INTO Media(mediaType, mediaDescription, URL) VALUES(picture, Club Logo, " . $target_file . ")";
			$db->query($sql_query);

			$mediaID = $db->insert_id;*/
			$mediaID = 00;


			// $query = "INSERT INTO club (clubName, clubGenreID, clubDescription)
			// 				VALUES ('". $name . "'," . $genre . ",'" . $description . "')";
							
			// if ($db->query($query) === TRUE) {
			//     echo "New record created successfully";
			// } else {
			//     echo "Error: " . $query . "<br>" . $db->error;
			// }

			//TODO get clubGenre and eventID
			$sql_query = "INSERT INTO club (clubName, clubDescription, logoID, pname, adress, phone, email) VALUES('" . $_POST['clubName'] . "," . $_POST['clubDescription'] . "," . $mediaID . "," . $_POST['pname'] . "," .  $_POST['adress'] . "," .  $_POST['phone'] . "," .  $_POST['email'] . "'')";
			if ($db->query($sql_query) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $query . "<br>" . $db->error;
			}

			$db->close();
		}

	?>
	<form action="" method="post">
		Title: <br><input type="text" name="clubName" value="<?php echo $title;?>"><br>
		Description: <br><textarea name="clubDescription" rows="5" cols="40"><?php echo $description;?></textarea><br>

    	<br>Contact info<br>
		Name: <br><input type="text" name="pname" value="<?php echo $pname;?>"><br>
		adress: <br><input type="text" name="adress" value="<?php echo $adress;?>"><br>
		phone: <br><input type="text" name="phone" value="<?php echo $phone;?>"><br>
		email: <br><input type="text" name="email" value="<?php echo $email;?>"><br>
		
		Select image to upload:
    	<input type="file" name="media" id="fileToUpload">

		<input type="submit" name="handleEdition">
	</form>
</body>