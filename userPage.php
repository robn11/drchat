<?php 
include('config.php');

$nurseId = get('id');

$nurseResults = getNursesSchoolAndUserInfo(0, $nurseId, $database);
if (!empty($nurseResults)) {
    $nurseResult = $nurseResults[0];
}
?>

<div class="container">
	<div class="mainContent">
    <?php if (!empty($nurseResults)) : ?>
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Information: <?php echo $nurseResult['name']; ?></h1>
                <p class="lead">This is this nurses profile and user information.</p>
			</div>
		</div>
		<ul class="list-group margin-top10">
            <li class="list-group-item"><strong>Username:</strong> <?php echo $nurseResult['username']; ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo $nurseResult['email']; ?></li>
            <li class="list-group-item"><strong>Phone:</strong> <?php echo $nurseResult['phone']; ?></li>
            <li class="list-group-item"><strong>Address:</strong> <?php echo $nurseResult['address']. ", " . $nurseResult['city']; ?></li>
            <li class="list-group-item"><strong>Zip:</strong> <?php echo $nurseResult['zip']; ?></li>
        </ul>
		<ul class="list-group margin-top10">
            <li class="list-group-item"><strong>School Name: </strong> <?php echo $nurseResult['schoolName']; ?></li>
            <li class="list-group-item"><strong>School Type:</strong> <?php echo $nurseResult['schoolType']; ?></li>
            <li class="list-group-item"><strong>School Address:</strong> <?php echo $nurseResult['schoolAddress'] . ", " . $nurseResult['schoolCity']; ?></li>
            <li class="list-group-item"><strong>School Zip:</strong> <?php echo $nurseResult['schoolZip']; ?></li>
            <li class="list-group-item"><strong>School Phone:</strong> <?php echo $nurseResult['schoolPhone']; ?></li>
            <li class="list-group-item"><strong>Students:</strong> <?php echo $nurseResult['students']; ?></li>
        </ul>
    <?php else : ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">This Nurse has not entered any School information yet.</h1>
                <p class="lead">Please see previous page for this nurse's personal info.</p>
            </div>
        </div>
    <?php endif; ?>
	</div>
</div>