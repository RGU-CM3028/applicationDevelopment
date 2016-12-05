<?
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$isIndex = true;
if(strpos($actual_link, 'pages') == true) {
  $isIndex = false;
}
?>

<footer class="clearfix">
<div class="footer-left">
<a href="index.php" title="Sportlethen | Home"><img src="images/banner.png" class="banner" alt="TeaKat Games"></a>
<p class="copytext">2016 &copy; Sportlethen. All Rights Reserved.</p>
<p class="footer-sponser">
  <?php if($isIndex) {
    <a href=""><img src="images/sportscotland.png" class="img1"></a>
    <a href=""><img src="images/aderdeencouncil.png" class="img2"></a>

  }
</p>
<p class="design">Made by Black Rabbit -Unicorns- &copy; 2016</p>
</div>
<div class="footer-middle">
<li><span class="sc">Stay Connected</span></li>
<li><a href="https://www.facebook.com/Sportlethen/" title="Facebook"><span class="fa fa-facebook-official fa-4x"></span></a>
<a href="youtube" title="Youtube"><span class="fa fa-youtube-play fa-4x"></span></a>
<a href="twitter" title="Twitter"><span class="fa fa-twitter fa-4x"></li>
</div>
<div class="footer-right">
<span class="contact">Contact Us</span>
<ul>
<li>E-mail: emaile@adress.co.uk</li>
<li>Telephone: xxxx-xxx-xxxx</li>
<li>Fax: xxxx-xxx-xxxx</li>
<li>Address:</li>
</ul>
</div>
</footer>

</body>
</html>
