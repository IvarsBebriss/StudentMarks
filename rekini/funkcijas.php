<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ltpc_pv";
$db_charset = "utf8mb4";
$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$db_charset", $username, $password);

function saveData($table, $parameters, $redirect=''){
	try {
		if ($redirect == '') {
			$redirect = $table . '.php';
		}
	    global $conn;
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // prepare sql and bind parameters
		$sql = "INSERT INTO `".$table."` (";
		foreach($parameters as $key => $value){
			$sql.= "`".$key."`, ";
		}
		
		$sql = rtrim($sql, ', ') . ") VALUES (";
		
		foreach($parameters as $key => $value){
			$sql.= ":".$key.", ";
		}
		
		$sql = rtrim($sql, ', ') . ")";
		
	    $stmt = $conn->prepare($sql);

	    // insert a row
	    $stmt->execute($parameters);
		
		$_SESSION['message']='<div class="alert alert-success">Dati pievienoti</div>';
	    header('location: '.$redirect);
		exit;
	}

	catch(PDOException $e) {
	    die("Connection failed: " . $e->getMessage());
	}
}

function getData($table,$sort='id'){
	global $conn;
	$sql = "SELECT * FROM `".$table."` order by `".$sort."` asc";
	$results = $conn->prepare($sql);
	$results->execute();

	if ($results->rowCount() > 0) {
		return $results->fetchAll();
	} else {
		return false;
	}
}

function getDataById($table,$id){
	global $conn;
	$sql = "SELECT * FROM `".$table."` where id=".$id;
	$results = $conn->prepare($sql);
	$results->execute();

	foreach($results as $result){
		return $result;
	}
	
	return false;
}

function updateId($table,$parameters, $id, $redirect=''){
	try {
		if ($redirect == '') {
			$redirect = $table. '.php';
		}
	    global $conn;
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // prepare sql and bind parameters
		$sql = "UPDATE `".$table."` SET ";
		foreach($parameters as $key => $value){
			$sql.= "`".$key."`=:".$key.", ";
		}
		
		$sql = rtrim($sql, ', ') . " WHERE `id`=".$id;
		
	    $stmt = $conn->prepare($sql);

	    // insert a row
	    $stmt->execute($parameters);
		
		$_SESSION['message']='<div class="alert alert-success">Dati nomainīti</div>';
	    header('location: '.$redirect);
		exit;
	}

	catch(PDOException $e) {
	    die("Connection failed: " . $e->getMessage());
	}
}

function deleteId($table, $id, $redirect = ''){
	try {
		if ($redirect == '') {
			$redirect = $table. '.php';
		}
	    global $conn;
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // prepare sql and bind parameters
	    $stmt = $conn->prepare("DELETE FROM `".$table."` WHERE `id`=:id");

	    // varianti
	    //$stmt = $conn->prepare("UPDATE `personas` SET `vards`='Juris' WHERE `id`= 5");
	    //$stmt = $conn->prepere("DELETE FROM `personas` WHERE `id`=4");
		$stmt->bindParam(':id', $id);

	    // insert a row
	    $stmt->execute();
		
		$_SESSION['message'] = '<div class="alert alert-success">Dati ir dzēsti</div>';

		header('location: '.$redirect);
		exit;
  
	}

	catch(PDOException $e) {
	    die("Connection failed: " . $e->getMessage());
	}
}

function getItems($id){
	global $conn;
	$sql = "SELECT * FROM `invoices_items` WHERE invoice_id=".$id;
	$results = $conn->prepare($sql);
	$results->execute();

	if ($results->rowCount() > 0) {
		return $results->fetchAll();
	} else {
		return false;
	}
}