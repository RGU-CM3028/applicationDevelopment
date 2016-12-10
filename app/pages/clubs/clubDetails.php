<!--Variables-->
<!--clubName : Name of the club (direct use)-->
<!--clubDescription : Description of the club (direct use)-->
<!--clubGenreID : ID of the club's genre (used to pull genre details)-->
<!--mediaID : ID of the club's image (used to pull media details)-->
<!--clubGenre : Genre of the club (direct use)-->


<?php
include("../../dbconnect.php");
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
    $clubGenreID = $row{'clubGenreID'};
    $pname = $row{'pname'};
    $adress = $row{'adress'};
    $phone = $row{'phone'};
    $email = $row{'email'};
}

$query = "SELECT pname
          FROM ClubGenre C
          WHERE C.clubGenreID = " . $clubGenreID;
$result = $db->query($query);

while ($row = $result->fetch_array()) {
    $clubGenre = $row['pname'];
}

$query = "SELECT mediaID
          FROM ClubMediaAssociation C
          WHERE C.clubID = " . $clubID;
$result = $db->query($query);

if(!$result->num_rows <= 0) {
  $i = 0;
  while ($row = $result->fetch_array()) {
      $images [i] = $row['mediaID'];
      $i++;
    }
}


echo "<section>
    <div>";
  if(isset($mediaID)) {
    echo "<img src=" . $mediaID . ">";
  }
  echo "<h1>" . $clubName . "<h1>
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
  echo "<h2> Events </h2>
    </div>
</section>";
