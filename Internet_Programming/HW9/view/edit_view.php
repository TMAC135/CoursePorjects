
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
				// global $edit_id;
				// echo $delete_id;		
				if ($users->num_rows > 0) {
			    // output data of each row
			    while($row = $users->fetch_assoc()) {
			        //echo "id: " . $row["acc_id"]. " - Name: " . $row["acc_name"]. "login " . $row["acc_login"]. "<br>";
			    	if($row['acc_id'] != $edit_id){
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
					}else{
						echo "<tr>";
						echo "<form action='admin.php' method='POST'>
								<input type='hidden' name='action' value='show_change'>
								<input type='hidden' name='edit_id' value=".$edit_id.">
								<td>".$row['acc_id']."</td>
								<td><input type='text' name='edit_name' required></td>
								<td><input type='text' name='edit_login' required></td>
								<td><input type='text' name='edit_password' required></td>
								<td>
								<input type='submit' value='Update'>
								<a href='admin.php?action=list_user'><button>Cancel</button></a>
								</td>
							</form>";

						echo "</tr>";
					}

			    }
			}
			?>


		</table>

	</div>

