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

$query = "SELECT clubName, clubDescription, clubGenreID
          FROM Club C
          WHERE C.clubID = " . $clubID;
$result = $db->query($query);

while ($row = $result->fetch_array()) {
    $clubName = $row['clubName'];
    $clubDescription = $row['clubDescription'];
    $clubGenreID = $row{'clubGenreID'};
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

$i = 0;
while ($row = $result->fetch_array()) {
    $images [i] = $row['mediaID'];
    $i++;
}


echo "<section>
    <div>
        <img src=
                 " . $mediaID . "
                                    >
    <h1>
            " . $clubName . "

                                      " . $clubGenre . "
                                                        </h1>
        <p>
           " . $clubDescription . "
                                   </p>
        <h2> Events </h2>
    </div>
</section>";
