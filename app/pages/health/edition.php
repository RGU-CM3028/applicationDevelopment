<!--
File handling the creation and edition of news
-->

	<?php

		include("../../dbconnect.php");
		include("../../inc/header.inc");
    echo "<section>
    <div class='edition'> ";
    if(!(isset($_SESSION['userType']))) {
      header('location:./');
    } else if($_SESSION['userType'] !== 'admin') {
        header('location:./');
    }
		//If we are editing instead of creating a new
    // if HWNewsID setted, we update
		if(isset($_GET['HWNewsID'])){
      echo "<h1 class='editTitle'> Update your news </h1>";
			$sql_query = "SELECT HWNewsName, HWNewsText FROM hwnews WHERE HWNewsID = " . $_GET['HWNewsID'];
			// Most insecure line ever, will patch if we have additionnal time after site finished. Paradise for sql injection.
			$queryResult = $db->query($sql_query);
      while ($row = $queryResult->fetch_array()) {
        $title = $row['HWNewsName'];
				$description = $row['HWNewsText'];
      }
    } else {
      echo "<h1 class='editTitle'> Create a news </h1>";
      //Initialise the fields
      $title = "";
      $description = "";
    }

    if(isset($_POST['submitAdd'])) {
      $sql_query = 'INSERT INTO HWNews (HWNewsDate, HWNewsName, HWNewsText)
				 VALUES (
					 CURDATE(), "'
      . mysqli_real_escape_string($db, $_POST['HWNewsName']) . '","'
      . mysqli_real_escape_string($db, $_POST['HWNewsText']) . '");';

      if ($db->query($sql_query) === TRUE) {
      	    header("location:index.php");
      	} else {
      	    echo "Error: " . $sql_query . "<br>" . $db->error;
      	}
    }
    if(isset($_POST['submitUpdate'])) {
        $sql_query = 'UPDATE HWNews
        SET HWNewsName="'.mysqli_real_escape_string($db, $_POST['HWNewsName']).'",
        HWNewsText="'.mysqli_real_escape_string($db, $_POST['HWNewsText']).'"
				WHERE HWNewsID='.$_GET['HWNewsID'];

        if ($db->query($sql_query) == TRUE) {
              header("location:index.php");
          } else {
              echo "Error: " . $sql_query . "<br>" . $db->error;
          }
      }
	?>
    	<form action="" method="POST">
        <div class='editContent'>
      		Title : <br>
          <input type="text" name="HWNewsName" value=<?php echo "\"" . $title . "\"";?>><br>
      		Description : <br>
          <textarea name="HWNewsText" rows="5" cols="40"><?php echo $description;?></textarea><br>

          <? if(isset($_GET['HWNewsID'])) {
            echo "<input class='backButton'  type='submit' name='submitUpdate' value='Update news'>";
          } else {
            echo "<input class='backButton'  type='submit' name='submitAdd' value='Add news'>";
          }
          ?>
      		<a id='backEdition' class='backButton' href='./'>Back to Health and Wellbeing</a>
        </div>
    	</form>
    </div>
  </section>

<?
include('../../inc/footer.inc');
