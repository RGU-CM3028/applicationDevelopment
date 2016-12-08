<?php
// imports the header
include("../../inc/header.inc");
include('../../dbconnect.php');
global $db;
?>
	<!--Body Text-->
<!--<h3>Thi is infomation on how to be healthy</h3>
			//<p>Healthy food:</p>
			<ol>
				<li>Apple</li>
  				<li>Banana</li>
  				<li>Orangle</li>
			</ol>
			
			<p>Healthy body:</p>
				<ol>
  				<li>Running</li>
  				<li>Try some of our routes to get excerise</li>
  				<li>Go to the gym</li>
			</ol>-->

		<div id="healthPage">
			<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=1673121366290064";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
			<h1 class="pageTitle"> Last news </h1>
			<div id="healthContent">
				<div>
					<div class="fb-page"
						data-href="https://www.facebook.com/Sportlethen/?fref=ts"
						data-tabs="timeline"
						data-weight="500"
						data-height="800"
						data-small-header="true"
						data-adapt-container-width="false"
						data-hide-cover="false"
						data-show-facepile="true">
						<blockquote
							cite="https://www.facebook.com/Sportlethen/?fref=ts"
							class="fb-xfbml-parse-ignore">
							<a href="https://www.facebook.com/Sportlethen/?fref=ts">Sportlethen CSH</a>
						</blockquote>
					</div>
				</div>
				<?php
				
						//admin area use this to allow admin users to see certain stuffsession_start();
				$usertypeholder1 = 'admin';
				if ($usertypeholde1 = $_SESSION['userType']){
					echo "Welcome admin to the news screen.";
   				} else {
	   				//safe
   				}
		
		
				
					$sql_query = "SELECT * FROM hwnews ORDER BY HWNewsDate DESC";
					$result = $db->query($sql_query);
					if($result->num_rows <= 0) {
						echo "There's no news for the moment";
					} else {
						while($row = $result->fetch_array()){
							echo "<div id='news'>
										<h1> " . $row['HWNewsName'] . " </h1>
										<p id='newsDate'> " . $row['HWNewsDate'] . "</p>
									<p id='newsText'> " . $row['HWNewsText'] . "</p>
							</div>";
						}
					}
					$result->close();
	   			$db->close();
	    	?>

				<a class="twitter-timeline" href="https://twitter.com/goodhealth" data-width="400"  data-height="800"> Tweets by @goodhealth</a>
				<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</div>

	<?php
	// imports the footer
	include("../../inc/footer.inc");
	?>







