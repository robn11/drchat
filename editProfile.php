<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST)) {          

        $user
            ->set('username', $user->username)
            ->set('name',$_POST['name'])
            ->set('email', $_POST['email'])
            ->set('phone', $_POST['phone'])
            ->set('address', $_POST['address'])
            ->set('city', $_POST['city'])
            ->set('zip', $_POST['zip'])
            ->set('isDR',$user->data['isDR'])
            ->save($database);
        $user->refreshSession($user->username, $database);
        header('location: profile.php');
        die();
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
    <h1>Edit Profile</h1>
    <hr>
    <form action="" method="post" class="profileEditForm">
        <h5 class="margin-top10">Name:</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?php echo $user->data['name']; ?>" aria-label="name" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group">
            <h5 class="margin-top10">Email</h5>
            <input type="email" class="form-control" name="email" value="<?php echo $user->data['email']; ?>" aria-label="email" aria-describedby="basic-addon1" placeholder="example@email.com" required>
        </div>
        <div class="form-group">
            <h5 class="margin-top10">Phone</h5>
            <input type="tel" class="form-control" name="phone" value="<?php echo $user->data['phone']; ?>" aria-label="phone" aria-describedby="basic-addon1" placeholder="(XXX)XXX-XXXX" required>
        <div class="form-group">
            <h5 class="margin-top10">Street Address</h5>
            <input type="text" class="form-control" name="address" value="<?php echo $user->data['address']; ?>" aria-label="address" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group">
            <h5 class="margin-top10">City</h5>
            <input type="text" class="form-control" name="city" value="<?php echo $user->data['city']; ?>" aria-label="city" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group">
            <h5>Zip Code</h5>
            <input type="text" class="form-control" name="zip" value="<?php echo $user->data['zip']; ?>" aria-label="zip" aria-describedby="basic-addon1" required>
        </div>
        <input type="submit" class="btn btn-success margin-top10 register" value="Save">
    </form>
</div>