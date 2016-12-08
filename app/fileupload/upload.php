<?php
//if($_POST["submit"] == "1") {
      //$to = "uploads/".$_FILES['filetoupload']['name'];
      //move_uploaded_file($_FILES['filetoupload']['tmp_name'], $to);
      //echo "Uploaded";
//}
if(isset($_POST['upload'])){      
      echo $image_name = $_FILES["file"]["name"];
      echo $image_type = $_FILES["file"]["type"];
      echo $image_size = $_FILES["file"]["size"];
      echo $image_tmp_name = $_FILES["file"]["tmp_name"];
}


                         
?>
