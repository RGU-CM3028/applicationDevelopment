<?php
//if($_POST["submit"] == "1") {
      //$to = "uploads/".$_FILES['filetoupload']['name'];
      //move_uploaded_file($_FILES['filetoupload']['tmp_name'], $to);
      //echo "Uploaded";
//}
if(isset($_POST['upload'])){      
      $image_name = $_FILES["file"]["name"];
      $image_type = $_FILES["file"]["type"];
      $image_size = $_FILES["file"]["size"];
      $image_tmp_name = $_FILES["file"]["tmp_name"];
      
      if($image_name==''){
            echo "<script>alert('Please Select an Image')</script>";
            exit();
      } else 
            echo "uploads/$image_name";
            //move_uploaded_file($image_tmp_name, "uploads/$image_name");
      echo"image Uploaded";
      echo"<img src='upload/$image_name'>";
}


                         
?>
