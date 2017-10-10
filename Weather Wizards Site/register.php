<?php 
	$page_title = 'Weather Wizards Registration';
	include ('includes/header.html');
	
	//sets interests[] to an empty array so sticky checkboxes don't have errors when no checkboxes are selected
	if(!isset($_POST['interests'])) { $_POST['interests'] = array(); }
	
	//Checks named fields for input. Displays error message if nothing is present
	if(isset($_POST['submit']))
	{
		if(empty($_POST['childName']))		
		{
			echo "<p class='error'>You forgot to enter your <b>name</b>.</p>";
		}
		if(empty($_POST['parentName']))		
		{
			echo "<p class='error'>You forgot to enter your <b>parent or guardian’s name</b>.</p>";
		}
		if(empty($_POST['email']))		
		{
			echo "<p class='error'>You forgot to enter your <b>parent or guardian’s email</b>.</p>";
		}
		if(empty($_POST['phone']))		
		{
			echo "<p class='error'>You forgot to enter your <b>parent or guardian’s phone</b>.</p>";
		}
		if(empty($_POST['member']))		
		{
			echo "<p class='error'>You forgot to enter your <b>membership status</b>.</p>";
		}
		//Checks all named fields above simultaneously and prints an error me3ssag if one is empty. 
		if(empty($_POST['childName']) || empty($_POST['parentName']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['member']))
		{
			echo "<p>Weather Wizard, we need your name and your parent or guardian's name, email, phone and<br> your membership status to send information about our workshops. Enter required information<br> and click the Register button again.</p><br>";
		}
		//If all required fields are entered positive confitrmation message appears 
		else
		{
			//checks to see if 'city' was entered, displays messages depending on choice
			if(isset($_POST['city']))
			{	
				switch($_POST['city'])
				{
					case 'idk': 
					print "<br>Not sure of the nearest location? We will send you an email to keep in touch!<br><br>";
					break;
					case 'cha':
					print "<br>You are nearest to our Charleston SC location, the Holy City! Go River Dogs!<br><br>";
					break;
					case 'sum':
					print "<br>You are nearest to our Summerville SC location, the Birthplace of Sweet Tea! Refreshing!<br><br>";
					break;
					case 'mtp':
					print "<br>You are nearest to our Mt. Pleasant, SC location that has a historical and beachy vibe!<br><br>";
					break;							
				}
			}
			//Checks memeber status and displays specific message for each choice
			if(isset($_POST['member']))
			{
				switch($_POST['member'])
				{
					case '1':
						print "Welcome back, " . $_POST['childName'] . ".  Thank you for being a member of Weather Wizards.<br><br>";
						break;
					case '2':
						print $_POST['childName'] . ", we hope you'll join Weather Wizards. We have more fun than a jar full of lightning bugs!<br><br>";
						break;
					case '3':
						print $_POST['childName'] . ", welcome to Weather Wizards where the forecast is always a 99% chance of fun!<br><br>";
						break;				
				}
			}
			//Checks for interests then lists choices 
			
			
			if(!empty($_POST['interests']))
			{
				
				print "You have chosen the following workshops:<br><br><ul>";
				foreach($_POST['interests'] as $value) 
				{
					echo "<li>" . $value . "</li>";
				}
				print "</ul>";
			}
			//displays if no choices were made in interests
			else
			{
				print "You have not chosen a workshop, but we add new workshops all the time. We'll keep you updated by e-mail.<br><br></ul>";
			}					
		} //<-----------End of else
	}	
?>
	
<br><h2>Weather Wizards Workshops</h2><br>

<h3>We host weather wizards workshops throughout the year for kids from 6-12.</h3><br>

<h3>Please not that the following workshops are free to memebers:</h3><br>
<ul>
	<li>Make a Rain Gauge</li>
	<li>Make a Thermometer</li>
</ul><br>

<!--input form-->	
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<fieldset><legend><i><b>Register Your Interests</b></i></legend>
		<input type="checkbox" name="interests[]" value="Make a Rain Gauge" <?php if(in_array("Make a Rain Gauge", $_POST['interests'])) echo ' checked="checked"'; ?>>Make a Rain Gauge<br>
		<input type="checkbox" name="interests[]" value="Make a Themometer" <?php if(in_array("Make a Themometer", $_POST['interests'])) echo ' checked="checked"'; ?>>Make a Themometer<br>
		<input type="checkbox" name="interests[]" value="Make a Windsock" <?php if(in_array("Make a Windsock", $_POST['interests'])) echo ' checked="checked"'; ?>>Make a Windsock<br>
		<input type="checkbox" name="interests[]" value="Make Lightning In Your Mouth!" <?php if(in_array("Make Lightning In Your Mouth!", $_POST['interests'])) echo ' checked="checked"'; ?>>Make Lightning In Your Mouth!<br>
		<input type="checkbox" name="interests[]" value="Make a Hydrometer" <?php if(in_array("Make a Hydrometer", $_POST['interests'])) echo ' checked="checked"'; ?>>Make a Hydrometer<br><br>
		Your name:<br>
		<input type="text" name="childName" value="<?php if(isset($_POST['childName'])) echo ($_POST['childName']); ?>"><br><br>
		Your parent or gaurdians name:<br>
		<input type="text" name="parentName" value="<?php if(isset($_POST['parentName'])) echo ($_POST['parentName']); ?>"><br><br>
		Your parent or gaurdians email:<br>
		<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo ($_POST['email']); ?>"><br><br>
		Your parent or gaurdians phone:<br>
		<input type="text" name="phone" value="<?php if(isset($_POST['phone'])) echo ($_POST['phone']); ?>"><br><br>
		Your closest center: 
		<select name="city"> 
			<option value="idk" <?php if(isset($_POST['city']) && ($_POST['city']) == "idk") echo ' selected="selected"'; ?>>Choose One
			<option value="cha" <?php if(isset($_POST['city']) && ($_POST['city']) == "cha") echo ' selected="selected"'; ?>>Charleston
			<option value="sum" <?php if(isset($_POST['city']) && ($_POST['city']) == "sum") echo ' selected="selected"'; ?>>Summerville
			<option value="mtp" <?php if(isset($_POST['city']) && ($_POST['city']) == "mtp") echo ' selected="selected"'; ?>>Mt. Pleasant
		</select><br>
		Are you a Member: 
		<input type="radio" name="member" value=1<?php if(isset($_POST['member']) && ($_POST['member']) == "1") echo ' checked="checked"'; ?>> Yes
		<input type="radio" name="member" value=2<?php if(isset($_POST['member']) && ($_POST['member']) == "2") echo ' checked="checked"'; ?>> No
		<input type="radio" name="member" value=3<?php if(isset($_POST['member']) && ($_POST['member']) == "3") echo ' checked="checked"'; ?>> Sign Me Up!<br><br>
		<input class="button" type="submit" name="submit" value="Register">
		<!--<input class="button" type="reset" value="Reset">-->
	</fieldset>
<img id="pic1" src="pics/wiz.jpg" alt="wizard">
</form>


<?php	
	include ('includes/footer.html');
?>