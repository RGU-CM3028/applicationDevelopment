<?php
    // imports the header/navigation
    include("inc/header.inc");
    include("./dbconnect.php");
?>
  <section id="index-content">
		<div>
            <div id="left-content" class="clearfix">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=1673121366290064";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div>
                    <div class="fb-page" data-href="https://www.facebook.com/Sportlethen/?fref=ts" data-tabs="timeline" data-weight="500" data-height="800" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/Sportlethen/?fref=ts" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Sportlethen/?fref=ts">Sportlethen CSH</a>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div id="right-content" class="clearfix">
                <span>Welcome to GoPortlethen. We are a collection of local and progressive sports clubs who are working together to develop safe and fun sport and fitness activities in the Portlethen area. We work with Sportscotland and the Aberdeen Council to develop our clubs. Our website is a single access point to find out more about the fantastic sporting opportunities in our area.</span>
                <br>
                <div class="home-images">
                    <img src="images/IndexImage1.png" alt="Indeximage1.png" height="150" width="150">
                    <img src="images/IndexImage2.png" alt="Indeximage2.png" height="150" width="150">
                    <img src="images/IndexImage3.png" alt="Indeximage3.png" height="150" width="150">
                </div>
            </div>
      </div>
</section>

<?php
    // imports the footer
    include("inc/footer.inc");
?>
