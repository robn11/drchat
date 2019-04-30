<?php
include('config.php');
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
	</div>
</div>