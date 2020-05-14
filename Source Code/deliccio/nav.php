<?php
include ("dbconnection.php");

class navigation
{
	function __construct($conn)
	{}
	
	function header1($conn)
	{
		if (isset($_SESSION["loggedin"]))
		{	
			$sess_memid = $_SESSION["sess_memid"];
			
			$sql = mysqli_query($conn, "SELECT * FROM member WHERE member_id = $sess_memid");
			if($sql)
			{
				$row = mysqli_fetch_assoc($sql);
			}
			
			echo "<body id=\"page1\">
				<div class=\"body6\">
				  <div class=\"body1\">
					<div class=\"body5\">
					  <div class=\"main\">
						<!-- header -->
						<h4>Logged in as : ";echo $row['member_name']; echo"</h4>
						<header>
						  <h1><a href=\"index.php\" id=\"logo\">Lunar Cafe</a></h1>
						<nav>
							<ul id=\"top_nav\">
									  <li><div class=\"tooltip\"><a href=\"../logout.php\"><img src=\"images/logout_logo.ico\" alt=\"\"></a>
									  <span class=\"tooltiptext\">Logout</span>
									  </div></li>
									  <li><div class=\"tooltip\"><a href=\"index.php\"><img src=\"images/home_logo.ico\" alt=\"\"></a>
									  <span class=\"tooltiptext\">Home</span>
									  </div></li>
									  <li><div class=\"tooltip\"><a href=\"view_cart.php\"><img src=\"images/cart.ico\" alt=\"\"></a>
									  <span class=\"tooltiptext\">Shopping Cart</span>
									  </div></li>
									  <li><div class=\"tooltip\"><a href=\"profile.php\"><img src=\"images/user.ico\" alt=\"\"></a>
									  <span class=\"tooltiptext\">Profile</span>
									  </div></li>
									  <li class=\"end\"><div class=\"tooltip\"><a href=\"contacts.php\"><img src=\"images/contact.ico\" alt=\"\"></a>
									  <span class=\"tooltiptext\">Contact Us</span>
									  </div></li>
									</ul>
									</nav>
									  <nav>
										<ul id=\"menu\">
										  <li><a href=\"index.php\">Cafe</a></li>
										  <li><a href=\"menu.php\">Menu</a></li>
										  <li><a href=\"beverage.php\">Beverage</a></li>
										  <li><a href=\"cook-book.php\">CookBook</a></li>
										  <li><a href=\"contacts.php\">Contacts</a></li>
										</ul>
									  </nav>
									  <form name=\"searchFrm\" action=\"search.php\" method=\"post\">
											<div class=\"search-box\">
												<p><input type=\"text\" name=\"query\" placeholder=\"Press Enter to search\"/></p>
											</div>
										</form>
										</header>";
		}
		
		else
		{
			echo "<body id=\"page1\">
					<div class=\"body6\">
					  <div class=\"body1\">
						<div class=\"body5\">
						  <div class=\"main\">
							<!-- header -->
							<header>
							  <h1><a href=\"index.php\" id=\"logo\">Lunar Cafe</a></h1>
							<nav>
								<ul id=\"top_nav\">
								<li><div class=\"tooltip\"><a href=\"index.php\"><img src=\"images/home_logo.ico\" alt=\"\"></a>
								<span class=\"tooltiptext\">Home</span>
								</div></li>
								<li><div class=\"tooltip\"><a href=\"login.php\"><img src=\"images/user.ico\" alt=\"\"></a>
								<span class=\"tooltiptext\">Login</span>
								</div></li>
								<li class=\"end\"><div class=\"tooltip\"><a href=\"contacts.php\"><img src=\"images/contact.ico\" alt=\"\"></a>
								<span class=\"tooltiptext\">Contact Us</span>
								</div></li>
								</ul>
							</nav>
							  <nav>
								<ul id=\"menu\">
								  <li><a href=\"index.php\">Cafe</a></li>
								  <li><a href=\"menu.php\">Menu</a></li>
								  <li><a href=\"beverage.php\">Beverage</a></li>
								  <li><a href=\"cook-book.php\">CookBook</a></li>
								  <li><a href=\"contacts.php\">Contacts</a></li>
								</ul>
							  </nav>						  
								  <form name=\"searchFrm\" action=\"search.php\" method=\"post\">
											<div class=\"search-box\">
												<p><input type=\"text\" name=\"query\" placeholder=\"What are you looking for?\"/>
												</p>	
											</div>
										</form>
										</header>";
		}
	}
	
		function footer()
		{
			echo "<div class=\"body3\">
			  <div class=\"body4\">
				<div class=\"main\">
				  <!-- footer -->
				  <footer>
					<div class=\"wrapper\">
					  <section class=\"col1 pad_left1\">
						<h3>Toll Free: <span>1-800 123 45 67</span></h3>
						Copyright &copy; <a href=\"#\">Domain Name</a> All Rights Reserved<br>
						Design by <a target=\"_blank\" href=\"http://www.templatemonster.com/\">TemplateMonster.com</a></section>
					  <section class=\"col2 pad_left1\">
						<h3>Follow Us </h3>
						<ul id=\"icons\">
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon1.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon2.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon3.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon4.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon5.gif\" alt=\"\"></a></li>
						</ul>
					  </section>
					</div>
					<!-- {%FOOTER_LINK} -->
				  </footer>
				  <!-- / footer -->
				</div>
			  </div>
			</div>

			<script>Cufon.now();</script>";
		}
		
		function footer2()
		{
			echo "<div class=\"body2\">
			  <div class=\"main\">
				<article id=\"content2\">
				  <div class=\"wrapper\">
					<section class=\"pad_left1\">
					  <div class=\"wrapper\">
						<div class=\"cols\">
						  <h2>Our Contacts</h2>
						</div>
						<div class=\"col3 pad_left1\">
						  <h2>Miscellaneous Info</h2>
						</div>
					  </div>
					  <div class=\line1\">
						<div class=\"wrapper line2\">
						  <div class=\"cols\">
							<div class=\"wrapper pad_bot1\">
							  <p>Contact us or find us at our location.</p>
							  <p class=\"address\"> BBU 4, Taman Bukit Beruang<br>
								<span>Handphone:</span> +6012-9231301<br>
								<span>Telephone:</span> +06748 9124<br>
								<span>E-mail:</span> <a href=\"#\">lunarcafe123@gmail.com</a> </p>
							</div>
						  </div>
						  <div class=\"col3 pad_left1\">
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

			<div class=\"body3\">
			  <div class=\"body4\">
				<div class=\"main\">
				  <!-- footer -->
				  <footer>
					<div class=\"wrapper\">
					  <section class=\"col1 pad_left1\">
						<h3>Toll Free: <span>1-800 123 45 67</span></h3>
						Copyright &copy; <a href=\"#\">Domain Name</a> All Rights Reserved<br>
						Design by <a target=\"_blank\" href=\"http://www.templatemonster.com/\">TemplateMonster.com</a></section>
					  <section class=\"col2 pad_left1\">
						<h3>Follow Us </h3>
						<ul id=\"icons\">
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon1.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon2.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon3.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon4.gif\" alt=\"\"></a></li>
						  <li><a href=\"#\" class=\"normaltip\"><img src=\"images/icon5.gif\" alt=\"\"></a></li>
						</ul>
					  </section>
					</div>
					<!-- {%FOOTER_LINK} -->
				  </footer>
				  <!-- / footer -->
				</div>
			  </div>
			</div>
			<script>Cufon.now();</script>";
		}
}
?>