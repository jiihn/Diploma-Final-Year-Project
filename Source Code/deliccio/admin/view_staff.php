<?php

$num_rec_per_page=10;

include "../dbconnection.php";
include "nav.php";
ob_start();

if ($_SESSION["aloggedin"] != 1)
{
	header("Location: login.php");
}

else if($_SESSION['access'] != 1)
{
	echo "<script type=\"text/javascript\">
			setTimeout(\"window.location='access_denied.php';\", 1);
	</script>";
}

else
{
	if (isset($_REQUEST["sid"])) 
	{
		$sid = $_REQUEST["sid"]; 
		mysqli_query($conn, "UPDATE staff SET isDeleted = 'Yes' WHERE staff_id = $sid");
		
		header("Location: view_staff.php");
	}
	
	if (isset($_GET["page"]))
	{
		$page  = $_GET["page"];
	}

	else
	{
		$page=1;
	};
	 
	$start_from = ($page-1) * $num_rec_per_page; 
	$sql = "SELECT * FROM staff 
	WHERE isDeleted = 'No' 
	LIMIT $start_from, $num_rec_per_page"; 
	$result3 = mysqli_query ($conn, $sql); //run the query
	
	$nav = new navigation();

	$sess_id = $_SESSION["sess_id"]; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - View Staff</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"></script>
<script type="text/javascript">
function confirmation()
{
	answer = confirm("Want to delete this staff?");
	return answer;
	
	// if false is returned, record will not be deleted
	// if return true, record will be deleted
}
</script>
<style type="text/css">
	.navbar{
		margin-top: 20px;
	}
</style>
<style>
#myInput {
    background-image: url('/css/searchicon.png'); /* Add a search icon to input */
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    width: 100%; /* Full-width */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 40px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
}

#myTable {
    border-collapse: collapse; /* Collapse borders */
    width: 100%; /* Full-width */
    border: 1px solid #ddd; /* Add a grey border */
    font-size: 18px; /* Increase font-size */
}

#myTable th, #myTable td {
    text-align: left; /* Left-align text */
    padding: 12px; /* Add padding */
}

#myTable tr {
    /* Add a bottom border to all table rows */
    border-bottom: 1px solid #ddd; 
}

#myTable tr.header, #myTable tr:hover {
    /* Add a grey background color to the table header and on hover */
    background-color: #f1f1f1;
}
</style>
</head> 
<body>
<?php 
	$nav->header1();
?>
	<div class="container">
	<h1>View Staff</h1>
	<hr>
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for staff name">
	<table id="myTable" class="table table-striped">
        <thead>
            <tr class="header">
                <th onclick="sortTable(0)">Staff ID</th>
                <th onclick="sortTable(1)">Full Name</th>
                <th onclick="sortTable(2)">Contact No.</th>
                <th onclick="sortTable(3)">Email</th>
				<th onclick="sortTable(4)">Address</th>
				<th onclick="sortTable(5)">State</th>
				<th onclick="sortTable(6)">City</th>
				<th onclick="sortTable(7)">Post Code</th>
				<th></th>
				<th></th>
            </tr>
        </thead>
        <tbody>
			<?php
				while($row = mysqli_fetch_assoc($result3))
				{?>
					<tr>
						<td><?php echo $row['staff_id']?></td>
						<td style="text-transform : capitalize"><?php echo $row['staff_name']?></td>
						<td><?php echo $row['staff_contact']?></td>
						<td><?php echo $row['staff_email']?></td>
						<td style="text-transform : capitalize"><?php echo $row['staff_address']?></td>
						<td style="text-transform : capitalize"><?php echo $row['staff_state']?></td>
						<td style="text-transform : capitalize"><?php echo $row['staff_city']?></td>
						<td><?php echo $row['staff_postcode']?></td>
						<td><a href="edit_staff.php?sid=<?php echo $row['staff_id']; ?>">Edit</a></td>
						<td><a href="view_staff.php?sid=<?php echo $row['staff_id']; ?>" onclick="return confirmation();">Delete</a></td>
					</tr><?php
				}?>
        </tbody>
    </table>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
	
	<p style="text-align : center;">
<?php
	$sql = "SELECT * FROM staff"; 
	$rs_result = mysqli_query($conn, $sql); //run the query
	$total_records = mysqli_num_rows($rs_result);  //count number of records
	$total_pages = ceil($total_records / $num_rec_per_page); 

	echo "<a href='view_staff.php?page=1'>".'|<'."</a> "; // Goto 1st page  

	for ($i=1; $i<=$total_pages; $i++) { 
				echo "<a href='view_staff.php?page=".$i."'>".$i."</a> "; 
	}; 
	echo "<a href='view_staff.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
?>
</p>

	<a href="javascript:history.go(-1)"><input type="button" class="btn btn-default" value="Back"></a>
	<hr>
</body>
</html>