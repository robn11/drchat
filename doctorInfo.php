<?php
include('config.php');
$action = get('action');
if ($action ==''){
    $action = "insert";
}
if ($action == "update") {
    $doctorResults = $doctorInfo->getDoctorInfo($database);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST)) {          

        $doctorInfo
            ->set('doctorid', $user->customerid)
            ->set('officeName',$_POST['officeName'])
            ->set('officeType', $_POST['officeType'])
            ->set('officeAddress', $_POST['officeAddress'])
            ->set('officeZip', $_POST['officeZip'])
            ->set('officeCity', $_POST['officeCity'])
            ->set('officePhone', $_POST['officePhone'])
            ->set('patients',$_POST['patients'])
            ->save($database, $action);
        header('location: profile.php');
        die();
    }
}
?>

<div class="container">
    <div class="mainContent">
        <h1>Fill Out Your Information</h1>
        <hr>
        <form action="" method="post" class="profileEditForm">
            <h5 class="margin-top10">Office Name:</h5>
            <div class="form-group">
                <input type="text" class="form-control" name="officeName" <?php if ($action == "update") : ?> value="<?php echo $doctorResults['officeName']; ?>" <?php endif; ?> aria-label="officeName" aria-describedby="basic-addon1" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">Office Type</h5>
                <input type="text" class="form-control" name="officeType" <?php if ($action == "update") : ?> value="<?php echo $doctorResults['officeType']; ?>" <?php endif; ?> placeholder="i.e. Hospital, Practice" aria-label="officeType" aria-describedby="basic-addon1" placeholder="example@email.com" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">Office Address</h5>
                <input type="text" class="form-control" name="officeAddress" <?php if ($action == "update") : ?> value="<?php echo $doctorResults['officeAddress']; ?>" <?php endif; ?> aria-label="officeAddress" aria-describedby="basic-addon1" required>
            <div class="form-group">
                <h5 class="margin-top10">Office City</h5>
                <input type="text" class="form-control" name="officeCity" <?php if ($action == "update") : ?> value="<?php echo $doctorResults['officeCity']; ?>" <?php endif; ?> aria-label="officeCity" aria-describedby="basic-addon1" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">Office Zip</h5>
                <input type="text" class="form-control" name="officeZip" <?php if ($action == "update") : ?> value="<?php echo $doctorResults['officeZip']; ?>" <?php endif; ?> aria-label="officeZip" aria-describedby="basic-addon1" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">Office Phone</h5>
                <input type="tel" class="form-control" name="officePhone" <?php if ($action == "update") : ?> value="<?php echo $doctorResults['officePhone']; ?>" <?php endif; ?> aria-label="officePhone" aria-describedby="basic-addon1" placeholder="(XXX)XXX-XXXX" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">How many patients do you have on average?</h5>
                <input type="number" class="form-control" name="patients" <?php if ($action == "update") : ?> value="<?php echo $doctorResults['patients']; ?>" <?php endif; ?> aria-label="patients" aria-describedby="basic-addon1" required>
            </div>
            <input type="submit" class="btn btn-success margin-top10 register" value="Save">
        </form>
    </div>
</div>