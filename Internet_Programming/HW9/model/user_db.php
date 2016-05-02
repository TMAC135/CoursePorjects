<?php
function get_users()
{
	global $db;
	$query = "SELECT * FROM log_table";
	return $db->query($query);
}

function get_row($id)
{
	global $db;
	$query = "SELECT * FROM log_table WHERE acc_id='".$id."'";
	$row = $db->query($query);
	$row = $row->fetch();
	return $row;
}

function add_user($name,$login,$password)
{
	global $db;
	$hash_password = sha1($password);
	$query = "INSERT INTO log_table(acc_name, acc_login, acc_password) VALUES ('$name', '$login', '$hash_password');";
	$db->query($query);
	// mysqli_query($db,$query);
}

function delete_user($id)
{
	global $db;
	$query = "DELETE FROM log_table WHERE acc_id='$id'";
	$db->query($query);
}

function update_user($edit_id,$new_name,$new_login,$new_password)
{
	global $db;
	$query="UPDATE log_table SET acc_name='$new_name',acc_login='$new_login', acc_password='$new_password' WHERE acc_id='$edit_id';";
	$db->query($query);
}
?>