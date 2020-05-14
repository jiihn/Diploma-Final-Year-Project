<?php
include ("../dbconnection.php");

class navigation
{
	var $user = "";
	
	function __construct()
	{}
	
	function header1()
	{
		if (isset($_SESSION["aloggedin"]))
		{	
			if($_SESSION['access'] == 1)
			{
				$user = "Admin";
			}
			
			else if($_SESSION['access'] == 0)
			{
				$user = "Staff";
			}
			$sess_email = $_SESSION["email"];
			
			if($user == 'Admin')
			{
				echo "<nav id=\"myNavbar\" class=\"navbar navbar-default\" role=\"navigation\">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class=\"container\">
							<div class=\"navbar-header\">
								<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
									<span class=\"sr-only\">Toggle navigation</span>
									<span class=\"icon-bar\"></span>
									<span class=\"icon-bar\"></span>
									<span class=\"icon-bar\"></span>
									<span class=\"icon-bar\"></span>
								</button>
								<a class=\"navbar-brand\" href=\"index.php\">Lunar Cafe</a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
								<ul class=\"nav navbar-nav\">
									<li class=\"dropdown\">
									<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Meal Managenent <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"add_menu.php\">Add Menu</a></li>
											<li><a href=\"view_menu.php\">View Menu</a></li>
											<li class=\"divider\"></li>
											<li><a href=\"add_category.php\">Add Category</a></li>
											<li><a href=\"view_category.php\">View Category</a></li>
											<li class=\"divider\"></li>
											<li><a href=\"add_menuType.php\">Add Menu Type</a></li>
											<li><a href=\"view_menuType.php\">View Menu Type</a></li>
										</ul>
									</li>	
									<li class=\"dropdown\">
										<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Staff Management <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"add_staff.php\">Add Staff</a></li>
											<li><a href=\"view_staff.php\">View Staff</a></li>
										</ul>
									</li>
									<li class=\"dropdown\">
										<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Finance Management <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"add_gst.php\">Add GST</a></li>
											<li><a href=\"view_gst.php\">View GST</a></li>
										</ul>
									</li>
									<li class=\"dropdown\">
									<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Location Managenent <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"add_state.php\">Add State</a></li>
											<li><a href=\"view_state.php\">View State</a></li>
											<li class=\"divider\"></li>
											<li><a href=\"add_city.php\">Add City</a></li>
											<li><a href=\"view_city.php\">View City</a></li>
										</ul>
									</li>
									<li class=\"dropdown\">
										<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Others <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"order_details.php\">Total Order</a></li>
										</ul>
									</li>
								</ul>
								<ul class=\"nav navbar-nav navbar-right\">
									<li class=\"dropdown\">
										<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\"><b class=\"glyphicon glyphicon-user\"></b> $user <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a>Signed in as <br /> <strong>$sess_email</strong></a>
											<li class=\"divider\"></li>
											<li><a href=\"profile.php\">Profile</a></li>
											<li><a href=\"#\">Message <span class=\"badge\">24</span></a></li>
											<li><a href=\"#\">Notification <span class=\"badge\">15</span></a></li>
											<li class=\"divider\"></li>
											<li><a href=\"#\">Settings</a></li>
											<li><a href=\"logout.php\">Log Out</a></li>
										</ul>
									</li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>";
			}
			
			else if($user == 'Staff')
			{
				echo "<nav id=\"myNavbar\" class=\"navbar navbar-default\" role=\"navigation\">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class=\"container\">
							<div class=\"navbar-header\">
								<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
									<span class=\"sr-only\">Toggle navigation</span>
									<span class=\"icon-bar\"></span>
									<span class=\"icon-bar\"></span>
									<span class=\"icon-bar\"></span>
									<span class=\"icon-bar\"></span>
								</button>
								<a class=\"navbar-brand\" href=\"index.php\">Lunar Cafe</a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
								<ul class=\"nav navbar-nav\">
									<li class=\"dropdown\">
									<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Meal Managenent <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"view_menu.php\">View Menu</a></li>
											<li class=\"divider\"></li>
											<li><a href=\"view_category.php\">View Category</a></li>
											<li class=\"divider\"></li>
											<li><a href=\"view_menuType.php\">View Menu Type</a></li>
										</ul>
									</li>
									<li class=\"dropdown\">
										<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Others <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"order_details.php\">Total Order</a></li>
										</ul>
									</li>
								</ul>
								<ul class=\"nav navbar-nav navbar-right\">
									<li class=\"dropdown\">
										<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\"><b class=\"glyphicon glyphicon-user\"></b> $user <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a>Signed in as <br /> <strong>$sess_email</strong></a>
											<li class=\"divider\"></li>
											<li><a href=\"profile.php\">Profile</a></li>
											<li><a href=\"#\">Message <span class=\"badge\">24</span></a></li>
											<li><a href=\"#\">Notification <span class=\"badge\">15</span></a></li>
											<li class=\"divider\"></li>
											<li><a href=\"#\">Settings</a></li>
											<li><a href=\"logout.php\">Log Out</a></li>
										</ul>
									</li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>";
			}
		}
	}
}
?>