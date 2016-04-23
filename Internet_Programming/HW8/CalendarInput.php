
<!-- PHP part -->
<?php

session_start();
if( !isset($_SESSION['login']) || !isset($_SESSION['password']))
{
	header('Location:login.php');
	exit();
}

?>



<!DOCTYPE html>
<!-- My calender -->
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ran Tian's Input Page</title>
		<link rel="stylesheet" type="text/css" href="AdRotator.css" />

		<!-- add the jquery outer link -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

		<style>
		/*style for the up right part*/
		#user{
			position: absolute;
			left:1100px;
			top:10px;
			background-color: aquamarine;
		}
		#userName{
			font-size: larger ;
			font-weight: bold;
		}
		</style>
	</head>
	<body>
		<!-- up right div for the user information -->
		<div id="user">
			<label id="userName"> Welcome <?php echo $_SESSION['name']?></label><br><br>
			<a id="logout" href="logout.php" >Logout</a>
		</div>


		<!-- head tille -->
		<div>
			<h1>Calendar Input</h1>
		</div>
		<div class="ToolBar">
			<nav>
				<a href="MyCalendar.php">Calendar</a>
				<a href="CalendarInput.php">Input</a>
			</nav>
		</div>
		<!--div for the ad rotation part-->
		<div class = "adRotator">
			<!--previous button-->
			<div class="adButton"><img src="prev_blue.png" id="prevOrange" onmouseover="showOrangeButton(1)"
				onmouseout="deleteOrangeButton(1)" /></div>
			<!--image banner-->
			<div class="banner">
				<img id="adPicture" src="oscar.jpg" onclick="showURL()" onmouseover="showAdToolKit()"
				  onmouseout="deleteAdToolKit()" />
			</div>
			<!--next button-->
			<div class="adButton"><img src="next_blue.png" id="nextOrange" onmouseover="showOrangeButton(2)"
				onmouseout="deleteOrangeButton(2)" /></div>
			<!--bullet buttons-->
			<div id="bulletButtonDiv">
				<img src="bullet_blue.png" class="bulletButton" id="bulletButton1" onclick="bulletButton(0)"
						onmouseover="mouseOverEvent(1)" onmouseout="mouseOverOut(1)" />
				<img src="bullet_gray.png" class="bulletButton" id="bulletButton2" onclick="bulletButton(1)"
						onmouseover="mouseOverEvent(2)" onmouseout="mouseOverOut(2)"/>
				<img src="bullet_gray.png" class="bulletButton" id="bulletButton3" onclick="bulletButton(2)"
						onmouseover="mouseOverEvent(3)" onmouseout="mouseOverOut(3)"/>
			</div>
		</div>
			
		<!--div for the input forms-->
		<div class = "form">
			<form method="post" action="MyCalendar.php">
				<!-- hidden inouts which are not shown in the browser -->
				<input type="hidden" name="email" value="tianx253@umn.edu" >
				<input type="hidden" name="redirect" value="www.google.com">
					<!-- event name -->
					<label class="label">Event Name:</label>
					<input type="text" required class="input">
				<br>
					<!-- start time -->
					<label class="label">Start Time:</label>
					<input type="text" required class="input">
				<br>
					<!-- end time -->
					<label class="label">End Time:</label>
					<input type="text" required class="input">
				<br>
					<!-- location -->
					<label class="label">Location:</label>
					<input type="text" required class="input">
				<br>
					<!-- submit button -->
				<p>
					<label>
						<input type="submit" name="Submit" >
					</label>
					<label>
						<input type="reset" name="Reset">
					</label>
				</p>
			</form>
		</div>
		
		<!-- Test browser -->
		<p class="italic">*This pasge is tested in Google Chrome</p>

	</body>
	<!-- the outer javascript file -->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
	<script type='text/javascript' src="AdRotator.js"></script>

</html>