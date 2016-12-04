<?php
include("./dbconnect.php");
?>

<div>
  <!-- <div id="slider">
      <img
      img src="img/1.jpg" data-src-2x="img/1@2x.jpg"
      src="https://alexblog.fr/wp-content/uploads/2011/07/paysage-22-550x358.jpg"
      data-src-2x="https://alexblog.fr/wp-content/uploads/2011/07/paysage-22-550x358@2x.jpg"
      alt="slider1">
      <img data-src="http://images.china.cn/attachement/jpg/site1002/20100817/00114320debb0dd4673010.jpg" src="" alt="slider2">
      <img src="http://i-cms.linternaute.com/image_cms/original/2377659-les-100-plus-beaux-paysages-de-france.jpg" alt="slider3">
      <img src="http://www.unesourisetmoi.info/wall32/images/paysage-fonds-ecran_04.jpg" alt="slider4">
      <img src="http://img1.mxstatic.com/wallpapers/195a8b0057a8c0d94a0b1913d0925b9e_large.jpeg" alt="slider5"> -->
  <!-- </div> -->
  <!-- <script src="./scripts/ideal-image-slider.js"></script>
  <script src="./scripts/ideal-image-slider.min.js"></script>
	<script src="./scripts/iis-bullet-nav.js"></script>
	<script>
  	var slider = new IdealImageSlider.Slider('#slider');
  	slider.addBulletNav();
  	slider.start();
	</script> -->
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
            <?php
            if(isset($_POST['search'])) {
              search($_POST['search']);
            } else { echo "Search a club !"; }
            ?>
        </div>
      <!-- Only if user = levelCode 1 !-->
      </div>
      <div class="createClub">
        <form action="" method="post">
          <h2>Create a club or society</h2><br>
          <input type="text" name="clubName" placeholder="Club name"><br>
          <input type="submit" value="clubGenre" pl, $dbaceholder="Club genre"><br>
          <!-- Club genre may be a list ?-->
        </form>
      </div>
    </div>
  </div>
</div>

<?php

function search($keyword) {
  global $db;
  $query = "SELECT clubID, clubName, clubDescription FROM Club
  WHERE clubName LIKE '%".$keyword."%'
  OR clubDescription LIKE '%".$keyword."%'";
  $result = $db->query($query);
  if($result->num_rows <= 0) {
    echo "We couldn't find any club, search again !";
  } else {
    echo "<table>
            <tr>
              <th> ID</th>
              <th> Club name </th>
              <th> Club description </th>
            </tr>";

    while ($row = $result->fetch_array()) {
     echo "<tr><td>"
          .$row["clubID"]
          ."</td><td>"
          .$row["clubName"]
          ."</td><td>"
          .$row["clubDescription"]
          ."</td></tr>";
    }
    echo "</table>";
  }
}
 ?>
