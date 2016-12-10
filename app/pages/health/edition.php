<!--
File handling the creation and edition of news
-->

	<?php

    var_dump($_POST)
		include("../../dbconnect.php");

		//If we are editing instead of creating a new
    // if HWNewsID setted, we update
		if(isset($_GET['HWNewsID'])){
      echo "<h1> Update your news </h1>";
			$sql_query = "SELECT HWNewsName, HWNewsText FROM hwnews WHERE HWNewsID = " . $_GET['HWNewsID'];
			// Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$queryResult = $db->query($sql_query);
      while ($row = $queryResult->fetch_array()) {
        $title = $row['HWNewsName'];
				$description = $row['HWNewsText'];
      }
    } else {
      echo "<h1> Create a news </h1>";
      //Initialise the fields
      $title = "";
      $description = "";
    }

    if(isset($_POST['submitAdd'])) {
      $sql_query = 'INSERT INTO HWNews (HWNewsDate, HWNewsName, HWNewsText)
				 VALUES (
					 CURDATE(), "'
      . mysql_real_escape_string($_POST['HWNewsName']) . '","'
      . mysql_real_escape_string($_POST['HWNewsText']) . '");';

      if ($db->query($sql_query) === TRUE) {
      	    header("location:index.php");
      	} else {
      	    echo "Error: " . $sql_query . "<br>" . $db->error;
      	}
    }
    if(isset($_POST['submitUpdate'])) {

        $sql_query = 'UPDATE HWNews
        SET HWNewsName="'.mysql_real_escape_string($_POST['HWNewsName']).'",
        HWNewsText="'.mysql_real_escape_string($_POST['HWNewsText']).'"
				WHERE HWNewsID='.$_GET['HWNewsID'];

        if ($db->query($sql_query) == TRUE) {
              header("location:index.php");
          } else {
              echo "Error: " . $sql_query . "<br>" . $db->error;
          }
      }
	?>
	<form action="" method="POST">
		Title : <br>
    <input type="text" name="HWNewsName" value=<?php echo "\"" . $title . "\"";?>><br>
		Description : <br>
    <textarea name="HWNewsText" rows="5" cols="40"><?php echo $description;?></textarea><br>

    <? if(isset($_GET['HWNewsID'])) {
      echo "<input type='submit' name='submitUpdate' value='Update news'>";
    } else {
      echo "<input type='submit' name='submitAdd' value='Add news'>";
    }
    ?>
	</form>
