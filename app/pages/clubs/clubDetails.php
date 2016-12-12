<!--Variables-->
<!--clubName : Name of the club (direct use)-->
<!--clubDescription : Description of the club (direct use)-->
<!--clubGenreID : ID of the club's genre (used to pull genre details)-->
<!--mediaID : ID of the club's image (used to pull media details)-->
<!--clubGenre : Genre of the club (direct use)-->


<?php
include("../../dbconnect.php");
include("../../inc/header.inc");
global $db;

$clubID = $_GET['clubID'];

$clubName = "club not found";
$clubDescription = "club not found";

$query = "SELECT clubName, clubDescription, clubGenreID, pname, adress, phone, email
          FROM Club
          WHERE clubID = " . $clubID;
$result = $db->query($query);

while ($row = $result->fetch_array()) {
    $clubName = $row['clubName'];
    $clubDescription = $row['clubDescription'];
    $clubGenreID = $row['clubGenreID'];
    $pname = $row['pname'];
    $adress = $row['adress'];
    $phone = $row['phone'];
    $email = $row['email'];
}

$query = "SELECT pname
          FROM ClubGenre C
          WHERE C.clubGenreID = " . $clubGenreID;
$result = $db->query($query);

while ($row = $result->fetch_array()) {
    $clubGenre = $row['pname'];
}

$query = "SELECT m.mediaDescription, m.mediaID, m.URL
          FROM ClubMediaAssociation c, media m
          WHERE c.mediaID = m.mediaID
          AND c.clubID = " . $_GET['clubID'];
$result = $db->query($query);

if(!$result->num_rows <= 0) {
  $medias = array();
  while ($row = $result->fetch_array()) {
      array_push($medias, array($row['mediaDescription'], $row['URL']));
    }
}

echo "<section>";
  if(isset($medias)) {
    echo "<div id='slider'>";
  foreach($medias as $media) {
    echo "<img class='mySlides' alt='" . $media[0] . "' src='". $media[1] ."'>";
  }
  echo '<script>
    var slideIndex = 0;
      carousel();

      function carousel() {
      var i;
      var x = document.getElementsByClassName("mySlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > x.length) {slideIndex = 1}
      x[slideIndex-1].style.display = "block";
      setTimeout(carousel, 2000); // Change image every 2 seconds
      }
      </script>
      </div>';
  }
    echo "<div>
      <h1>" . $clubName . "<h1>
        <p>" . $clubGenre . "</p>
        <p>" . $clubDescription . "</p>";
  if($pname != "" || $adress != "" || $phone != "" || $email != "") {
    echo "<h2> Contact infos </h2>";
    if($pname != "") {
      echo "<p>You can contact " . $pname ." for further information. </p>";
    } else {
      echo "<p>You can contact us for further information. </p>";
    }
    if($adress != "") {
      echo "<p>Club adress : ".$adress."</p>";
    }
    if($email != "") {
      echo "<p>Email : ".$email."</p>";
    }
    if($phone != "") {
      echo "<p>Phone : ".$phone."</p>";
    }
  }

$sql_query = "SELECT * from clubevent c, clubeventassociation a
WHERE a.clubID = ".$_GET['clubID'].";";


$result = $db->query($sql_query);

if(!$result->num_rows <= 0) {
  echo "<h2> Events we are participating in</h2>";
  while ($row = $result->fetch_array()) {
      echo "<div>
        <p> ".$row['eventName'] . "</p>
        <p> ".$row['pdate']." </p>
        <p> " .$row['localisation'] ."
        <p> ".$row['pdescription'] ."</p>
        </div>";
    }
}

?>

    <a href='../clubs/'>Back to clubs</a>
  </div>
</section>

<?
include('../../inc/footer.inc');
?>
