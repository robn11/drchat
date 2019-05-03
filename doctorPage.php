<?php 
include('config.php');

$drId = get('id');

$doctorResults = getDoctorsOfficeAndUserInfo(1, $drId, $database);
if (!empty($doctorResults)) {
    $doctorResult = $doctorResults[0];
}
?>

<div class="container">
	<div class="mainContent">
    <?php if (!empty($doctorResults)) : ?>
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Information: Dr. <?php echo $doctorResult['name']; ?></h1>
                <p class="lead">This is this doctors profile and user information.</p>
			</div>
		</div>
		<ul class="list-group margin-top10">
            <li class="list-group-item"><strong>Username:</strong> <?php echo $doctorResult['username']; ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo $doctorResult['email']; ?></li>
            <li class="list-group-item"><strong>Phone:</strong> <?php echo $doctorResult['phone']; ?></li>
            <li class="list-group-item"><strong>Address:</strong> <?php echo $doctorResult['address']. ", " . $doctorResult['city']; ?></li>
            <li class="list-group-item"><strong>Zip:</strong> <?php echo $doctorResult['zip']; ?></li>
        </ul>
		<ul class="list-group margin-top10">
            <li class="list-group-item"><strong>Office Name: </strong> <?php echo $doctorResult['officeName']; ?></li>
            <li class="list-group-item"><strong>Office Type:</strong> <?php echo $doctorResult['officeType']; ?></li>
            <li class="list-group-item"><strong>Office Address:</strong> <?php echo $doctorResult['officeAddress'] . ", " . $doctorResult['officeCity']; ?></li>
            <li class="list-group-item"><strong>Office Zip:</strong> <?php echo $doctorResult['officeZip']; ?></li>
            <li class="list-group-item"><strong>Office Phone:</strong> <?php echo $doctorResult['officePhone']; ?></li>
            <li class="list-group-item"><strong>Patients:</strong> <?php echo $doctorResult['patients']; ?></li>
        </ul>
    <?php else : ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">This Doctor has not entered any Office information yet.</h1>
                <p class="lead">Please see previous page for this doctor's personal info.</p>
            </div>
        </div>
    <?php endif; ?>
	</div>
</div>