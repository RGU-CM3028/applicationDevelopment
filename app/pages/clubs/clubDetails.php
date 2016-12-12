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
    echo "<div id='clubs' class='clearfix'>
      <h1 class='clubTitle'>" . $clubName . "<h1>
        <h3 class='clubGenre'>" . $clubGenre . "</h3>
        <p class='clubDesc'>" . $clubDescription . "</p>";
  if($pname != "" || $adress != "" || $phone != "" || $email != "") {
      echo "<div id='club-contact' class='clearfix'><h2 class='contacth'> Contact infos </h2>";
    if($pname != "") {
        echo "<p class='contactp'>You can contact " . $pname ." for further information. </p>";
    } else {
        echo "<p class='contactp'>You can contact us for further information. </p>";
    }
    if($adress != "") {
        echo "<p class='contactp'>Club adress : ".$adress."</p>";
    }
    if($email != "") {
        echo "<p class='contactp'>Email : ".$email."</p>";
    }
    if($phone != "") {
        echo "<p class='contactp'>Phone : ".$phone."</p></div>";
    }
  }

$sql_query = "SELECT * from clubevent c, clubeventassociation a
WHERE a.clubID = ".$_GET['clubID'].";";


$result = $db->query($sql_query);

if(!$result->num_rows <= 0) {
    echo "<div id='events' class='clearfix'>";
  while ($row = $result->fetch_array()) {
      echo "<h2 class='eventh'> Events we are participating in</h2>
        <p class='eventp'> ".$row['eventName'] . "</p>
        <p class='eventp'> ".$row['pdate']." </p>
        <p class='eventp'> " .$row['localisation'] ."
        <p class='eventp'> ".$row['pdescription'] ."</p>
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
