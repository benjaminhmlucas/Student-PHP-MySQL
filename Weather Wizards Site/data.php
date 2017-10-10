<?php 
	
	$page_title = 'Climate Data For All Cities';
	include ('includes/header.html'); 
	require ('mysqli_connect.php'); // Connect to the db.
	
	echo'<h1 class="dataHeader">Climate Data For All Cities</h1>';//page header
	$display = 15;
	
	// Determine how many pages there are...

	if (isset($_GET['p']) && is_numeric($_GET['p'])) 
	{ // Already been determined.
		$pages = $_GET['p'];
	} else { // Need to determine.
	 	// Count the number of records:
		$q = "SELECT COUNT(city) FROM city_stats";
		$r = @mysqli_query ($dbc, $q);
		$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
		$records = $row[0];
		// Calculate the number of pages...
		if ($records > $display) { // More than 1 page.
			$pages = ceil ($records/$display);
		} else {
			$pages = 1;
		}
	} // End of p IF.
	
	// Determine where in the database to start returning results...
	if (isset($_GET['s']) && is_numeric($_GET['s'])) 
	{
		$start = $_GET['s'];
	} else {
		$start = 0;
	}

	// Determine the sort...
	// Default is by city.
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'cty';

	// Determine the sorting order:
	switch ($sort) 
	{
		case 'cty':
			$order_by = 'city ASC';
			break;
		case 'ste':
			$order_by = 'state ASC';
			break;
		case 'rh':
			$order_by = 'record_high ASC';
			break;
		case 'rl':
			$order_by = 'record_low ASC';
			break;
		case 'dClr':
			$order_by = 'days_clear ASC';
			break;
		case 'dCldy':
			$order_by = 'days_cloudy ASC';
			break;
		case 'dWthPrcp':
			$order_by = 'days_with_precip ASC';
			break;
		case 'dWthSnw':
			$order_by = 'days_with_snow ASC';
			break;
		default:
			$order_by = 'city ASC';
			$sort = 'cty';
			break;
	}

	$query = "SELECT * FROM city_stats ORDER BY $order_by LIMIT $start, $display";//get city_stats table data	
	$queryResult = @mysqli_query ($dbc, $query); // Run the query.
	
	$numOfResult = mysqli_num_rows($queryResult);//get city_stats table total number of rows

	if($numOfResult > 0)
	{
		//creates table headers
		echo '<table class="weatherstats">			
		<tr>
			<th align="left"><b><a href="data.php?sort=cty">City</a></b></th>
			<th align="left"><b><a href="data.php?sort=ste">State</a></b></th>
			<th align="left"><b><a href="data.php?sort=rh">High</a></b></th>
			<th align="left"><b><a href="data.php?sort=rl">Low</a></b></th>
			<th align="left"><b><a href="data.php?sort=dClr">Days Clear</a></b></th>
			<th align="left"><b><a href="data.php?sort=dCldy">Days Cloudy</a></b></th>
			<th align="left"><b><a href="data.php?sort=dWthPrcp">Days With Precipitation</a></b></th>
			<th align="left"><b><a href="data.php?sort=dWthSnw">Days With Snow</a></b></th>			
		</tr>';
		
		// Fetch and print all the records....
 		$bg = '#dddddd'; 
		while ($row = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) 		
		{	 
			$bg = ($bg=='#dddddd' ? '#ffffff' : '#dddddd');
			echo '<tr bgcolor="' . $bg . '">
			<td>' . $row['city'] . '</td>
			<td>' . $row['state'] . '</td>
			<td class="datNum">' . $row['record_high'] . '</td>
			<td class="datNum">' . $row['record_low'] . '</td>
			<td class="datNum">' . $row['days_clear'] . '</td>
			<td class="datNum">' . $row['days_cloudy'] . '</td>
			<td class="datNum">' . $row['days_with_precip'] . '</td>
			<td class="datNum">' . $row['days_with_snow'] . '</td></tr>';
		} // End of WHILE loop.
		echo '</table>';
		mysqli_free_result ($queryResult);
		mysqli_close($dbc);

		// Make the links to other pages, if necessary.
		if ($pages > 1) {
			
			echo '<br /><p>';
			$current_page = ($start/$display) + 1;
			
			// If it's not the first page, make a Previous button:
			if ($current_page != 1) {
				echo '<a href="data.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
			}
			
			// Make all the numbered pages:
			for ($i = 1; $i <= $pages; $i++) {
				if ($i != $current_page) {
					echo '<a href="data.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
				} else {
					echo $i . ' ';
				}
			} // End of FOR loop.
			
			// If it's not the last page, make a Next button:
			if ($current_page != $pages) {
				echo '<a href="data.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
			}
			
			echo '</p>'; // Close the paragraph.
			
		} // End of links section.

	}	
		
	else 
	{
		echo "<p>There are currently no cities in the database.</p></br>";
	}
	
	include ('includes/footer.html');//footer
?>