<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new mysqli (
    'us-cdbr-azure-southcentral-f.cloudapp.net',
    'bf9afe7c1df5c8',
    '5d557954',
    'acsm_0dd8805538e55e7');

// test our connection
if ($db->connect_errno) {
    die ('Connection Failed :'.$db->connect_error );
}

//Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

//Select all the rows n the markers table
$query = "SELECT * FROM markers WHERE 1";
$result = $db->query($query);
if (!$result) {
    die('Nothing in result: ');
}

header("Content-type: text/xml");

//Iterate through the rows, adding XML node for each

while ($row = $result->fetch_array()) {
    //ADD TO XML DOCUMENT NODE
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name",$row['name']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
    $newnode->setAttribute("type", $row['type']);
}

$result->close();
$db->close();

echo $dom->saveXML();

?>