<?php

function searchAccounts($accountType, $term, $database) {
    // Get list of users/doctors
	$term = $term . '%';
	$sql = get_sql('getAccounts');
	$params = array(
        'term' => $term,
        'account' => $accountType
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function get($key) {
	if(isset($_GET[$key])) {
		return $_GET[$key];
	}
	
	else {
		return '';
	}
}

function post ($key) {
    if (isset($_POST[$key])) {
        return clean($_POST[$key]);
    }
    
    else {
        return '';
    }
}

function get_sql($sqlName) {
    return file_get_contents("sql/$sqlName.sql");
}

function setAlert($type, $message) {
    //accepted types 
        // - success (green)
        // - warning (yellow)
        // - danger   (red)
        // - info (light gray)
    $_SESSION['alert'][] = array(
        'type' => $type,
        'message' => $message
    );
}

function getAlert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'][0];
		$_SESSION['alert'] = null;
        return $alert;
    } else {
        return false;
    }
}

function getDoctorsOfficeInfo($drId, $database) {
    $sql = get_sql('getDoctorsInfo');
    $params = array("doctorid"=>$drId);
    $statement = $database->prepare($sql);
    $statement->execute($params);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getDoctorsOfficeAndUserInfo($accountType, $drId, $database) {
    $sql = get_sql('getDoctorsOfficeAndUserInfo');
    $params = array(
        "doctorid"=>$drId,
        "accountType"=>$accountType
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getNursesSchoolandUserInfo($accountType, $nurseId, $database) {
    $sql = get_sql('getNursesSchoolAndUserInfo');
    $params = array(
        "nurseid"=>$nurseId,
        "accountType"=>$accountType
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function sendMessage($fromid, $toid, $message, $database) {

    $tz = 'America/New_York';
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
    $dt->setTimestamp($timestamp); //adjust the object to correct timestamp

    $sql = get_sql('sendMessage');
    $params = array(
        "fromid"=>$fromid,
        "toid"=>$toid,
        "messageBody"=>$message,
        "messageSentDate"=>$dt->format('Y-m-d H:i:s')
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
}

function getMessages($userId, $database) {
    $sql = get_sql('getMessagesByUserId');
    $params = array("userId"=>$userId);
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function getMessageBody($messageid, $database) {
    $sql = get_sql('getMessageBody');
    $params =array("messageid"=>$messageid);
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $results[0];
}