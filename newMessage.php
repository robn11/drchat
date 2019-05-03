<?php 
include('config.php');

if (isset($_GET['action'])) {
    $action = get('action');
    $id = get('id');
    $username = get('username');

    $messageBody = getMessageBody($id, $database);

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($action) && $action == "reply") {
        $fromid = $user->customerid;
        $recipient = $_POST['recipient'];
        $message = $_POST['message-body'];

        $sql = get_sql('getUserIdByUsername');
        $params = array("username"=>$recipient);
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $userId = $results[0]['customerid'];

        sendMessage($fromid, $userId, $message, $database);
        header('location: messages.php');
        die();
    }
    else {
        $fromid = $user->customerid;
        $recipient = $_POST['recipient'];
        $message = $_POST['message-body'];
        
        $sql = get_sql('getUserIdByUsername');
        $params = array("username"=>$recipient);
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $userId = $results[0]['customerid'];
        
        sendMessage($fromid, $userId, $message, $database);

        header('location: messages.php');
        die();
    }
}

?>

<div class="container">
    <div class="mainContent">
        <div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">New Message</h1>
			</div>
	    </div>

        <?php if (isset($messageBody)) : ?>
            <p><strong>Original Message: </strong><?php echo $messageBody['messageBody']; ?></p>
        <?php endif; ?>
        <form action="" method="post" class="margin-top10">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">To:</span>
                </div>
                <input type="text" class="form-control" name="recipient" value="<?php if (isset($username)) { echo $username; }?>" placeholder="Enter Recipient's Username">
            </div>
            <div class="input-group mb-3">
                <textarea class="form-control" name="message-body" placeholder="Enter message here" maxlength="300"></textarea>
                <div class="input-group-append">
                    <input class="btn btn-primary" type="submit" value="Send">
                </div>
            </div>
        </form>
    </div>
</div>