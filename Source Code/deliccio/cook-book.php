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
<title>Lunar | CookBook</title>
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
          <section class="cols">
            <div class="box">
              <div>
                <h2>Recent <span>Recipes</span></h2>
                <ul class="list1 pad_bot1">
                  <li><a href="#">Baked Salmon with Lemons</a></li>
                  <li><a href="#">Spaghetti with House Special Sauce</a></li>
                  <li><a href="#">Grilled Chicken Burger with Onions</a></li>
                  <li><a href="#">Baked Cheese Rice</a></li>
                  <li><a href="#">Black Pepper Chicken Chop</a></li>
                  <li><a href="#">Beef Steak with Brown Sauce</a></li>
                  <li><a href="#">Homemade Salad</a></li>
                  <li><a href="#">Smoked Duck with Pepper</a></li>
                  <li><a href="#">Fish N' Chips Special</a></li>
                </ul>
                </div>
            </div>
          </section>
          <section class="cols pad_left1">
            <div class="box">
              <div>
                <h2>Your <span>Benefit</span></h2>
                <figure><img src="images/page4_img1.jpg" alt="" ></figure>
                <p class="pad_bot1">We are giving Free Recipes for You to try out on your own! Promotions will be given away to You while you join us in Lunar Cafe!</p>
                </div>
            </div>
          </section>
          <section class="cols pad_left1">
            <div class="box">
              <div>
                <h2 class="pad_bot1">Our <span>Standards</span></h2>
                <p class="pad_bot1"> <strong>1. Clean Environment</strong><br>
                  Our cafe is rated as 5 stars in cleanliness.<br>
                  <strong>2. Fast Delivery</strong><br>
                  Delivery will be on your doorstep in 30 minutes after you order.<br>
                  <strong>3. Dine-In</strong><br>
                  Food will be served right in front of you after 15 minutes.</p>
                </div>
            </div>
          </section>
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
            <div class="col1">
              <h2>CookBook</h2>
            </div>
            <div class="col2 pad_left1">
              <h2>Food Delivery</h2>
            </div>
          </div>
          <div class="wrapper line2">
            <div class="col1">
              <div class="wrapper">
                <figure class="left marg_right1"><img src="images/page4_img2.jpg" alt=""></figure>
                <p> <a href="#">Veggies!</a><br>
                  Delicious vegetable recipes are important for every kitchen because it is tough to eat those veggies if they do not taste yummy! They provide high amounts of vitamins and minerals as well as fiber that is needed for <br> health.</p>
              </div>
              <div class="wrapper">
                <figure class="left marg_right1"><img src="images/page4_img3.jpg" alt=""></figure>
                <p> <a href="#">Fruits!</a> <br>
                  There are fruit and fruit-influenced starters: Steamed Shrimp with <br> 
				  Roasted Pepper and Apple Dip and Fruity Bruschetta. Salads: Sicilian Orange Salad, Tropical Lobster Salad. Entrees: Pepper Steak with Plum Ketchup, Braised Cranberry Pork Chops, Lemon Chicken.</p>
              </div>
            </div>
            <div class="col2 pad_left1">
              <div class="wrapper pad_bot1">
                <figure class="pad_bot1"><img src="images/page4_img4.jpg" alt=""></figure>
                Order your delivery on our website <b>OR</b> <br> Contact Us @ +06748 9124 <br> E-mail: Lunar@cafe.com</div>
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
