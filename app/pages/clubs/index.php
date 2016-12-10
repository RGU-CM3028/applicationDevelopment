<?php
    // imports the header/navigation
    include("../../inc/header.inc");
    include('../../dbconnect.php');
?>
    <section>

		<!--Body Text-->
		<div id="BodyText">
				<div>
          <?
            //admin and clubAdmin area use this to allow
            //admin users and clubAdmin users to see certain
            //stuffsession_start();
            if(isset($_SESSION['userType'])
             && (($_SESSION['userType'] == "clubAdmin")
             || ($_SESSION['userType'] == "admin"))) {
                  echo '<div class="create">
    				        <form action="edition.php" method="post">
    				          <h2>Do you want to create a club ? Do it now !</h2><br>
    				          <input id="create" class="submit" type="submit" value="Create a new club !"><br>
    				        </form>
                      <div>';
  							if(isset($_POST['clubName']) && isset($_POST['clubGenreID']) && isset($_POST['clubDescription'])) {
  								createClub($_POST['clubName'], $_POST['clubGenreID'], $_POST['clubDescription']);
  							}
                echo "
              </div>
  		      </div>";
          }
            ?>
				  <div>
            <h2 class="pageTitle"> Clubs and Societies </h2>
          </div>
				      <div class="findClub">
                <div class="manageClubs">
                  <form action="" method="post">
                    <input id="reset" name="reset" class="submit" type="submit" value="Show all clubs">
                  </form>
                  <form class="searchForm" action="" method="post">
  				          <img id="searchButton" src="../../images/search.svg" alt="Search">
  				          <input type="text" name="search" placeholder="Type club or society name"><br>
  				          <input class="submit" type="submit" value="Submit"><br>
  				        </form>
                </div>
				        <div>
                </div>
				            <?php
				            if(isset($_POST['search'])) {
				              search($_POST['search']);
				            } else { showAllClubs(); }
				            ?>
				      </div>
				    </div>
				  </div>
				</div>
		</div>

    </section>

<?php
    // imports the footer
    phpinfo();
    include("../../inc/footer.inc");
?>


				<?php
				function showAllClubs() {
				  global $db;
          unset($_POST['search']);
          $query = "SELECT clubID, clubName, clubDescription FROM Club";
				  $result = $db->query($query);
				  if($result->num_rows <= 0) {
				    echo "There's no clubs for the moment";
				  } else {
				    echo "<table class='clubsTable'>
				            <tr class='tableTitle'>
				              <th> Club name </th>
                      <th> Club description </th>
                      ";
            if(isset($_SESSION['userType'])
             && (($_SESSION['userType'] == "clubAdmin")
             || ($_SESSION['userType'] == "admin"))) {
              echo "<th> Edit </th>";
            }
            echo "</tr>";

				    while ($row = $result->fetch_array()) {
				     echo "<tr class='tableRow'>
                  <td><a href='clubDetails.php?clubID=" . $row['clubID'] . "'>"
				          .$row["clubName"]
				          ."</a></td>
                  <td><a href='clubDetails.php?clubID=" . $row['clubID'] . "'>"
				          .$row["clubDescription"]
				          ."</a></td>";
                  if(isset($_SESSION['userType'])
                   && (($_SESSION['userType'] == "clubAdmin")
                   || ($_SESSION['userType'] == "admin"))) {
                     echo "
                  <td>
                  <form>
                  <a href='./edition.php?clubID=". $row['clubID']."'><img src='../../images/edit.svg' alt='edit'/>
                  </a></td>
                  </tr>";
                }
				    }
				    echo "</table>";
				  }
				}

				function search($keyword) {
				  global $db;
				  $query = "SELECT clubID, clubName, clubDescription FROM Club
				  WHERE clubName LIKE '%".$keyword."%'
				  OR clubDescription LIKE '%".$keyword."%'";
				  $result = $db->query($query);
				  if($result->num_rows <= 0) {
				    echo "We couldn't find any club, search again !";
				  } else {
            echo "<table class='clubsTable'>
				            <tr class='tableTitle'>
				              <th> Club name </th>
                      <th> Club description </th>
                      ";
            if(isset($_SESSION['userType'])
             && (($_SESSION['userType'] == "clubAdmin")
             || ($_SESSION['userType'] == "admin"))) {
              echo "<th> Edit </th>";
            }
            echo "</tr>";

				    while ($row = $result->fetch_array()) {
				     echo "<tr class='tableRow'>
                  <td><a href='clubDetails.php?clubID=" . $row['clubID'] . "'>"
				          .$row["clubName"]
				          ."</a></td>
                  <td><a href='clubDetails.php?clubID=" . $row['clubID'] . "'>"
				          .$row["clubDescription"]
				          ."</a></td>";
                  if(isset($_SESSION['userType'])
                   && (($_SESSION['userType'] == "clubAdmin")
                   || ($_SESSION['userType'] == "admin"))) {
                     echo "
                  <td>
                  <form>
                  <a href='./edition.php?clubID=". $row['clubID']."'><img src='../../images/edit.svg' alt='edit'/>
                  </a></td>
                  </tr>";
                }
				    }
				    echo "</table>";
				  }
				}
				 ?>
