 <?php 
	$page_title = 'Heat Index';
	include ('includes/header.html'); 
?>

<h1>Heat Index</h1>
<p>In the Summer, when people say "It’s not the heat, it’s the humidity", what do they mean? There are 2 factors that make a hot day feel really hot. The first is the air temperature and the second is relative humidity. After taking measurements for temperature and relative humidity, we can calculate a heat index that is called our “feels like” temperature.</p>
<p>HI means Heat Index (the “Feels Like” Temperature).</p>
<p>T means the air temperature (This  formula works when temperatures are in the range of 80 to 112).</p>
<p>RH means relative humidity (This  formula works when relative humidity is in the range of 13 to 85)</p><br>
<?php	
	// Checks to see if $temp and $relHumidity are set
	if(isset($_POST['temp']) && isset($_POST['relHumidity']))
		{ 
			//checks to see if variables are set to proper ranges
			if($_POST['temp'] >= 80 && $_POST['temp'] <= 112 && $_POST['relHumidity'] >= 13 && $_POST['relHumidity'] <= 85 && is_numeric($_POST['temp']) && is_numeric($_POST['relHumidity']))
			{				
				$temp = $_POST['temp'];
				$relHumidity = $_POST['relHumidity'];
				
				//calculates relative humidity	
				$heatIndex = -42.379 + 2.04901523*$temp + 10.14333127*$relHumidity - .22475541*$temp*$relHumidity - .00683783*$temp*$temp - .05481717*$relHumidity*$relHumidity + .00122874*$temp*$temp*$relHumidity + .00085282*$temp*$relHumidity*$relHumidity - .00000199*$temp*$temp*$relHumidity*$relHumidity;

				//print heat Index
				print "<p class=\"error\">The Heat Index Is " . $heatIndex . "</p>";
				print "<p>Please inpupt more data to calculate another heat index.</p><br><br>";
				
			}

			else
			{
				echo "<p class='error'>The temperature should be a number between 80 and 112.<br>
					The humidity should be a number between 13 and 85.<br> 
					Please try again.</p><br>";
			}
			
		}			
?>
<!--input form-->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<fieldset name="tempInfo">
		<legend>Get The Heat Index</legend>		
		<label>Temperature(F):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<input type="text" name="temp" value=""><br>		
		<label>Relative Humidity(%): </label>
		<input name="relHumidity" value=""><br>		
		<input class="submit" type="submit" value="Gimme The Heat Index">
	</fieldset>
<img id="pic2" src="pics/flameswater.png" alt="flames water">
</form> 	

<p>If you need to take the temperature, but don't have a Thermometer, then see our Weather Workshops to find a workshop on <a href="workshops.php">How to make a Thermometer</a>. </p>
<p>If you need to measure the relative humidity, but don't have a Hygrometer. Don't worry, we have a Weather Workshops that shows you <a href="workshops.php">How to make a Hygrometer too</a>!</p>
<p>You can go to the website for those other guys <a href="http://weather.com">The Weather Channel</a> to get these measurements, but taking measurements from them isn't as much fun as doing it yourself.</p>

<?php
	include ('includes/footer.html');
?>