<?php
include('config.php');

if (isset($doctorInfo->drId)) {
	$doctorResults = $doctorInfo->getDoctorInfo($database);
}
elseif (isset($nurseInfo->nurseId)) {
	$nurseResults = $nurseInfo->getNurseInfo($database);
}
?>

<div class="container">
	<div class="mainContent">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<?php if ($user->isDR == 0) : ?>
					<h1 class="display-4">Profile: <?php echo $user->data['name']; ?></h1>
				<?php else : ?>
					<h1 class="display-4">Profile: Dr. <?php echo $user->data['name']; ?></h1>
				<?php endif; ?>
				</div>
		</div>
        <a href="editProfile.php" class="btn btn-success">Edit Profile</a>
		<ul class="list-group margin-top10">
            <li class="list-group-item"><strong>Username:</strong> <?php echo $user->data['username']; ?></li>
            <li class="list-group-item"><strong>Name:</strong> <?php echo $user->data['name']; ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo $user->data['email']; ?></li>
            <li class="list-group-item"><strong>Phone:</strong> <?php echo $user->data['phone']; ?></li>
            <li class="list-group-item"><strong>Address:</strong> <?php echo $user->data['address']. ", " . $user->data['city']; ?></li>
            <li class="list-group-item"><strong>Zip:</strong> <?php echo $user->data['zip']; ?></li>
        </ul>
		<?php if (isset($doctorInfo->drId)) : ?>
			<a href="doctorInfo.php?action=update" class="btn btn-success margin-top10">Edit Office Information</a>
			<ul class="list-group margin-top10">
        	    <li class="list-group-item"><strong>Office Name: </strong> <?php echo $doctorResults['officeName']; ?></li>
        	    <li class="list-group-item"><strong>Office Type:</strong> <?php echo $doctorResults['officeType']; ?></li>
        	    <li class="list-group-item"><strong>Office Address:</strong> <?php echo $doctorResults['officeAddress'] . ", " . $doctorResults['officeCity']; ?></li>
        	    <li class="list-group-item"><strong>Office Zip:</strong> <?php echo $doctorResults['officeZip']; ?></li>
        	    <li class="list-group-item"><strong>Office Phone:</strong> <?php echo $doctorResults['officePhone']; ?></li>
        	    <li class="list-group-item"><strong>Patients:</strong> <?php echo $doctorResults['patients']; ?></li>
        	</ul>
		<?php elseif (isset($nurseInfo->nurseId)) : ?>
			<a href="userInfo.php?action=update" class="btn btn-success margin-top10">Edit School Information</a>
			<ul class="list-group margin-top10">
        	    <li class="list-group-item"><strong>School Name: </strong> <?php echo $nurseResults['schoolName']; ?></li>
        	    <li class="list-group-item"><strong>School Type:</strong> <?php echo $nurseResults['schoolType']; ?></li>
        	    <li class="list-group-item"><strong>School Address:</strong> <?php echo $nurseResults['schoolAddress'] . ", " . $nurseResults['schoolCity']; ?></li>
        	    <li class="list-group-item"><strong>School Zip:</strong> <?php echo $nurseResults['schoolZip']; ?></li>
        	    <li class="list-group-item"><strong>School Phone:</strong> <?php echo $nurseResults['schoolPhone']; ?></li>
        	    <li class="list-group-item"><strong>Students:</strong> <?php echo $nurseResults['students']; ?></li>
        	</ul>
		<?php endif; ?>
	</div>
</div>