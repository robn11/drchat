<?php
include('config.php');

$messages = getMessages($user->customerid, $database);

?>
<div class="container">
	<div class="mainContent">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">Messages</h1>
			</div>
		</div>
        <a class="btn btn-success" href="newMessage.php?id=<?php echo $user->customerid; ?>">New Message</a>
		<ul class="list-group margin-top10">
        <?php for ($i=0; $i<sizeof($messages); $i++) : ?>
            <?php $time = strtotime($messages[$i]['messageSentDate']); $date = date('m/j/Y, g:i',$time); ?>
            <li class="list-group-item">
                <p><strong>From: </strong><?php echo $messages[$i]['name']; ?></p>
                <p><strong>Message Sent On: </strong><?php echo $date; ?></p>
                <p><strong>Message Content: </strong><?php echo $messages[$i]['messageBody']; ?></p>
                <a class="btn btn-primary btn-sm" href="newMessage.php?action=reply&id=<?php echo $messages[$i]['messageid']; ?>&username=<?php echo $messages[$i]['username']; ?>">Reply</a>
            </li>
            <?php endfor; ?>
        </ul>
	</div>
</div>