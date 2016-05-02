<?php
$con= mysqli_connect('egon.cs.umn.edu','S16CS4131U107','14782','S16CS4131U107','3307');
//try to connect the mysql in my local machine, but failed
// $con= mysqli_connect('localhost','root','6567333','test1');

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table - log_table for the HW8
$sql="CREATE TABLE log_table(acc_id INT NOT NULL AUTO_INCREMENT,
      acc_name VARCHAR(20),
      acc_login VARCHAR(20),
      acc_password VARCHAR(50), 
      PRIMARY KEY (acc_id));";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "<h1> Table log_table created successfully </h1>";
  }
else
  {
  echo "<h1> Error creating table: <h1>" . mysqli_error($con);
  }

mysqli_close($con);

?> 
