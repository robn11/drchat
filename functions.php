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