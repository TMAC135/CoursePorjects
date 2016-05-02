<?php
error_reporting(E_ALL); 
ini_set( 'display_errors','1'); 
$con= mysqli_connect('egon.cs.umn.edu','S16CS4131U107','14782','S16CS4131U107','3307');
// Check connection
if (mysqli_connect_errno())
  {
  echo 'Failed to connect to MySQL:' . mysqli_connect_error();
  }
echo sha1('JS123');
echo sha1('JJ456');

$str1 = "JS123";
$str2 = "JJ456";

mysqli_query($con,"INSERT INTO log_table (acc_name, acc_login, acc_password) VALUES ('Jim Smith', 'Smitty', '". sha1($str1)."');");
mysqli_query($con,"INSERT INTO log_table (acc_name, acc_login, acc_password) VALUES ('Jane Jones', 'JJones', '". sha1($str2)."');");
// This line is the user information I add
$str3 = "tianx253";
mysqli_query($con,"INSERT INTO log_table (acc_name, acc_login, acc_password) VALUES ('Ran Tian', 'tianx253', '". sha1($str3)."');");


mysqli_close($con);


echo '<h1> Successfully Inserted Values into the Table </h1>'
?> 
