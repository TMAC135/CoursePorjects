
	<div id='add'>
		<h2>Add New User</h2>

		<form action='admin.php' method='POST'>
			<!-- hiden input -->
			<input type='hidden' name='action' value='add_user'>

			<!-- name text -->
			<label>Name:</label>
			<input type='text' name='add_name' required><br>

			<!-- login text -->
			<br>
			<label>Login:</label>
			<input type='text' name='add_login' required><br>

			<!-- password text -->
			<br>
			<label>Password:</label>
			<input type='text' name='add_password' required><br>

			<!-- add button -->
			<br>
			<input type='submit' name='add_button' value='Add User' >
		</form>
	</div>


</body>
</html>