<?

include("../../dbconnect.php");

echo "	<section>
  <div class='edition'>";
$sql_query="SELECT clubID from junctionuserclub
where username='" . $_SESSION['username'] ."'";
$result = $db->query($sql_query);
$clubs = array();
while ($row = $result->fetch_array()) {
  array_push($clubs, $row['clubID']);
}

if(!(isset($_SESSION['userType']))) {
  header('location:./');
} else if($_SESSION['userType'] != "admin"
&& $_SESSION['userType'] != "clubAdmin") {
  header('location:./');
} else if($_SESSION['userType'] == "clubAdmin" && (!(in_array($_GET['clubID'], $clubs)))) {
  header('location:./');
}

$sql_query="delete from clubeventassociation
where clubID=" . $_GET['clubID'];
if($db->query($sql_query) === TRUE) {
  //safe
} else {
    echo "Error: " . $sql_query . "<br>" . $db->error;
}

$sql_query="delete from clubmediaassociation
where clubID=" . $_GET['clubID'];
if($db->query($sql_query) === TRUE) {
  //Safe
} else {
    echo "Error: " . $sql_query . "<br>" . $db->error;
}


$sql_query="delete from junctionuserclub
where clubID=" . $_GET['clubID'];
if($db->query($sql_query) === TRUE) {
  //safe
} else {
    echo "Error: " . $sql_query . "<br>" . $db->error;
}

$sql_query="delete from club
where clubID=" . $_GET['clubID'];
if($db->query($sql_query) === TRUE) {
  header('location:./index.php');
} else {
    echo "Error: " . $sql_query . "<br>" . $db->error;
}
?>
