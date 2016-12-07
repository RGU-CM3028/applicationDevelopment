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

<? if($isIndex) {
  echo '<link rel="stylesheet" type="text/css" href="css/main.css">';
} else {
  echo '<link rel="stylesheet" type="text/css" href="../../css/main.css">';
}
?>

</head>

<body>
<div id="container">
<header class="clearfix">
  <? if($isIndex) {
    echo '<a href="index.php"><img src="images/logo.png" class="logo"></img>
    <img src="images/banner.png" class="title"></a>';
  } else {
    echo '<a href="../../index.php"><img src="../../images/logo.png" class="logo"></img>
    <img src="../../images/banner.png" class="title"></a>';
  }
?>
<div id="login">
<form name="userlogin" action="" method="POST" target="_self" class="login">
<label>Username</label>
<input type="text" name="username" maxlength="30">
<label>Password</label><input type="password" name="userpass" maxlength="25">
<input type="submit" value="submit">
</form>
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
