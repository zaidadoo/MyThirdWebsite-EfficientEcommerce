<?php


session_start();

include "conn.php";

if(!isset($_POST['area'])){
	header("Location: ../login.php");
	exit;
} else {
	
	$city = mysqli_real_escape_string($conn, ($_POST['city']));
	$area = mysqli_real_escape_string($conn, ($_POST['area']));
	$street = mysqli_real_escape_string($conn, ($_POST['street']));
	$building = mysqli_real_escape_string($conn, ($_POST['building']));
	$phone = mysqli_real_escape_string($conn, ($_POST['phone']));
	$id = $_SESSION['id'];
	
	if(empty($city) || empty($area) || empty($street) || empty($building) || empty($phone)){
		header("Location: ../address.php?empty");
		exit;
	}
	$sql = "SELECT * FROM address WHERE id='$id'";
	$sql = mysqli_query($conn, $sql);
	if(mysqli_num_rows($sql) > 0){
		$sql = "UPDATE address SET city='$city', area='$area', street='$street', building='$building', phone='$phone' WHERE id='$id'";
		$sql = mysqli_query($conn, $sql);
	} else {
		$sql = "INSERT INTO address (id, city, area, street, building, phone) VALUES ('$id', '$city', '$area', '$street', '$building', '$phone')";
		$sql = mysqli_query($conn, $sql);
	}
	header("Location: ../address.php?say=done");
	exit;
}