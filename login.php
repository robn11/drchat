<?php

// Create and include a configuration file with the database connection
include('config.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get username and password from the form as variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$loginMessage = '';

    //if login attempted
    if (isset($_POST['username']) && isset($_POST['password'])) {          
		$authResult = User::authenticate($username, $password, $database);
        if ($authResult) {
			// Set a session variable with a key of customerID equal to the customerID returned
			$_SESSION['user']['username'] = $username;
			// Redirect to the index.php file
			header('location: index.php');
			die();
        } elseif ($authResult == false) {
            $loginMessage = 'Sorry, wrong username/password. Try again.';
        }
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