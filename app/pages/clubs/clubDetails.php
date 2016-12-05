<?
include("../dbconnect.php");
global $db;
  $query = "SELECT clubName, clubDescription FROM Club C
  WHERE C.clubID =" . $_GET['clubID'];
  $result = $db->query($query);

    while ($row = $result->fetch_array()) {
       echo "<div>
           <h1>". $row['clubName'] . " </h1>
           <p> " . $row['clubDescription'] ."</p>
           <h2> Events </h2>
           <h2> Photos </h2>
         </div>";
     }
?>
