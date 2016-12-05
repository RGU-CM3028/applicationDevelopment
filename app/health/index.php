<!DOCTYPE html>
<html lang="en"> 
	<head>
		<meta charset="utf-8"/>
		<title>Portlethen site</title>
		<link rel="stylesheet" type="text/css" href="css/indexold.css">
	</head>

	<body>
		<!--Logo-->
		<div id="Logo">
        		<img src="images/logo-placeholder.png" alt="logo-placeholder.png" height="150" width="250">
		</div>

		<!--Page Name-->
		<div id="Pagename">
			<p>Portlethen website - Health and wellbeing wip</p>
		</div>

		<!--Homepage Button -->
		<div id="Infobutton">
			<p>Pages</p>
        		<form>
				<input class="button" onclick="window.location.href='index.php'" type="button" value="Homepage" />
				<input class="button" onclick="window.location.href='map.php'" type="button" value="Map" />
				<input class="button" onclick="window.location.href='Health.php'" type="button" value="Health" />
				<input class="button" onclick="window.location.href='Clubs.php'" type="button" value="Clubs" />
        		</form>
		</div>

		<!--Body Text-->
		<div id="BodyText">
			<a class="twitter-timeline" href="https://twitter.com/goodhealth" data-width="200"  data-height="200"> Tweets by @goodhealth</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
    			
			<?php
				include("dbconnect.php");
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
	</body>
</html>
