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
<title>Lunar | Home</title>
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
			<script src=\"js/html5.js\"></script>
			<style type=\"text/css\">.slider_bg {behavior:url(\"js/PIE.htc\")}</style>
			<![endif]-->
</head>
<?php 
$nav->header1($conn);?>
        <!-- / header -->
        <!-- content -->
        <article id="content">
          <div class="slider_bg">
            <div class="slider">
              <ul class="items">
                <li> <img src="images/img1.jpg" alt="">
                  <div class="banner"> <strong>Flavoured<span>Hazelnut</span></strong> <b>Coffee of the Day</b>
                    <p> <span>Try our very own homemade Latte.<br>
                      If you’re seeking the perfect latte with the best milk-to-espresso-to-syrup ratio, then visit us today!</span> </p>
                  </div>
                </li>
                <li> <img src="images/img2.jpg" alt="">
                  <div class="banner"> <strong>Chocolate<span>Fudge</span></strong> <b>Cake of the Day</b>
                    <p> <span>The best chocolate cake in town!<br>
                      Our House special chocolate cake baked with peanut toppings which will make your taste buds dance!</span> </p>
                  </div>
                </li>
                <li> <img src="images/img3.jpg" alt="">
                  <div class="banner"> <strong>Fish N' Chips<span>Special</span></strong> <b>Dish of the Day</b>
                    <p> <span>Our very own Fish N' Chips.<br>
                      Cooked with our House special sauce to make things spice up a lil' bit! A must to try!</span> </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="wrap">
            <section class="cols">
              <div class="box">
                <div>
                  <h2>Welcome <span>to Us!</span></h2>
                  <figure><img src="images/page1_img1.jpg" alt="" ></figure>
                  <p class="pad_bot1">Lunar cafe is well-known with their Fish N' Chips which comes with their House special sauce. Find out their Coffees with various toppings here.</p>
              </div>
            </section>
            <section class="cols pad_left1">
              <div class="box">
                <div>
                  <h2>About <span>Us</span></h2>
                  <figure><img src="images/page1_img2.jpg" alt="" ></figure>
                  <p class="pad_bot1">Lunar Cafe was found by Mr.Ken on 1998. He started this business to create more variety of foods and beverages to serve his customers.</p>
              </div>
            </section>
            <section class="cols pad_left1">
              <div class="box">
                <div>
                  <h2>Our <span>Services</span></h2>
                  <figure><img src="images/page1_img3.jpg" alt="" ></figure>
                  <ul class="list1 pad_bot1">
                    <li>Delivery Services</li>
                    <li>Cash On Delivery</li>
                    <li>Dine-In</li>
                    <li>Contact</li>
                  </ul>
              </div>
            </section>
          </div>
        </article>
      </div>
    </div>
  </div>
</div>
<div class="body2">
  <div class="main">
    <article id="content2">
      <div class="wrapper">
        <section class="pad_left1">
          <h2>New in Our Shop</h2>
          <div class="line1">
            <div class="wrapper line2">
              <div class="cols">
                <div class="wrapper pad_bot1">
                  <figure class="pad_bot1"><img src="images/page1_img5.jpg" alt=""></figure>
                  Black Pepper Chicken Chop </div>
              </div>
              <div class="cols pad_left1">
                <div class="wrapper pad_bot1">
                  <figure class="pad_bot1"><img src="images/page1_img6.jpg" alt=""></figure>
                  Salad Wrap</div>
              </div>
              <div class="col2 pad_left1">
                <div class="wrapper pad_bot1">
                  <figure class="pad_bot1"><img src="images/page1_img7.jpg" alt=""></figure>
                  Sliced Salmon with Onion </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </article>
    <!-- / content -->
  </div>
</div>

<?php
$nav->footer();
?>
</body>
</html>
