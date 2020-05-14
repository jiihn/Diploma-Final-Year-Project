<?php
include "nav.php";
include ("dbconnection.php");
include ("searchBox.php");

$nav = new navigation($conn);
$sb = new searchBox();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Contact</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script src="js/jquery-1.6.js" ></script>
<script src="js/cufon-yui.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/Forum_400.font.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/tms-0.3.js"></script>
<script src="js/tms_presets.js"></script>
<script src="js/script.js"></script>
<script src="js/atooltip.jquery.js"></script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<style type="text/css">.slider_bg {behavior:url("js/PIE.htc")}</style>
<![endif]-->
</head>
</head>
<?php 
$nav->header1($conn);?>
      <!-- / header -->
      <!-- content -->
      <article id="content">
        <div class="wrap">
          <div class="box">
            <div>
              <h2 class="letter_spacing">Contact <span>Form</span></h2>
              <form id="ContactForm" action="#">
                <div>
                  <div class="wrapper"> <span>Your Name:</span>
                    <input type="text" class="input" >
                  </div>
                  <div class="wrapper"> <span>Your E-mail:</span>
                    <input type="text" class="input" >
                  </div>
                  <div class="textarea_box"> <span>Your Message:</span>
                    <textarea name="textarea" cols="1" rows="1"></textarea>
                  </div>
                  <a href="mailto:lunarcafe123@gmail.com?Subject=Contact%20us" class="button1">Send</a></div>
              </form>
            </div>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>
<div class="body2">
  <div class="main">
    <article id="content2">
      <div class="wrapper">
        <section class="pad_left1">
          <div class="wrapper">
            <div class="cols">
              <h2>Our Contacts</h2>
            </div>
            <div class="col3 pad_left1">
              <h2>Miscellaneous Info</h2>
            </div>
          </div>
          <div class="line1">
            <div class="wrapper line2">
              <div class="cols">
                <div class="wrapper pad_bot1">
                  <p>Contact us or find us at our location.</p>
                  <p class="address"> BBU 4, Taman Bukit Beruang<br>
                    <span>Handphone:</span> +6012-9231301<br>
                    <span>Telephone:</span> +06748 9124<br>
                    <span>E-mail:</span> <a href="#">Lunar@cafe.com</a> </p>
                </div>
              </div>
              <div class="col3 pad_left1">
                <p> Lunar Cafe serves traditional and signature Southern and Western food seven nights a week and 
				lunch Monday through Friday. Delivery are provided if you are not able to come to our shop. 
				If you would like us to delivery to out of our coverage area, let us know, we will try our best to deliver to your doorstep. 
				Everything we do is about making you feel welcome and taken care of. </p>
                We specialize in Western food with some signature dishes created by chef/owner Ken. 
				Our ingredients are fresh and our preparation is always to order, 
				just for you. </div>
            </div>
          </div>
        </section>
      </div>
    </article>
    <!-- / content -->
  </div>
</div>

<div class="body3">
  <div class="body4">
    <div class="main">
      <!-- footer -->
      <footer>
        <div class="wrapper">
          <section class="col1 pad_left1">
            <h3>Toll Free: <span>1-800 123 45 67</span></h3>
            Copyright &copy; <a href="#">Domain Name</a> All Rights Reserved<br>
            Design by <a target="_blank" href="http://www.templatemonster.com/">TemplateMonster.com</a></section>
          <section class="col2 pad_left1">
            <h3>Follow Us </h3>
            <ul id="icons">
              <li><a href="#" class="normaltip"><img src="images/icon1.gif" alt=""></a></li>
              <li><a href="#" class="normaltip"><img src="images/icon2.gif" alt=""></a></li>
              <li><a href="#" class="normaltip"><img src="images/icon3.gif" alt=""></a></li>
              <li><a href="#" class="normaltip"><img src="images/icon4.gif" alt=""></a></li>
              <li><a href="#" class="normaltip"><img src="images/icon5.gif" alt=""></a></li>
            </ul>
          </section>
        </div>
        <!-- {%FOOTER_LINK} -->
      </footer>
      <!-- / footer -->
    </div>
  </div>
</div>
<script>Cufon.now();</script>
</body>
</html>
