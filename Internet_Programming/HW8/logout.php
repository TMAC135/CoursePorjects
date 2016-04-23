
<?php
session_start();
if( isset($_SESSION['login']) && isset($_SESSION['password']))
{
	// remove all session variables
	session_unset();
	$info ='You have log out successfully';
}else
{
	// go back to the login page when the user visit the logout page directly
	$info ='You are not log in yet, Please log in first before you log out';
}
//we will sleep 5 seconds before we go back to the log in page
echo '<h1>'.$info.'</h1>';
echo 'You will be directed to the login page in 5 seconds';
header( "Refresh: 5; url=login.php" );

?>

