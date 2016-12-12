<?

include("../../dbconnect.php");


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
