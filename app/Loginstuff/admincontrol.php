<?php
//Code that connects the database here.
include ("dbconnect.php");

//First half of checking for html code changes
if(isset($_POST['choice'])) {
    // it exists
} else {
    header("location:admincontrolform.php");
    die();
}
if(isset($_POST['usertype'])) {
    // it exists
} else {
    header("location:admincontrolform.php");
    die();
}
if(isset($_POST['username'])) {
    // it exists
} else {
    header("location:admincontrolform.php");
    die();
}

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

//HTML change safety check
if($adminchoice != "delete" || $adminchoice != "usertype" || $adminchoice != ""){
  echo "Oh no you dont get to change the html on us";
  die();
}
if($adminuserchoice != "reader" || $adminuserchoice != "admin" || $adminuserchoice != "unspecified" || $adminuserchoice != ""){
  echo "Oh no you dont get to change the html on us";
  die();
}


//Code that checks to see if any usernames and password pairs match any in the database.
$sql = "SELECT * FROM users WHERE username ='". $adminusername . "' LIMIT 1;";
$result = $db->query($sql);
$checker = 0;
while($row = $result->fetch_array()) {
    $checker = 1;
} 

}
if($checker != 1, $adminchoice != ""){
  echo "Oh no you dont get to change the html on us";
  die();
}

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
