<?php
include "nav.php";
include ("dbconnection.php");

$nav = new navigation($conn);

if(!isset($_POST['query']))
{
	echo "<script type=\"text/javascript\">
			setTimeout(\"location.href = 'view_menu.php';\",1);
		</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Search Result</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script src="js/jquery-1.6.js" ></script>
<script src="js/cufon-yui.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/Forum_400.font.js"></script>
<script src="js/atooltip.jquery.js"></script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<style type="text/css">.slider_bg {behavior:url("js/PIE.htc")}</style>
<![endif]-->

<style type="text/css">

.main-wrapper
{
	width : 900px;
	overflow : auto;
	display : inline-block;
	margin-bottom : 15px;
}

.left-menu
{
	border : 1px solid black;
	width : 150px;
	padding : 10px;
	background-color : rgba(255, 255, 255, 0.8);
	float : left;
}

.right-content
{
	width : 97%;
	padding : 10px;
	border : 1px solid black;
	background-color : rgba(255, 255, 255, 0.8);
	float : left;
}

.product
{
	width : 150px;
	height : 250px;
	float : left;
	margin-right : 10px;
	margin-bottom : 12px;
	padding : 6px;
	border : 1px solid gray;
}

.product:hover
{
	border : 1px solid silver;
}

.container {
  position: relative;
  width: 100%;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: rgba(0,0,0,0.8);
}

.container:hover .overlay {
  opacity: 1;
}

.text {
  white-space: nowrap;
  color : #f44336;
  font-size: 20px;
  position: relative;
  overflow: hidden;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
}

.product img
{
	width : 150px;
	height : 90px;
}

.discountprice
{
	color : red;
}

.actualprice
{
	text-decoration : line-through;
	color : black;
}

.buynow
{
	border : 1px solid orange;
	width : 150px;
	height : 40px;
	text-align : center;
	color : white;
	background-color : orange;
}

.buynow:hover
{
	color : orange;
	background-color : white;
}

.star img
{
	width : 15px;
	height : 15px;
}
</style>

</head>
<?php 
$nav->header1($conn);				
?>
      <!-- / header -->
      <!-- content -->
	  
	 <img src="images/banner.jpg" alt="" style="width : 900px; height : 150px; margin-bottom : 10px;" />
	 
	 <div class="main-wrapper">	 
	 <div class="right-content">
	<?php 
	if(isset($_POST['query']) && $_POST['query'] != "")
	{
		$query = $_POST['query']; 
		// gets value sent over search form
		$_SESSION['query'] = $query;
								
		$min_length = 3;
		// you can set minimum length of the query if you want
								
		if(strlen($query) >= $min_length)
		{	
			// if query length is more or equal minimum length then
						
			$query = htmlspecialchars($query); 
			// changes characters used in html to their equivalents, for example: < to &gt;
									
			$query = mysqli_real_escape_string($conn, $query);
			// makes sure nobody uses SQL injection
									
			

			$raw_results = mysqli_query($conn, "SELECT * FROM menu WHERE (`menu_name`  LIKE '%".$query."%') AND isDeleted = 'No'") or die(mysqli_error($conn));
			$num = mysqli_num_rows($raw_results);
						
			// * means that it selects all fields, you can also write: `id`, `title`, `text`
			// articles is the name of our table
									
			// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
			// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
			// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
			$total = 0;
			$exists = false;
			
			if(mysqli_num_rows($raw_results) > 0)
			{ // if one or more rows are returned do following		
				while($results = mysqli_fetch_array($raw_results))
				{
					$exists = false;
					$rating = mysqli_query($conn, "SELECT * FROM comment_and_rating WHERE menu_id = ".$results['menu_id']." ");
					if(mysqli_num_rows($rating) !=0)
					{
						$exists = true;
						$nums = mysqli_num_rows($rating);
						while($rate = mysqli_fetch_assoc($rating))
						{
							$total += $rate['rating'];
						}
						
						$print = false;
						$extra = false;
						$avg = $total/$nums;
						$star = floor($avg);
						$half = $avg - $star;
						
						if($half < 0.25)
						{
							$print = false;
						}
						
						else if($half >=0.25 && $half < 0.75)
						{
							$print = true;
						}
						
						elseif($half >= 0.75)
						{
							$extra = true;
						}
					}
					
					echo "<a href=\"product_description.php?pid=". $results['menu_id'] ."\">
						<div class=\"product\">
							<div class=\"container\">
							<img src=\"admin/". $results['menu_path']. "\" />
							<div class=\"overlay\">
								<div class=\"text\" >
									<p>".$results['menu_ingredient']."</p>
									<p>".$results['menu_spicelevel']."</p>
								</div>
							</div>
							</div>
							<caption>". $results['menu_name'] ."</caption>
							<p><span class=\"discountprice\">RM "; echo number_format((float)$results['menu_price'], 2, '.', ''); echo"</p>
							"; if($exists == true)
								{
									for($i=0; $i<$star; $i++)
									{
										echo "<span class=\"star\"><img src=\"images/star.png\" width=\"5px\" height=\"5px\" /></span>";
									}
									
									if($print == true)
									{
										echo "<span class=\"star\"><img src=\"images/half_star.png\" width=\"5px\" height=\"5px\" /></span>";
									}
									
									if($extra == true)
									{
										echo "<span class=\"star\"><img src=\"images/star.png\" width=\"5px\" height=\"5px\" /></span>";
									}
								}
							
							echo"
							<div class=\"buynow\">Buy Now</div>
						</div>
					</a>";
				}
			}
						
			else
			{ // if there is no matching rows do following
				echo "No results found";
			}
					
		}
				
		else
		{ // if query length is less than minimum
			echo "Minimum length is ".$min_length;
		}
	}
	
	else
	{
		echo "<script type=\"text/javascript\">
				 setTimeout(\"location.href = 'view_menu.php';\",1);
			</script>";
	}
?> 
		
	 </div>
	 
	 </div>
	  
	  </div>
  </div>
</div>
<?php $nav->footer2() ?>
</body>
</html>