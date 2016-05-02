For this assignment, the main scripts are following:
— admin.php: controller of this assignment
— model
	— connectDB.php: connect the MYSQL database
	— user_db.php: data base operations for users for login.
— view
	— welcome_view.php: first div of the view, contains welcome information
	— list_view.php: list the contends of data in the database in the second div.
	— edit_view.php: edit mode of table in the second div
	— add_view.php: third div of the view, contains a form for adding new user.

—other files: login.php, logout.php, MyCalendar.php, CalendarInput.php and other php files are from HW8, and some images are from HW5.

Notice that in this assignment:

1: I only consider validation for login, if login we create is  existing in our database, I regard it as failure operation.Otherwise, it is valid operation.

2: Validation for login is case sensitive, or simply speaking, ‘aa’ is not the same as ‘Aa’.
		