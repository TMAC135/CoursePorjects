
	<div id='list'>
		<h2> List of Users</h2>
		<div id='list_message'>
			<?php 
				if(isset($list_message)){
					echo $list_message;
				}
			?>
		</div>

		<table id='list_table' border="1">
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Login</td>
				<td>New Password</td>
				<td>Action</td>
			</tr>

			<!-- contends of the table -->
			<?php 
				if ($users->num_rows > 0) {
			    // output data of each row
			    while($row = $users->fetch_assoc()) {
			        //echo "id: " . $row["acc_id"]. " - Name: " . $row["acc_name"]. "login " . $row["acc_login"]. "<br>";

			        echo "<tr>";
			        echo "<td>".$row['acc_id']."</td>";
			        echo "<td>".$row['acc_name']."</td>";
			        echo "<td>".$row['acc_login']."</td>";

			        echo  "<td></td>";//hide the password for every user
			        // echo "<td>".$row['acc_password']."</td>";

			        //two buttons for the user
			        echo "				<td>
			        <form action='admin.php' method='GET'>
			        <input type='hidden' name='action' value='edit_user'>
			        <input type='hidden' name='edit_id' value=".$row['acc_id'].">
			        <input type='submit' value='Edit'>
			        </form>
					<form action='admin.php' method='GET'>
						<input type='hidden' name='action' value='delete_user'>
						<input type='hidden' name='delete_id' value=".$row['acc_id'].">
						<input type='submit' value='Delete'> 
					</form>
					</td>";
					echo "</tr>";
			    }
			}
			?>



		</table>

	</div>

