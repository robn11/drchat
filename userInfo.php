<?php
include('config.php');
$action = get('action');
if ($action == ''){
    $action = "insert";
}
if ($action == "update") {
	$nurseResults = $nurseInfo->getNurseInfo($database);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST)) {          
        $nurseInfo
            ->set('nurseid', $user->customerid)
            ->set('schoolName',$_POST['schoolName'])
            ->set('schoolType', $_POST['schoolType'])
            ->set('schoolAddress', $_POST['schoolAddress'])
            ->set('schoolZip', $_POST['schoolZip'])
            ->set('schoolCity', $_POST['schoolCity'])
            ->set('schoolPhone', $_POST['schoolPhone'])
            ->set('students',$_POST['students'])
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
            <h5 class="margin-top10">School Name:</h5>
            <div class="form-group">
                <input type="text" class="form-control" name="schoolName" <?php if ($action == "update") : ?> value="<?php echo $nurseResults['schoolName']; ?>" <?php endif; ?> aria-label="SchoolName" aria-describedby="basic-addon1" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">School Type</h5>
                <input type="text" class="form-control" name="schoolType" <?php if ($action == "update") : ?> value="<?php echo $nurseResults['schoolType']; ?>" <?php endif; ?> placeholder="i.e. High School, Elementary" aria-label="SchoolType" aria-describedby="basic-addon1" placeholder="example@email.com" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">School Address</h5>
                <input type="text" class="form-control" name="schoolAddress" <?php if ($action == "update") : ?> value="<?php echo $nurseResults['schoolAddress']; ?>" <?php endif; ?> aria-label="SchoolAddress" aria-describedby="basic-addon1" required>
            <div class="form-group">
                <h5 class="margin-top10">School City</h5>
                <input type="text" class="form-control" name="schoolCity" <?php if ($action == "update") : ?> value="<?php echo $nurseResults['schoolCity']; ?>" <?php endif; ?> aria-label="SchoolCity" aria-describedby="basic-addon1" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">School Zip</h5>
                <input type="text" class="form-control" name="schoolZip" <?php if ($action == "update") : ?> value="<?php echo $nurseResults['schoolZip']; ?>" <?php endif; ?> aria-label="SchoolZip" aria-describedby="basic-addon1" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">School Phone</h5>
                <input type="tel" class="form-control" name="schoolPhone" <?php if ($action == "update") : ?> value="<?php echo $nurseResults['schoolPhone']; ?>" <?php endif; ?> aria-label="SchoolPhone" aria-describedby="basic-addon1" placeholder="(XXX)XXX-XXXX" required>
            </div>
            <div class="form-group">
                <h5 class="margin-top10">How many students do you have?</h5>
                <input type="number" class="form-control" name="students" <?php if ($action == "update") : ?> value="<?php echo $nurseResults['students']; ?>" <?php endif; ?> aria-label="students" aria-describedby="basic-addon1" required>
            </div>
            <input type="submit" class="btn btn-success margin-top10 register" value="Save">
        </form>
    </div>
</div>