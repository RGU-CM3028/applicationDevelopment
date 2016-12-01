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

		<!--External link test -->
		<div id="Locationbutton">
        <form>
		<input class="button" onclick="window.location.href='http://animasave.altervista.org/PHP%20Folder/PHP%20Index%20Page.php'" type="button" value="External link test" /> 
		</form>
		</div>

		<!--Body Text-->
		<div id="BodyText">
    <?php
        include("dbconnect.php");
        echo "Health and wellbeing stuff go here";
     ?>
		</div>

		<div id="footer">
		<address>Made 28 November 2016<br>
  		Website by Blackrabbit - Unicorns -.</address>
		</div>
	</body>
</html>
