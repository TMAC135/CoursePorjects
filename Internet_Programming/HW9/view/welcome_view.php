<html>
<head>
	<title>This is admin page</title>
	<style type="text/css">
		/*three main divs*/
		#welcome{
			background-color: aliceblue;
			width: 650px;
			/*height:100px;*/s

			margin-bottom: 15px;
		}
		#list{
			margin-bottom: 15px;
			background-color: aliceblue;
			width: 650px;

		}
		#add{
			background-color: aliceblue;
			width: 650px;
			height: 200px;
		}

		/*weclome text in the frist div*/
		#welcome_text{
			font-size: 20px;
			font-weight: bold;
		}

		/*message in the second div*/
		#list_message{
			color:red;
		}

		/*table in the second div*/
		#list_table{
			background-color: LightBlue;
			text-align: center;
		}
	</style>
</head>

<body>
	<div id='welcome'>
		<!-- welcome -->
		<p id='welcome_text'>Welcome 	<?php session_start();
			if( empty($_SESSION['login']) || empty($_SESSION['password']) || empty($_SESSION['name']))
			{
				header('Location:login.php');
				exit();
			}else{
				echo $_SESSION['name'];
			}
			?>
		</p>
		<!-- log out -->
		<a href="logout.php">log out</a>
		<a href='CalendarInput.php'>Input</a>
		<a href='MyCalendar.php'>Calendar</a>
		<br>
		<!-- label -->
		<label>
			This page is protected from public, you can list all users defined in the database.
		</label>
	</div>

