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
<title>Lunar | Beverage</title>
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
                <h2 class="letter_spacing">Fruit Juice</h2>
                <figure><img src="images/fj.jpg"  alt="" ></figure>
                <p class="pad_bot1">Fruit Juice is indeed the most healthiest beverage that you can find in the world! Come try out our very own special fruit juice today!</p>
                </div>
            </div>
          </section>
          <section class="cols pad_left1">
            <div class="box">
              <div>
                <h2>Coffee</h2>
                <figure><img src="images/cc1.jpg" alt="" ></figure>
                <p class="pad_bot1">A cup of coffee in the morning may pack more than just an energy boost. Try out our best selling coffee <b>Cappucino Latte</b> today.</p>
                </div>
            </div>
          </section>
          <section class="cols pad_left1">
            <div class="box">
              <div>
                <h2>Milkshake</h2>
                <figure><img src="images/c1.jpg" alt="" ></figure>
                <p class="pad_bot1">A cold drink made of milk and fruit or chocolate, and typically ice cream, whisked frothy that will definitely brighten up your day!</p>
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
            <div class="cols">
              <h2><b>Top 3 Best Seller</b></h2>
            </div>
            <div class="col3 pad_left1">
              <h2>Our Top Beverages List</h2>
            </div>
          </div>
          <div class="line1">
            <div class="wrapper line2">
              <div class="cols">
                <div class="col2">
                  <figure class="pad_bot1"><img src="images/tt.jpg" alt=""></figure>
                    <li><a href="product_description.php?pid=15">Grape Juice</a></li>
                    <li><a href="product_description.php?pid=14">Vanilla Latte</a></li>
                    <li><a href="product_description.php?pid=13">Chocolate Banana Milkshake</a></li>
                  </ul>
				  </div>
              </div>
              <div class="cols pad_left1">
                <div class="col2">
                  <ul >
                    <li>Caramel Macchiato</li>
                    <li>Strawberry Swiss</li>
                    <li>Watermelon Juice</li>
                    <li>Green Tea Cream</li>
                    <li>Vanilla Latte with Chips</li>
                    <li>Apple Juice with Milk</li>
                    <li>Ice Blended Mango Juice</li>
					<li>Chestnut Praline Latte</li>
                  </ul>
                </div>
              </div>
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
