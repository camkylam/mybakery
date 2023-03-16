<?php
try {
	$conn = new PDO('mysql:host=localhost;dbname=banh', 'root', '');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	$error[] = 'Không thể kết nối đến CSDL';
	include 'show_error.php';
	exit();
}