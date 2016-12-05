<<<<<<< HEAD
<html>
  <head>
    <title>BRU Web Project</title>
    <link rel='stylesheet' type='text/css' href='./css/main.css'>
    <link rel='stylesheet' type='text/css' href='./css/clubs.css'>
  </head>
  <body>
    <header>
    </header>
  <h1>Hello amazing World ! :D</h1>
  <p>This is our group project.</p>

  </body>
=======
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
		<p>Portlethen website - Homepage wip</p>
		</div>
		<!--Homepage Button -->
		<div id="Infobutton">
			<p>Pages</p>
        <form>
		<input class="button" onclick="window.location.href='index.php'" type="button" value="Homepage" />
		<input class="button" onclick="window.location.href='mapp'" type="button" value="Map" />
		<input class="button" onclick="window.location.href='health'" type="button" value="Health" />
		<input class="button" onclick="window.location.href='clubs'" type="button" value="Clubs" />
        </form>
		</div>

		<!--Body Text-->
		<div id="BodyText">
    			<?php
        			include("dbconnect.php");
        			echo "Welcome to GoPortlethean. We are an collection of local and progressive sports clubs who are working together to develop safe and fun sport & fitness activities in the Portlethen area. We work with sportscotland and other organisations to develop our clubs. Our website is a single access point to find out more about the fantastic sporting opportunities in our area.";
     			?>
			<br>
			<img src="images/Indeximage1.png" alt="Indeximage1.png" height="150" width="150">
			<img src="images/Indeximage2.png" alt="Indeximage2.png" height="150" width="150">
			<img src="images/Indeximage3.png" alt="Indeximage3.png" height="150" width="150">
			
			
		</div>

		<div id="footer">
		<address>Made 28 November 2016<br>
  		Website by Blackrabbit - Unicorns -.</address>
		</div>
	</body>
>>>>>>> f36836cda29a8f67e11c87e5db85bfc3b10a56f9
</html>
