<!--
File handling the creation and edition of points, area and path
-->

<?php
	include("../../dbconnect.php");
  include("../../inc/header.inc");

  echo "<section>
  <div class='edition'>";


  if(!(isset($_SESSION['userType']))) {
    header('location:./');
  } else if($_SESSION['userType'] !== 'NKAPG' &&
  $_SESSION['userType'] !== 'admin') {
      header('location:./');
  }

    

	//If we are editing/Deleting instead of creating a new
  // if id is set, we are updating
	if(isset($_GET['id'])){
    //Updating
    //Fill as the form values with the actual ones
    echo "<h1 class='editTitle'> Update the element </h1> <br>";

    if(isset($_GET['point'])){
      if(isset($_GET['delete'])){
        $sql_query="delete from GeoPoint
        where pointID=" . $_GET['id'];
        if($db->query($sql_query) === TRUE) {
          header('location:./index.php');
        } else {
            echo "Error: " . $sql_query . "<br>" . $db->error;
        }
      } else {
  			$sql = "SELECT pointID, pointType, pointDescription, coordinateX, coordinateY FROM GeoPoint WHERE pointID = " . $_GET['id'];
        $points = $db->query($sql);

        while ($row = $points->fetch_array()) {
          $id = $_GET['id'];
  				$type = $row['pointType'];
  				$description = $row['pointDescription'];
  				$coordinateX = $row['coordinateX'];
  				$coordinateY = $row['coordinateY'];
        }
      }
    } elseif (isset($_GET['path'])) {
      if(isset($_GET['delete'])){
        $sql_query="delete from GeoPath
        where pathID=" . $_GET['id'];
        if($db->query($sql_query) === TRUE) {
          header('location:./index.php');
        } else {
            echo "Error: " . $sql_query . "<br>" . $db->error;
        }
      } else {
        $sql = "SELECT pathID, pathType, pathDescription, vectors FROM Geopath WHERE pathID = " . $_GET['id'];
        $paths = $db->query($sql);

        while ($row = $paths->fetch_array()) {
          $id = $_GET['id'];
          $type = $row['pathType'];
          $description = $row['pathDescription'];
          $vectors = $row['vectors'];
        }
      }
    } elseif (isset($_GET['area'])) {
      if(isset($_GET['delete'])){
        $sql_query="delete from GeoArea
        where areaID=" . $_GET['id'];
        if($db->query($sql_query) === TRUE) {
          header('location:./index.php');
        } else {
            echo "Error: " . $sql_query . "<br>" . $db->error;
        }
      } else {
        $sql = "SELECT areaID, areaType, areaDescription, vectors FROM Geoarea WHERE areaID = " . $_GET['id'];
        $areas = $db->query($sql);

        while ($row = $areas->fetch_array()) {
          $id = $_GET['id'];
          $type = $row['areaType'];
          $description = $row['areaDescription'];
          $vectors = $row['vectors'];
        }
      }
    }
  } else {
    //New element
    //Initialise the fields
    echo "<h1 class='editTitle'> Create a new element </h1> <br>";
    $id = "";
    $type = "";
    $description = "";
    $coordinateX = "";
    $coordinateY = "";
  }

  if(isset($_POST['submitAdd'])) {
    if(isset($_POST['point'])){
      $sql_query = "INSERT INTO GeoPoint (pointType, pointDescription, coordinateX, coordinateY ) VALUES ('"
      . $_POST['type'] . "',' "
      . $_POST['description'] . "',' "
      . $_POST['coordinateX'] . "',' "
      . $_POST['coordinateY'] . "');";

      if ($db->query($sql_query) === TRUE) {
         header("location:index.php");
    	} else {
    	    echo "Error: " . $sql_query . "<br>" . $db->error;
    	}
    } elseif(isset($_POST['path'])){
      $sql_query = "INSERT INTO Geopath (pathType, pathDescription, vectors ) VALUES ('"
      . $_POST['type'] . "',' "
      . $_POST['description'] . "',' "
      . $_POST['vectors'] . "');";

      if ($db->query($sql_query) === TRUE) {
         header("location:index.php");
      } else {
          echo "Error: " . $sql_query . "<br>" . $db->error;
      }
    } elseif(isset($_POST['area'])){
      $sql_query = "INSERT INTO Geoarea (areaType, areaDescription, vectors ) VALUES ('"
      . $_POST['type'] . "',' "
      . $_POST['description'] . "',' "
      . $_POST['vectors'] . "');";

      if ($db->query($sql_query) === TRUE) {
         header("location:index.php");
      } else {
          echo "Error: " . $sql_query . "<br>" . $db->error;
      }
    }
  }
  if(isset($_POST['submitUpdate'])) {
    if(isset($_POST['point'])){
      $sql_query = "UPDATE GeoPoint SET
      pointType='".$_POST['type']."',
      pointDescription='".$_POST['description']."',
      coordinateX=".$_POST['coordinateX'].",
      coordinateY=".$_POST['coordinateY']."
       WHERE pointID=".$_GET['id'];

      if($db->query($sql_query) === TRUE) {
        header("location:index.php");
      } else {
          echo "Error: " . $sql_query . "<br>" . $db->error;
      }
    } elseif(isset($_POST['path'])){
      $sql_query = "UPDATE Geopath SET
      pathType='".$_POST['type']."',
      pathDescription='".$_POST['description']."',
      vectors='".$_POST['vectors']."'
       WHERE pathID=".$_GET['id'];

      if($db->query($sql_query) === TRUE) {
        header("location:index.php");
      } else {
          echo "Error: " . $sql_query . "<br>" . $db->error;
      }
    }elseif(isset($_POST['area'])){
      $sql_query = "UPDATE Geoarea SET
      areaType='".$_POST['type']."',
      areaDescription='".$_POST['description']."',
      vectors='".$_POST['vectors']."'
       WHERE areaID=".$_GET['id'];

      if($db->query($sql_query) === TRUE) {
        header("location:index.php");
      } else {
          echo "Error: " . $sql_query . "<br>" . $db->error;
      }
    }
  }
?>

  <form action="" method="POST">
    <div class='editContent'>
  		Name of the element <br>
      <input type="text" name="type" value=<?php echo "\"" . $type . "\"";?>><br>
  		Description : (accepts html)<br>
      <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea><br>

      <?
      //Addapt the form for the point, area of path
      if(isset($_GET['point'])){
        echo '<input type="hidden" name="point">';
        echo "CoordinateX <br>
            <input type='number' step='0.01' name='coordinateX' value= '" . $coordinateX . "'><br>
            CoordinateY <br>
            <input type='number' step='0.01' name='coordinateY' value='" . $coordinateY . "'><br>";
      } elseif(isset($_GET['path']) or isset($_GET['area'])){
        echo "Coordinates : (pointA_X,pointA_Y,pointB_X,pointB_Y,...) <br>
            <input type='text' name='vectors' value= '" . $vectors . "'><br>";
        if(isset($_GET['path'])){
          echo '<input type="hidden" name="path"';
        } else {
          echo '<input type="hidden" name="area"';
        }
      }
        echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">';

      //changes if we are updating or adding a new value
      if(isset($_GET['id'])) {
        echo "<input class='backButton' type='submit' name='submitUpdate' value='Update element'>";
      } else {
        echo "<input class='backButton' type='submit' name='submitAdd' value='Add element'>";
      }
      ?>
      <a class='backButton' href='./'>Back to the map</a>
    </div>
  </form>
</section>

<?
include('../../inc/footer.inc');
?>  
