<?php


session_start();

include "conn.php";

if(!isset($_POST['eml'])){
	header("Location: ../login.php");
	exit;
} else {
	
	$usr = mysqli_real_escape_string($conn, ($_POST['usr']));
	$nme = mysqli_real_escape_string($conn, ($_POST['nme']));
	$pwd = mysqli_real_escape_string($conn, ($_POST['pwd']));
	$cnfrmpwd = mysqli_real_escape_string($conn, ($_POST['cnfrmpwd']));
	$eml = mysqli_real_escape_string($conn, ($_POST['eml']));
	
	if(empty($usr) || empty($pwd) || empty($cnfrmpwd) || empty($eml) || empty($nme)){
		header("Location: ../register.php?empty");
		exit;
	}
	
	if (!filter_var($eml, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../register.php?say=email");
		exit;
	} elseif(!preg_match("/^[a-zA-Z ]*$/",$nme)){
		header("Location: ../register.php?say=name");
		exit;
	} elseif($pwd != $cnfrmpwd){
		header("Location: ../register.php?say=pwd");
		exit;
	} else {
		$sql = "SELECT * FROM usr WHERE usr='$usr' OR eml='$eml'";
		$sql = mysqli_query($conn, $sql);
		$check = mysqli_num_rows($sql);
		if($check > 0){
			header("Location: ../register.php?say=used");
			exit;
		}
		$pwd = password_hash($pwd, PASSWORD_DEFAULT);
		$sql = "INSERT INTO usr (usr, nme, pwd, eml) VALUES ('$usr', '$nme', '$pwd', '$eml')";
		$sql = mysqli_query($conn, $sql);
		header("Location: ../login.php?say=done");
		exit;
	}
}