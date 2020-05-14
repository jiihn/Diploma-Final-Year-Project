<?php
include "nav.php";
include ("dbconnection.php");
include ("searchBox.php");

$nav = new navigation($conn);
$sb = new searchBox();

$sql = mysqli_query($conn, "SELECT * FROM menu ORDER BY menu_id DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Menu</title>
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
                <a href="view_menu.php"><h2>Main <span>Menu</span></h2>
                <figure><img src="images/page2_img1.jpg" alt="" ></figure>
                <p class="pad_bot1" style = "color : white;">Welcome to Lunar Cafe where you can find the best western cuisines and cafes in town. Dine-in and delivery services are provided here!</p>
                </div></a>
            </div>
          </section>
          <section class="cols pad_left1">
            <div class="box">
              <div>
				<h2 class="letter_spacing">Drinks<span> & </span>Dessert</h2>
                <ul class="list1 pad_bot1">
				<?php
					$drink = mysqli_query($conn, "SELECT * FROM menu WHERE menutype_id = 2 OR menutype_id = 3 AND isDeleted = 'No' ORDER BY menu_id DESC LIMIT 9");
					
					while($dessert = mysqli_fetch_assoc($drink))
					{?>
						<li><a href="product_description.php?pid=<?php echo $dessert['menu_id']; ?>"><?php echo $dessert['menu_name']; ?></a></li><?php
					}
				?>
                </ul> </div>
            </div>
          </section>
          <section class="cols pad_left1">
            <div class="box">
              <div>
                <h2>Dish <span>of the Day</span></h2>
                <figure><img src="images/page2_img2.jpg" alt="" ></figure>
                <p class="pad_bot1">Our very own Homemade Spaghetti with House Special Sauce and Roasted Sliced Duck.<br>Try Out Today!</p>
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
          <h2>Banquet’s Specials</h2>
          <div class="line1">
            <div class="wrapper line2">
              <div class="cols">
                <div class="wrapper pad_bot1">
                  <figure class="pad_bot1"><img src="images/page2_img3.jpg" alt=""></figure>
				  </div>
              </div>
              <div class="cols pad_left1">
                <div class="wrapper pad_bot1">
                  <figure class="pad_bot1"><img src="images/page2_img4.jpg" alt=""></figure>
				  </div>
              </div>
              <div class="col2 pad_left1">
                <div class="wrapper pad_bot1">
                  <figure class="pad_bot1"><img src="images/page2_img5.jpg" alt=""></figure>
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
