<!--
File handling the creation and edition of points, area and path
-->

	<?php
		include("../../dbconnect.php");
    include("../../inc/header.inc");

    if(!(isset($_SESSION['userType']))) {
      header('location:./');
    } else if($_SESSION['userType'] == 'NKAPG' ||
    $_SESSION['userType'] == 'admin') {
        header('location:./');
    }

		//If we are editing instead of creating a new
    // if id is set, we are updating
		if(isset($_GET['id'])){
      //Updating
      //Fill as the form values with the actual ones
      echo "<h1> Update the element </h1>";
			$sql = "SELECT pointID, pointType, pointDescription, coordinateX, coordinateY FROM GeoPoint";
      $points = $db->query($sql);

        while ($row = $queryResult->fetch_array()) {
          $id = $row['pointID'];
  				$type = $row['pointType'];
  				$description = $row['pointDescription'];
  				$coordinateX = $row['coordinateX'];
  				$coordinateY = $row['coordinateY'];
        }
    } else {
      //New element
      //Initialise the fields
      echo "<h1> Create a new element </h1>";
      $id = "";
      $type = "";
      $description = "";
      $coordinateX = "";
      $coordinateY = "";
    }

    if(isset($_POST['submitAdd'])) {
      $sql_query = "INSERT INTO GeoPoint (pointType, pointDescription, coordinateX, coordinateY ) VALUES ('"
      . $_POST['id'] . "',' "
      . $_POST['type'] . "',' "
      . $_POST['description'] . "',' "
      . $_POST['coordinateX'] . "',' "
      . $_POST['coordinateY'] . "');";

      if ($db->query($sql_query) === TRUE) {
         header("location:index.php");
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}
    }
    if(isset($_POST['submitUpdate'])) {

        $sql_query = "UPDATE GeoPoint SET
        pointType='".$_POST['type']."',
        pointDescription='".$_POST['description']."',
        coordinateX='".$_POST['coordinateX']."',
        coordinateY='".$_POST['coordinateY']."'
         WHERE pointID='".$_GET['id']."'";

        if($db->query($sql_query) === TRUE) {
          header("location:index.php");
        } else {
            echo "Error: " . $sql_query . "<br>" . $db->error;
        }
      }
	?>

	<form action="" method="POST">
		Name of the element <br>
    <input type="text" name="type" value=<?php echo "\"" . $type . "\"";?>><br>
		Description : <br>
    <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea><br>

    <?
    //Addapt the form for the point, area of path
    if(isset($_GET['point'])){
      echo "CoordinateX <br>
          <input type='number' name='coordinateX' value= '" . $coordinateX . "'?>><br>
          CoordinateY <br>
          <input type='number' name='coordinateY' value='" . $coordinateY . "'?>><br>";
    } elseif(isset($_GET['path']) or isset($_GET['area'])){
      echo "Coordinates : (pointA_X,pointA_Y,pointB_X,pointB_Y,...) <br>
          <input type='number' name='vectors' value= '" . $coordinateX . "'?>><br>";
    }

    //changes if we are updating or adding a new value
    if(isset($_GET['id'])) {
      echo "<input type='submit' name='submitUpdate' value='Update club'>";
    } else {
      echo "<input type='submit' name='submitAdd' value='Add club'>";
    }
    ?>
    <a href='./'>Back to the map</a>
	</form>
</body>

<?
include('../../inc/footer.inc');
?>  
