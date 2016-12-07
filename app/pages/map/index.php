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
      //Query the map datas
      $sql = "SELECT pointType, pointDescription, coordinateX, coordinateY FROM GeoPoint";
      $points = $db->query($sql);

      $sql = "SELECT pathType, pathDescription, vectors FROM GeoPath";
      $path = $db->query($sql);

      $sql = "SELECT areaType, areaDescription, vectors FROM GeoArea";
      $area = $db->query($sql);

      $db->close();

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

  <div id="map" style="height: 95vh;"></div>
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
      .bindPopup(myPoint.type + "<br>"+ myPoint.description));
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
      .bindPopup(myArea.type + "<br>" + myArea.description)
      .openPopup());
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

    polygons.push(L.polyline(coordinatesTuples).addTo(map)
      .bindPopup(myPath.type + "<br>" + myPath.description)
      .openPopup());
  }


</script>
</html>
