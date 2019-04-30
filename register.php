<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {          
        $userID = User::createNewUser($_POST['username'], $_POST['password'], $database);
        $authenticated = User::authenticate($_POST['username'], $_POST['password'], $database);
        
        if($authenticated) {
            $user = new User($_POST['username'], $database);
            $_SESSION['user']['username'] = $user->username;

            if(isset($_POST['isDR'])) {
                $isDR = 1;
            }
            else{
                $isDR = 0;
            }
            $user
                ->set('username', $_POST['username'])
                ->set('name',$_POST['name'])
                ->set('email', $_POST['email'])
                ->set('phone', $_POST['phone'])
                ->set('address', $_POST['address'])
                ->set('city', $_POST['city'])
                ->set('zip', $_POST['zip'])
                ->set('isDR',$isDR)
                ->save($database);
            $user->refreshSession($user->username, $database);
            header('location: index.php');
            die();
        }
        else {
            die("User was not authenticated");
        }
    }
}
?>

<script>
$(function() {
    $('.datepicker').datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: "-70:-16",
    maxDate: "-16Y",
    showButtonPanel: true,
    showAnim: "slideDown",
    dateFormat: 'yy-mm-dd'
    });
});
</script>

<div class="container">
    <h1>Register</h1>
    <hr>
    <form action="" method="post" class="registerForm">
        <h5>Username:</h5>
        <div class="form-group">
            <input type="text" class="form-control " name="username" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
        <h5 class="margin-top10">Password:</h5>
        <div class="form-group">
            <input type="password" class="form-control" name="password" aria-label="Password" aria-describedby="basic-addon1" required>
        </div>
        <h5 class="margin-top10">Name:</h5>
        <div class="form-group">
            <input type="text" class="form-control " name="name" aria-label="name" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group">
            <h5 class="margin-top10">Email</h5>
            <input type="email" class="form-control" name="email" aria-label="email" aria-describedby="basic-addon1" placeholder="example@email.com" required>
        </div>
        <div class="form-group">
            <h5 class="margin-top10">Phone</h5>
            <input type="tel" class="form-control" name="phone" aria-label="phone" aria-describedby="basic-addon1" placeholder="(XXX)XXX-XXXX" required>
        <div class="form-group">
            <h5 class="margin-top10">Street Address</h5>
            <input type="text" class="form-control" name="address" aria-label="address" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group">
            <h5 class="margin-top10">City</h5>
            <input type="text" class="form-control" name="city" aria-label="city" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group">
            <h5>Zip Code</h5>
            <input type="text" class="form-control" name="zip" aria-label="zip" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group checkbox">
            <label>
                <input type="checkbox" name="isDR" value="isDR"> 
                I am a Licensed Doctor. If you are not, do no select.
            </label>
        </div>
            <input type="submit" class="btn btn-success margin-top10 register" value="Register">
        </div>
    </form>
    <p class="text-muted">Already have an account? Login<a href="login.php"> Here</a></p>
</div>