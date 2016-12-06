<?php
//Code that connects the database here.
include ("dbconnect.php");

//information from the index form.
$adminchoice = $_POST["choice"];
$adminuserchoice = $_POST["usertype"];
$adminusername = $_POST["username"];

//Security checks Version1
$adminchoice = stripslashes($adminchoice);
$adminchoice = mysqli_real_escape_string($db,$adminchoice);
$adminuserchoice = stripslashes($adminuserchoice);
$adminuserchoice = mysqli_real_escape_string($db,$adminuserchoice);
$adminusername = stripslashes($adminusername);
$adminusername = mysqli_real_escape_string($db,$adminusername);

//needs rest of code
if($adminchoice == "delete"){
  echo "delete oh noes";
} elseif($adminchoice == "usertype") {
  echo "usertype bro";
} elseif($adminchoice == "") {
  echo "Nothing is there";
}

//reference
//choice values = "", "delete", "usertype"
//usertype values - "", "reader", "admin", "unspecified"
//username values = "", $row['username']

//$sql = "DELETE FROM MyGuests WHERE id=3";
//$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
