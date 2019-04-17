<?php

function searchBooks($term, $database) {
	// Get list of books
	$term = $term . '%';
	$sql = file_get_contents('sql/getBooks.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$books = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $books;
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