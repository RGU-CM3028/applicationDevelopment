<div>
  <div class="slider">
    <figure>
      <img src="https://alexblog.fr/wp-content/uploads/2011/07/paysage-22-550x358.jpg" alt="slider1">
      <img src="http://images.china.cn/attachement/jpg/site1002/20100817/00114320debb0dd4673010.jpg" alt="slider2">
      <img src="http://i-cms.linternaute.com/image_cms/original/2377659-les-100-plus-beaux-paysages-de-france.jpg" alt="slider3">
      <img src="http://www.unesourisetmoi.info/wall32/images/paysage-fonds-ecran_04.jpg" alt="slider4">
      <img src="http://img1.mxstatic.com/wallpapers/195a8b0057a8c0d94a0b1913d0925b9e_large.jpeg" alt="slider5">

    </figure>
  </div>
  <div>
      <div class="findClub">
        <h1> About the clubs and societies </h1>
        <form action="" method="post">
          <h2>Find a club or a society</h2><br>
          <input type="text" name="search" placeholder="Type club or society name"><br>
          <input type="submit" value="Submit"><br>
          <!-- Here maybe we can have an auto research,
          so the submit button will be unusefull. !-->
        </form>
        <div>
          <h2> Club list <h2>
        </div>
      <!-- Only if user = levelCode 1 !-->
      </div>
      <div class="createClub">
        <form action="" method="post">
          <h2>Create a club or society</h2><br>
          <input type="text" name="clubName" placeholder="Club name"><br>
          <input type="submit" value="clubGenre" placeholder="Club genre"><br>
          <!-- Club genre may be a list ?-->
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include("dbconnect.php");
if(isset($_POST['search'])) {
  search($_POST['search']);
}
function search($keyword) {
  $sql = "SELECT clubID FROM Club
  WHERE clubName LIKE '%" . $keyword . "%'
  OR  clubDescription LIKE '%" . $keyword . "%'";
  $result = $db->query($sql);
  echo $result;
 //  while ($row = $result->fetch_array()) {
 //   return true;
 //  }
 //  return false;
}
 ?>
