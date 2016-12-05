<?php
// imports the header
include("../../inc/header.inc");
include('../../dbconnect.php');
global $db;
?>
	<section>
	<!--Body Text-->
		<div id="BodyText">
			<a class="twitter-timeline" href="https://twitter.com/goodhealth" data-width="200"  data-height="200"> Tweets by @goodhealth</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

			<?php
				// if (!$db) {
    		// 			die('Connect Error: ' . mysqli_connect_errno());
				// }
				$sql_query = "SELECT * FROM hwnews ORDER BY HWNewsDate DESC";
				$result = $db->query($sql_query);
				if($result->num_rows <= 0) {
					echo "There's no news for the moment";
				} else {
					echo "<p><strong>All news: </strong>";
					while($row = $result->fetch_array()){
						echo "<div>
								<h1> " . $row['HWNewsName'] . " </h1>
										<p> " . $row['HWNewsDate'] . "</p>
										<p> " . $row['HWNewsText'] . "</p>
						</div>";
					}
				}

				$result->close();
   				$db->close();
    ?>
		</div>

	</section>

	<?php
	// imports the footer
	include("../../inc/footer.inc");
	?>
