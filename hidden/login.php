<?php


session_start();

include "conn.php";

if(!isset($_POST['usr'])){
	header("Location: ../login.php");
	exit;
} else {
	
	$usr = mysqli_real_escape_string($conn, ($_POST['usr']));
	$nme = mysqli_real_escape_string($conn, ($_POST['nme']));
	$pwd = mysqli_real_escape_string($conn, ($_POST['pwd']));
	$eml = mysqli_real_escape_string($conn, ($_POST['eml']));
	$sql = "SELECT * FROM usr WHERE usr='$usr' OR eml='$usr'";
	$sql = mysqli_query($conn, $sql);
	$check = mysqli_num_rows($sql);
	if($check > 0){
		while($row = mysqli_fetch_assoc($sql)){
			if(password_verify($pwd, $row['pwd'])){
				$_SESSION['usr'] = $usr;
				$_SESSION['nme'] = $nme;
				$_SESSION['eml'] = $eml;
				$_SESSION['id'] = $row['id'];
				header("Location: ../login.php?say=verified");
				exit;
			}else{
				header("Location: ../login.php?say=match");
				exit;
			}
		}
	}else{
		header("Location: ../login.php?say=none");
		exit;
	}
}