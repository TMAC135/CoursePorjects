
<!--PHP part for the login-->

<?php
// Start the session
session_start();

if( isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['name']))
{
	header('Location:MyCalendar.php');
	exit();
}

$login = '';
$error = '';


if( !empty($_POST['login']) ){
	
	$login = trim($_POST['login']);
	if($login == '') $error .= 'please input valid username <br>';
	
	$password = trim($_POST['password']); 
	if($password == '')  $error .= 'please input valid password';
	

	
	//set the session variables
	if($error == ''){
		include_once('databaseHW8S16.php'); //only access once for multiple calls
		// echo 'hahha';
		
		$conn = new mysqli($db_servername,$db_username,$db_password,$db_name,$db_port);
		if($conn -> connect_error){
			die("Connection failed: " . $conn->connect_error);
			$error .= 'Mysql error'.$conn->connect_error.'<br>';
		}else{
			//$sql_query = 'SELECT * FROM log_table WHERE acc_login=\'Smitty\'';
			$sql_query = 'SELECT * FROM log_table WHERE acc_login=\''.$login.'\' LIMIT 1;';//import!
			$result = $conn->query($sql_query);

			//for debug
			// $_SESSION['login']='peter';
			// $_SESSION['password'] ='11';
			// $_SESSION['name'] = '23';
			// header('Location:MyCalendar.php');
			// exit();
		}
	// var_dump($result);	
	// var_dump($result->num_rows);

	if($result -> num_rows == 1){
		if($row = $result->fetch_assoc()){
			// echo $row['acc_login'];
			// echo $row['acc_password'];
			$hashed_password = $row['acc_password'];
			
			if(sha1($password) == $hashed_password )
			{
				$_SESSION['login']=$row['acc_login'];
				$_SESSION['password']=$row['acc_password'];
				$_SESSION['name']=$row['acc_name'];

				// echo $_SESSION['login'];

				header('Location:MyCalendar.php');
				// exit();
			}else
			{
				$error = 'The password is not correct';
			}
		}
	}else{
		$error = 'The username is not exist';
	}
	$conn->close();


	}	
}


?>
	
<!--HTML part for the form-->
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>This is the login page</title>
		<!--embedded css-->
		<style> 
		#error{
			color: red;
			font-size: large;
		}
		.label{
			font-size:medium;
		}
		#main{
			background-color: aliceblue;
			width: 400px;
			height: 270px;
		}	
		</style>
	</head>
	<body>
		<div id="main">
		<h1>Login Page</h1>
		<!--this is the error information-->
		<div id='error'>
			<?php echo $error; ?>				
		</div>
		<p>Please enter your user's login name and password,both are case sensitive</p>
		<!--form-->
		<form method="post" action="login.php">
			<label class='label'>Login:   </label>
			<input type="text" name="login" value="" /><br>
				<br>
			<label class='label'>Password:   </label>
			<input type="password" name="password" value="" /><br>
				<br>
			<input type="submit" value="Submit" />
		</form>

	

		</div>
	</body>
</html>

