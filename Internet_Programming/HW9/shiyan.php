<?php
// echo 'this is admin page';
ini_set('display_errors','1');
error_reporting(E_ALL);

require('./model/user_db.php');

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


//调试插入一条
// mysqli_query($db,"INSERT INTO log_table (acc_name, acc_login, acc_password) VALUES ('Ran Tian', 'tianx253', '". sha1('tianx253')."');");
// $query = "INSERT INTO log_table (acc_name, acc_login, acc_password) VALUES ('Jane Jones', 'JJones', '". sha1('haha')."');";
// $db->query($query);

//测试删除一条记录
// $query = "DELETE FROM log_table WHERE acc_id='10'";
// $db->query($query);

//测试update
// update_user('33','hha','mmmmmm','dd');

$s = '23';
echo "hello '$s' ";

$t = true;
echo $t;

$query = "SELECT * FROM log_table";
$users = $db->query($query);
// var_dump($users);
// var_dump($users->fetch());
// if ($users->num_rows > 0) {
//     // output data of each row
//     while($row = $users->fetch_assoc()) {
//         echo "id: " . $row["acc_id"]. " - Name: " . $row["acc_name"]. "login " . $row["acc_login"]. "<br>";
//     }
// }


				if ($users->num_rows > 0) {
			    // output data of each row
			    while($row = $users->fetch_assoc()) {
			        //echo "id: " . $row["acc_id"]. " - Name: " . $row["acc_name"]. "login " . $row["acc_login"]. "<br>";

			        echo "<tr>";
			        echo "<td>".$row['acc_id']."</td>";
			        echo "<td>".$row['acc_name']."</td>";
			        echo "<td>".$row['acc_login']."</td>";
			        echo "<td>".$row['acc_password']."</td>";
			        echo "				<td>
					<input type='submit' value='Edit'>
					<input type='submit' value='Delete'> 
					</td>";
					echo "</tr>";
			    }
			}

// var_dump('expression');

// // var_dump(isset($_POST['action']));
// if(isset($_POST['action']))
// {
// 	var_dump($_POST['add_name']);
// 	var_dump($_POST['add_login']);
// }

			
?>

