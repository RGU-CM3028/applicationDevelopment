<?php
//Code for connecting to a database.
define('DB_SERVER', 'eu-cdbr-azure-north-e.cloudapp.net');
define('DB_USERNAME', 'b01be6ac34b5a8');
define('DB_PASSWORD', '29762594');
define('DB_DATABASE', 'bruwebproject');

//This puts the database into a variable called $db.
$db = new mysqli(DB_SERVER,
    DB_USERNAME, DB_PASSWORD,
    DB_DATABASE);
    if (!$db->ping()) {
        echo 'Lost connection, exiting after query #1';
    }

//This checks to see if the database connection is successful or not.
if($db->connect_errno){
    echo("connection failed");
    die('Connectfailed['.$db->connect_error.']');
    }
?>
