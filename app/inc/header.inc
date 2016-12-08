<?
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$isIndex = true;
if(strpos($actual_link, 'pages') == true) {
  $isIndex = false;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta name="description" content="sports">
		<meta name="keywords" content="sports">
		<meta name="author" content="Black Rabbit -Unicorns-">
		<title>Sportlethen</title>
		<script src="https://use.fontawesome.com/59db90bae7.js"></script>
		<? 	
		if($isIndex) {
  			echo '<link rel="stylesheet" type="text/css" href="css/main.css">';
		} else {
  			echo '<link rel="stylesheet" type="text/css" href="../../css/main.css">';
		}
		?>
	</head>
	
	<body>
		<div id="container">
			<header class="clearfix">
				<? 
				if($isIndex) {
    					echo '<a href="index.php"><img src="images/logo.png" class="logo"></img>
    					<img src="images/banner.png" class="title"></a>';
  				} else {
    					echo '<a href="../../index.php"><img src="../../images/logo.png" class="logo"></img>
    					<img src="../../images/banner.png" class="title"></a>';
				}
				?>
				<div id="login">
					<?
					//This starts the sessions.
					session_start();  
	 
					//This prepares the accesslevel.
					$accesslevel = $_SESSION['userType'];
	
					//This displays the function contents	
					function displayAccessLevelInformation($accessLevel){
						if ($accessLevel == "admin") {
							if($isIndex) { 	  
								echo '<a href="../pages/AdminControl/">Admin Control Pannel</a>';   
  							} else {
								echo '<a href="../AdminControl/">Admin Control Pannel</a>';  
							}
						}
					}	
					
					//This checks to see if the user is logged in or not. If the user is logged in then the user is able to see the following text.
					if (isset($_SESSION['username'])){
						echo "<p>Hello " . $_SESSION['username'] . "</p>";
						echo "<p>User type is " . $_SESSION['userType'] . "</p>";
						if($isIndex) { 	  
							echo '<a href="login/logout.php">Logout</a> ';   
  						} else {
							echo '<a href="../../login/logout.php">Logout</a>';  
						}
					}	
					//If the user isnt logged in then they see the following form. To log in.
    					else{
    						//This is the error message for if there is a login fail.
    						if(isset($_GET["Loginfail"]))  
    					{  
        					echo "<p><font color='red'>Please make sure you enter the correct information.</font></p>";  
 					}  
										
					if($isIndex) { 	  
						echo '<form method="post" action="login/checklogin.php"> ';   
  					} else {
						echo '<form method="post" action="../../login/checklogin.php">';  
					}
					?>
						<p><label>Username</label><input type="text" name="username" maxlength="30"></p>
						<p></p>
						<p><label>Password</label><input type="password" name="password" maxlength="25"></p>
						<p></p>
						<p><input type="submit" value="submit"></p>
					</form>
    					<?
					if($isIndex) { 	  
						echo '<a href="./pages/signup/">Signup</a> ';   
  					} else {
						echo '<a href="../signup/">Signup</a>';  
					}
						?>
				<? } ?>
				
				
				</div>
			</header>
			<!-- Desktop navigation w:801 onwards -->
			<nav>
				<ul> 
					<?
					if($isIndex) {
    						echo '
						<li class="navigation"><a href="./pages/clubs/">Clubs</a></li>
  						<li class="navigation"><a href="./pages/health/">Health and Wellbeing</a></li>
  						<li class="navigation"><a href="./pages/map/">Discover North Kincardineshire</a></li>';
					} else {
  						echo '
  						<li class="navigation"><a href="../clubs/">Clubs</a></li>
  						<li class="navigation"><a href="../health/">Health and Wellbeing</a></li>
  						<li class="navigation"><a href="../map/">Discover North Kincardineshire</a></li>';
					}
					?>
				</ul>
			</nav>
			<!-- Mobile navigation w:80 downwards -->
			<ul id="mobileMenu">
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropbtn" onclick="dropdown()" title="Navigation"><span class="fa fa-align-justify fa-2x"></span></a>
					<div class="dropdown-content" id="dropdownMenu">
						<a href="./pages/clubs/">Clubs</a>
						<a href="./pages/health/">Health and Wellbeing</a>
						<a href="./pages/map/">Discover North Kincardineshire</a>
					</div>
				</li>
			</ul>
