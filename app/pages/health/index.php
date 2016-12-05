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
				if (!$db) {
    					die('Connect Error: ' . mysqli_connect_errno());
				}
				$sql_query = "SELECT * FROM news ORDER BY timestamp DESC";
				$result = $db->query($sql_query);
				echo "<p><strong>All news: </strong>";
				while($row = $result->fetch_array()){
					echo "News ID: " . $row['id'] . ", " . $row['headline'] . "</p>" . "Writer: " . $row['name'] . ", Time: " . $row['timestamp'] . "</p>" . $row['story'] . "</p>";
				}
				$result->close();
   				$db->close();
     			?>
		</div>

		<div id="footer">
		<address>Made 28 November 2016<br>
  		Website by Blackrabbit - Unicorns -.</address>
		</div>
	</section>

	<?php
	// imports the footer
	include("./../inc/footer.inc");
	?>
