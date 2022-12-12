<?php	
session_start();
require_once 'connect.php';
require_once 'functions.php';

if(!empty($_POST)){
	$customerEmail = validateRequiredField($_POST['customer_email']);
	$customerPassword = md5(validateRequiredField($_POST['customer_password']));

	$checkUser = mysqli_query($dbConnect, "SELECT * FROM `customers` WHERE `customer_email` = '$customerEmail' AND `customer_password` = '$customerPassword'");
	if(mysqli_num_rows($checkUser) > 0){

		$_SESSION['boot_option'] = 'table';
		header('Location: ../');
		die();

	}else{
		$_SESSION['boot_option'] = 'login';
		$_SESSION['errorMessage'] = 'Не удалось войти, введите корректные email и пароль или зарегистрируйте нового пользователя';
		header('Location: ../');
		die();
	}
}