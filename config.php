<?php
$apiKey = '09120bf043c041de8cbcee365f929d09';
// Connecting to the MySQL database
$user = 'newberryr3';
$password = 'geKeva2e';

$database = new PDO('mysql:host=csweb.hh.nku.edu:3306;dbname=db_spring19_newberryr3', $user, $password);
$database->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

//Autoloader
function class_autoloader($class) {
    include('classes/class.' . $class . '.php');
}

spl_autoload_register('class_autoloader');

// Start the session
session_start();
include('functions.php');
$current_url = basename($_SERVER['REQUEST_URI']);

$acceptableURLs = array("login.php", "register.php");
// if customerID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION['user']) && !in_array($current_url, $acceptableURLs)) {
    header('location: login.php');
    die();
}
// Else if session key customerID is set get $customer from the database
elseif (isset($_SESSION['user'])){
    $user = new User($_SESSION['user']['username'], $database);
    if ($user->isDR == 0) {
        $nurseInfo = new NurseInfo($user->customerid, $database);
    }
    else {
        $doctorInfo = new DoctorInfo($user->customerid);
    }
}
?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <title>Final Project</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="js/site.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <nav class="navbar navbar-light navbar-expand" id="navbar">
        <a class="navbar-brand" href="index.php">DRchat</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (isset($user->isDR)) : ?>
                    <?php if ($user->isDR == 0) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="doctors.php">Doctors</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Nurses</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <?php if (isset($user->customerid)) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          User: <?php echo $user->data['username']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <div class="dropdown-divider"></div>
                            <?php if ($user->isDR == 0) : ?>
                                <a class="dropdown-item" href="userInfo.php">Fill out your information</a>
                            <?php else : ?>
                                <a class="dropdown-item" href="doctorInfo.php">Fill out your information</a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
        <?php if (isset($user->customerid)) : ?>
            <a class="btn btn-danger" href="logout.php">Logout</a>
        <?php else : ?>
            <a class="btn btn-success" href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</body>
</html>