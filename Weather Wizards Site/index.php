<?php 
	function create_ad()
	{
		echo "<p class=\"ad\">Don’t forget to <a href=\"register.php\">Register</a> to become a Weather Wizard!</p>";
	}
	$page_title = 'Welcome To The Weather Wizards Site!';
	include ('includes/header.html'); 
	create_ad();
?>
	
<h1>Weather Wizards</h1>
			
<p>Welcome to the Weather Wizards website for budding meteorologists in the South Carolina Lowcountry area.</p>

<p>Our website is flooded with information about local weather, workshops, and more. So check back often.</p>

<?php
	create_ad();
	include ('includes/footer.html');
?>
	
