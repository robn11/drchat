<?php

// Create and include a configuration file with the database connection
include('config.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get username and password from the form as variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Query records that have usernames and passwords that match those in the customers table
	$sql = file_get_contents('sql/attemptLogin.sql');
	$params = array("username" => $username, "password" => $password);
	print_r($params);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	// If $users is not empty
	if(!empty($users)) {
		// Set $user equal to the first result of $users
		$user = $users[0];
		// Set a session variable with a key of customerID equal to the customerID returned
		$_SESSION['user']['customerid'] = $user['customerid'];
		// Redirect to the index.php file
		header('location: index.php');
		die();
	}
}

?>
<html>
<body>
	<div class="container">
		<div class="row">
			<div class="col-6">
				<h1>Login</h1>
				<form method="POST" action="">
				<div class="form-group">
					<input required type="text" class="form-control" name="username" placeholder="Username" />
				</div>
				<div class="form-group">
					<input required type="password" class="form-control" name="password" placeholder="Password" />
				</div>
					<input type="submit" class="btn btn-primary" value="Log In" />
				</form>
			</div>
		</div>
	</div>
</body>
</html>