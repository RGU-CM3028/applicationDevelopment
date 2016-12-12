<?php
// imports the header
include("../../inc/header.inc");
include('../../dbconnect.php');
?>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
	<section>
  <div id="map-data" style="display: none;">
    <?php
      //Query the map datask
      $sql = "SELECT pointID, pointType, pointDescription, coordinateX, coordinateY FROM GeoPoint";
      $points = $db->query($sql);

      $sql = "SELECT pathID, pathType, pathDescription, vectors FROM GeoPath";
      $path = $db->query($sql);

      $sql = "SELECT areaID, areaType, areaDescription, vectors FROM GeoArea";
      $area = $db->query($sql);

      $output = "";

      //Write the data into html in json format, so the javascript can read it (Better for security than writing inside javascript)
      //+Parse each point
      $output .= "{\"points\": [ ";
      while($row = $points->fetch_assoc()) {
          $output .= "{\"type\": \"". $row["pointType"] . "\"". ",
             \"description\": \"". $row["pointDescription"] . "\"". ",
             \"coordinateX\": \"". $row["coordinateX"] . "\"". ",
             \"coordinateY\": \"" . $row["coordinateY"] . "\"},";
      }
      //+-Remove the last comma
      $output = substr($output, 0, -1);

      //+Parse each Path
      $output .= "], \"paths\" : [ ";
      while($row = $path->fetch_assoc()) {
          $output .= "{\"type\": \"" . $row["pathType"] . "\"". ",
           \"description\": \"" . $row["pathDescription"] . "\"". ",
           \"coordinates\": \"" . $row["vectors"] . "\"},";
      }
      //+-Remove the last comma
      $output = substr($output, 0, -1);

      //+Parse each Area
      $output .= "], \"areas\" : [ ";
      while($row = $area->fetch_assoc()) {
          $output .= "{\"type\": \"" . $row["areaType"] . "\"". ",
           \"description\": \"" . $row["areaDescription"] . "\"". ",
           \"coordinates\": \"" . $row["vectors"] . "\"}  ,";
      }
      //+-Remove the last comma
      $output = substr($output, 0, -1);
      $output .= "]";
      $output .= "}";

      echo $output;
    ?>
  </div>

  <?
    //admin area use this to allow admin and map admin users to see certain stuff
    if(isset($_SESSION['userType'])
     && (($_SESSION['userType'] == "NKPAG")
     || ($_SESSION['userType'] == "admin"))) {
        //---- Point
        //Query all the points from the DB
        $sql = "SELECT pointID, pointType, pointDescription, coordinateX, coordinateY FROM GeoPoint";
        $points = $db->query($sql);

        //Create the edition box for the points
        echo '<form action="edition.php" method="GET">';
        echo '<input type="submit" name="point" value="Add a point to the map" />';
        echo '</form>';

        echo '<form action="edition.php" method="GET">
              Select a point <select name="id" required>';
          while($row = $points->fetch_assoc()) {
            var_dump($row);
            echo "<option value=\"". $row["pointID"] . "\">\"". $row["pointType"] . "\"</option>";
          }
        echo "</select>";
        echo '<input type="hidden" name="point">';
        echo '<input type="submit" name="edit" value="Edit" />';
        echo '<input type="submit" name="delete" value="Delete" /> </form>';

        //---- Path
        //Query all the paths from the DB
        $sql = "SELECT pathID, pathType, pathDescription, vectors FROM Geopath";
        $paths = $db->query($sql);

        //Create the edition box for the paths
        echo '<form action="edition.php" method="GET">';
        echo '<input type="submit" name="path" value="Add a path to the map" />';
        echo '</form>';

        echo '<form action="edition.php" method="GET">
              Select a path<select name="id" required>';
          while($row = $paths->fetch_assoc()) {
            echo "<option value=\"". $row["pathID"] . "\">\"". $row["pathType"] . "\"</option>";
          }
        echo "</select>";
        echo '<input type="hidden" name="path">';
        echo '<input type="submit" name="edit" value="Edit" />';
        echo '<input type="submit" name="delete" value="Delete" /> </form>';


        //---- Area
        //Query all the areas from the DB
        $sql = "SELECT areaID, areaType, areaDescription, vectors FROM Geoarea";
        $areas = $db->query($sql);

        //Create the edition box for the areas
        echo '<form action="edition.php?area" method="GET">';
        echo '<input type="submit" name="area" value="Add an Area to the map" />';
        echo '</form>';

        echo '<form action="edition.php?area" method="GET">
              Select an area <select name="id" required>';
          while($row = $areas->fetch_assoc()) {
            echo "<option value=\"". $row["areaID"] . "\">\"". $row["areaType"] . "\"</option>";
          }
        echo "</select>";
        echo '<input type="hidden" name="area">';
        echo '<input type="submit" name="edit" value="Edit" />';
        echo '<input type="submit" name="delete" value="Delete" /> </form>';

      }
    ?>

  <div id="map" style="height: 65vh;"></div>
</section>
  <?php
  // imports the footer
  include("../../inc/footer.inc");
  ?>


<script>
  //+Create a Leaflet map
  let map = L.map('map').setView([57.06, -2.169664], 12);

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  //Get the map datas from the php
  let div = document.getElementById("map-data");
  let myData = JSON.parse(div.textContent);
  let markers = [];
  let polygons = [];


  console.log(myData);

  //Create markers for the points
  for(point in myData.points){
    myPoint = myData.points[point];
    //console.log(myPoint.description);
    markers.push(L.marker([myPoint.coordinateX, myPoint.coordinateY]).addTo(map)
      .bindPopup(myPoint.type + "<br>" + myPoint.description));
  }


  //Areas
  for(area in myData.areas){
    myArea = myData.areas[area];

    //Parse vectors to generate coordinates tuples
    let coordinates = myArea.coordinates.split(",");
    let coordinatesTuples = [];
    for(let i=0;i<coordinates.length;i+=2){
      coordinatesTuples.push([coordinates[i], coordinates[i+1]])
    }

    polygons.push(L.polygon(coordinatesTuples).addTo(map)
      .bindPopup(myArea.type + "<br>" + myArea.description));
  }

  //Paths, same method as areas
  for(path in myData.paths){
    myPath = myData.paths[path];

    //Parse vectors to generate coordinates tuples
    let coordinates = myPath.coordinates.split(",");
    let coordinatesTuples = [];
    for(let i=0;i<coordinates.length;i+=2){
      coordinatesTuples.push([coordinates[i], coordinates[i+1]])
    }

		// let customOptions =
    // {
    // 'maxWidth': '20%',
    // 'width': '20%',
    // 'className' : 'popupCustom'
    // }

    polygons.push(L.polyline(coordinatesTuples).addTo(map)
      .bindPopup(myPath.type + "<br>" + myPath.description));
  }


</script>
</html>
