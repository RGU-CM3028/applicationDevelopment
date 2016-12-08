<?php
//if($_POST["submit"] == "1") {
      //$to = "uploads/".$_FILES['filetoupload']['name'];
      //move_uploaded_file($_FILES['filetoupload']['tmp_name'], $to);
      //echo "Uploaded";
//}
      
$file_result = "";
if ($_FILES["fileToUpload"]["error"] > 0) {
      $file_result.= "No file uploaded. so on";
      $file_result.= "Error code:" . $_FILES["fileToUpload"]["error"]."<br>";
}else{
      $file_result .=
            "Upload: ". $_FILES["fileToUpload"]["name"]."<br>".
            "Type: ". $_FILES["fileToUpload"]["type"]."<br>".
            "Size: ". $_FILES["fileToUpload"]["size"]/1024." Kb<br>".
            "Temp file: ". $_FILES["fileToUpload"]["tmp_name"]."<br>";
      move_uploaded_file($_FILES['filetoupload']['tmp_name'],
                         "uploads/".$_FILES['filetoupload']['name']);
      $file_result .= "File Upload Successful!"
}
                         
?>
