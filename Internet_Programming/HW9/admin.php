<?php
// echo 'this is admin page';
ini_set('display_errors','1');
error_reporting(E_ALL);

//include './model/connectDB.php';
if (!isset($db))
{
	$db = mysqli_connect('egon.cs.umn.edu','S16CS4131U107','14782','S16CS4131U107','3307');
	// Check connection
	if (mysqli_connect_errno())
	{
	echo 'Failed to connect to MySQL:' . mysqli_connect_error();
	exit(1);
	}
	// else{
 //        echo 'connect successfully';
 //    }
}

require('./model/user_db.php');

// include the welcome div
include './view/welcome_view.php';


// Set the action for different views
if(!isset($action))
{
	if(isset($_POST['action'])){ //post method corresponds to the third part of the div
		$action=$_POST['action'];
	}else if(isset($_GET['action'])){
		$action=$_GET['action'];
	}else{
		$action='list_user';
	}
}
//handle different actions 
if($action == 'list_user')
{
	$users = get_users();
	include './view/list_view.php';
}else if($action == 'add_user')
{
	//get strings for name, password and login for the new user
	$add_name = $_POST['add_name'];
	$add_password = $_POST['add_password'];
	$add_login = $_POST['add_login'];

	//judge of the input are valid
	if(trim($add_name) == '' || trim($add_name) == '' || trim($add_name) == '' ){
		$list_message = 'please input valid input in the Add User Block ';		
	}else{
		$list_message='add user successfully';
		add_user($add_name,$add_login,$add_password);
	}

	$users = get_users();
	$action = 'list_user';
	include './view/list_view.php';

}else if($action == 'delete_user')
{
	$delete_id = $_GET['delete_id'];
	delete_user($delete_id);

	$users = get_users();
	$list_message='delete one user successfully';
	$action = 'list_user';
	include './view/list_view.php';
}else if($action == 'edit_user')
{
	$edit_id = $_GET['edit_id'];
	$users = get_users();
	include './view/edit_view.php';
}else if($action == 'show_change')
{
	$new_id = $_POST['edit_id'];
	$new_name = $_POST['edit_name'];
	$new_login = $_POST['edit_login'];
	$new_password = $_POST['edit_password'];

	if(trim($new_name) == '' || trim($new_password) == '' || trim($new_login) == ''){
		$list_message='fail to edit, please input valid modifications when editing';
	}else{
		//for debugging
		// var_dump($new_id);
		// var_dump($new_name);
		update_user($new_id,$new_name,$new_login,$new_password);
		$list_message='update user information successfully';
	}

	$action='list_user';
	$users = get_users();
	include './view/list_view.php';
}

// include the add user div
include './view/add_view.php';


?>