<?php
// imports the header
include("../../inc/header.inc");
include('../../dbconnect.php');
global $db;
?>
		<div id="healthPage">
			<?
			//admin area use this to allow admin users to see certain stuffsession_start();
			if(isset($_SESSION['userType'])
			 && ($_SESSION['userType'] == "admin")) {
						echo '<div class="create">
							<form action="edition.php" method="post">
								<h2>Do you want to create a news ? Do it now !</h2><br>
								<input id="create" class="submit" type="submit" value="Go create a news !"><br>
							</form>
						<div>
					</div>
				</div>';
		}
			?>
			<div id="healthTips">
				<h1> Health and Wellbeing tips </h1>
				<p> Lorem ipsum......... </p>
					<img id="foodpyramid" src="../../images/foodpyramid.png" alt="food pyramid" />
				<p> Lorem ipsum ....... </p>
			</div>
			<h1 class="pageTitle"> Last news </h1>
			<div id="healthContent">
				
				<?php

					$sql_query = "SELECT * FROM hwnews ORDER BY HWNewsDate DESC";
					$result = $db->query($sql_query);
					if($result->num_rows <= 0) {
						echo "There's no news for the moment";
					} else {
						echo "<div id='newsColumn'>";
						while($row = $result->fetch_array()){
							echo "<div class='news'>
										<div class='newsHeader'>
											<h1> " . $row['HWNewsName'] . " </h1>";
							if(isset($_SESSION['userType'])
               && ($_SESSION['userType'] == "admin")) {
                 echo "<a href='./edition.php?HWNewsID=". $row['HWNewsID']."'>
								 				<img src='../../images/edit.svg' alt='edit'/>
              				</a>";
            	}
							echo "</div><p class='newsDate'> " . $row['HWNewsDate'] . "</p>
									<p class='newsText'> " . $row['HWNewsText'] . "</p>
							</div>";
						}
						echo "</div>";
					}
	    	?>

				<a class="twitter-timeline" href="https://twitter.com/goodhealth" data-width="400"  data-height="800"> Tweets by @goodhealth</a>
				<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</div>

	<?php
	// imports the footer
	include("../../inc/footer.inc");
	?>
