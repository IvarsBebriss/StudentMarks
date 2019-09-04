<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ltpc_pv";
$db_charset = "utf8mb4";
$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$db_charset", $username, $password);


function savepost($post){
	try {

	    global $conn;
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // prepare sql and bind parameters
	    $stmt = $conn->prepare("INSERT INTO `studenti` (`vards`, `uzvards`, `epasts`, `grupa`)
	    VALUES (:vards, :uzvards, :epasts, :grupa)");

	    // varianti
	    //$stmt = $conn->prepare("UPDATE `personas` SET `vards`='Juris' WHERE `id`= 5");
	    //$stmt = $conn->prepere("DELETE FROM `personas` WHERE `id`=4");

	    $stmt->bindParam(':vards', $post['vards']);
	    $stmt->bindParam(':uzvards', $post['uzvards']);
	    $stmt->bindParam(':epasts', $post['epasts']);
	    $stmt->bindParam(':grupa', $post['grupa']);

	    // insert a row
	    $stmt->execute();
		
		$_SESSION['message']='<div class="alert alert-success">Studenta dati pievienoti</div>';
	    header('location: index.php');
		exit;
	}

	catch(PDOException $e) {
	    die("Connection failed: " . $e->getMessage());
	}
}

function getdata(){
	global $conn;
	$sql = "SELECT * FROM `studenti` order by `uzvards` asc, `vards` asc ";
	//return $conn->query($sql);
	$results = $conn->prepare($sql);
	$results->execute();

	if ($results->rowCount() > 0) {
		return $results;
	} else {
		return false;
	}
}

function getstudent($id){
	global $conn;
	$sql = "SELECT * FROM `studenti` WHERE `id_stud`=".$id;
	$results = $conn->query($sql);
	foreach($results as $result){
		return $result;
	}
	return null;
}

function updatepost($post){
	try {

	    global $conn;
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // prepare sql and bind parameters
	    $stmt = $conn->prepare("UPDATE `studenti` SET `vards`=:vards, `uzvards`=:uzvards, `epasts`=:epasts, `grupa`=:grupa WHERE `id_stud`=:id");

	    // varianti
	    //$stmt = $conn->prepare("UPDATE `personas` SET `vards`='Juris' WHERE `id`= 5");
	    //$stmt = $conn->prepere("DELETE FROM `personas` WHERE `id`=4");

	    $stmt->bindParam(':vards', $post['vards']);
	    $stmt->bindParam(':uzvards', $post['uzvards']);
	    $stmt->bindParam(':epasts', $post['epasts']);
	    $stmt->bindParam(':grupa', $post['grupa']);
		$stmt->bindParam(':id', $post['id']);

	    // insert a row
	    $stmt->execute();
		
		$_SESSION['message']='<div class="alert alert-success">Studenta dati atjaunoti veiksmīgi</div>';
	    header('Location: index.php');

	}

	catch(PDOException $e) {
	    die("Connection failed: " . $e->getMessage());
	}
}

function validateemail($email){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return false;
	}
	return true;	
}


function dzesdatus($id){
	try {

	    global $conn;
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // prepare sql and bind parameters
	    $stmt = $conn->prepare("DELETE FROM `studenti` WHERE `id_stud`=:id");

	    // varianti
	    //$stmt = $conn->prepare("UPDATE `personas` SET `vards`='Juris' WHERE `id`= 5");
	    //$stmt = $conn->prepere("DELETE FROM `personas` WHERE `id`=4");

		$stmt->bindParam(':id', $id);

	    // insert a row
	    $stmt->execute();
		
		$_SESSION['message'] = '<div class="alert alert-success">Studenta dati ir dzēsti</div>';

		header('location:index.php');
		exit;
  
	}

	catch(PDOException $e) {
	    die("Connection failed: " . $e->getMessage());
	}
}

function getMarks($id){
	global $conn;
	$sql = "SELECT * FROM `atzimes` WHERE `id_stud`=".$id;
	$results = $conn->query($sql);
	
	foreach($results as $result){
		return $result;
	}
	return null;
}

function validateMarks($post){
	if($post['pd1']>=0 &&$post['pd1']<=10){
		if($post['pd2']>=0 &&$post['pd2']<=10){
			if($post['pd3']>=0 &&$post['pd3']<=10){
				if($post['ieskaite']>=0 &&$post['ieskaite']<=10){
					return true;
				}
			}		
		}
	}
	
	return false;
}

function saveMarks($post){
	try {

	    global $conn;
	    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//should the data be updated or saved?
		// prepare sql and bind parameters
		if (getMarks($post['id'])){
			$stmt = $conn->prepare("UPDATE `atzimes` SET `pd1`=:pd1, `pd2`=:pd2, `pd3`=:pd3, `iesk`=:ieskaite WHERE `id_stud`= :id");
		} else {
			$stmt = $conn->prepare("INSERT INTO `atzimes` (`id_stud`,`pd1`, `pd2`, `pd3`, `iesk`)
	    VALUES (:id, :pd1, :pd2, :pd3, :ieskaite)");
		}
	    
		$stmt->bindParam(':pd1', $post['pd1']);
	    $stmt->bindParam(':pd2', $post['pd2']);
	    $stmt->bindParam(':pd3', $post['pd3']);
	    $stmt->bindParam(':ieskaite', $post['ieskaite']);
		$stmt->bindParam(':id', $post['id']);

	    // insert a row
	    $stmt->execute();

	    $_SESSION['message'] = '<div class="alert alert-success">Studenta atzīmes ir ievadītas</div>';

		header('location: index.php');

	}

	catch(PDOException $e) {
	    die("Connection failed: " . $e->getMessage());
	}
}
