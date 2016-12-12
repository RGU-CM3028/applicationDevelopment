<?

include('../../dbconnect.php');
global $db;

if(!(isset($_SESSION['userType']))) {
  header('location:./');
} else if($_SESSION['userType'] !== 'admin') {
    header('location:./');
}

$sql_query="delete from HWNews
where HWNewsID=" . $_GET['HWNewsID'];
if($db->query($sql_query) === TRUE) {
  header('location:./index.php');
} else {
    echo "Error: " . $sql_query . "<br>" . $db->error;
}

?>
