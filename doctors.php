<?php
include('config.php');

$accounts = searchAccounts(1, get('searchTerm'), $database);

?>
<div class="d-flex container">
	<div class="mainContent">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Doctors In Your Area</h1>
				<p class="lead">This page allows you to find doctors in your area.</p>
			</div>
		</div>
        <form method="GET">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Search" aria-label="searchTerm" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-md">
			        <input class="btn btn-primary" type="submit" />
                </div>
            </div>
		</form>
		<ul class="list-group margin-top10">
            <?php foreach($accounts as $key=>$value) : ?>
            <li class="list-group-item"><strong>Dr. <?php echo $value['name']; ?></strong> | Username: <?php echo $value['username']; ?> Email: <?php echo $value['email']; ?> Phone: <?php echo $value['phone']; ?>
                <a class="btn btn-primary btn-sm justify-content-end" href="doctorPage.php?id=<?php echo $value['customerid']; ?>">Doctor's Page</a>
            </li>
            <?php endforeach; ?>
        </ul>
	</div>
</div>