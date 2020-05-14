<?php
include ("dbconnection.php");

class searchBox
{
	function __construct()
	{}
	
	function searchData()
	{
		try
		{
			if(isset($_POST['searchBtn']))
			{
				$query = $_POST['query']; 
				// gets value sent over search form
							
				$min_length = 3;
				// you can set minimum length of the query if you want
							
				if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
								
					$query = htmlspecialchars($query); 
					// changes characters used in html to their equivalents, for example: < to &gt;
								
					$query = mysqli_real_escape_string($conn, $query);
					// makes sure nobody uses SQL injection
								
					$raw_results = mysqli_query($conn, "SELECT * FROM menu WHERE (`menu_name` LIKE '%".$query."%')") or die(mysqli_error($conn));
									
					// * means that it selects all fields, you can also write: `id`, `title`, `text`
					// articles is the name of our table
								
					// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
					// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
					// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
								
					if(mysqli_num_rows($raw_results) > 0)
					{ // if one or more rows are returned do following		
						while($results = mysqli_fetch_array($raw_results))
						{
							echo "hi";
						}
					}
					
					else
					{ // if there is no matching rows do following
						echo "No results";
					}
					
				}
				
				else
				{ // if query length is less than minimum
					echo "Minimum length is ".$min_length;
				}
			}
		}

		catch(exception $e)
		{
			$e->getMessage();
		}
	}
}
?>