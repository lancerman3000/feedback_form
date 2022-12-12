<?php
session_start();
require_once 'connect.php';
require_once 'functions.php';

if(!empty($_POST)){
	$customerName = validateRequiredField($_POST['customer_name']);
	$customerEmail = validateRequiredField($_POST['customer_email']);
	$customerPassword = md5(validateRequiredField($_POST['customer_password']));
	$mainAnswer = cleanFormText($_POST['main_answer']);
	
	if(isset($_POST['peel_color'])){
		$peelColor = cleanFormText($_POST['peel_color']);
	}else{
		$peelColor = NULL;
	}
	
	$customerMessage = cleanFormText($_POST['customer_message']);
	$agreement = validateRequiredField($_POST['agreement']);
	
	if($_FILES['customer_file']['error'] === 0){

		if($_FILES['customer_file']['size'] > 2097152){
			$_SESSION['errorMessage'] = 'Размер файла превысил 2 мегабайта и не был загружен';
			header('Location: ../');
			die();
		}
		
		$uploadingFileName = $_FILES['customer_file']['name'];
		$fileUploadPath = 'uploads/' . $customerEmail . '_' . date("Y-m-d--H:i:s") . '_' . $uploadingFileName;
		$fileUploaded = move_uploaded_file($_FILES['customer_file']['tmp_name'], '../' . $fileUploadPath);

	}else {
		$fileUploadPath = null;
	}

	if(
		mysqli_query($dbConnect, "INSERT INTO `customers` (`customer_name`, `customer_email`, `customer_password`, `main_answer`, `peel_color`, `customer_message`, `agreement`, `file_path`) VALUES ('$customerName', '$customerEmail', '$customerPassword', '$mainAnswer', '$peelColor', '$customerMessage', '$agreement', '$fileUploadPath')")
		){
			$_SESSION['succsessMessage'] = 'Данные пользователя и Ваше обращение успешно зарегистрированы';
			if($fileUploadPath){
				$_SESSION['succsessMessage'] = $_SESSION['succsessMessage'] . ', файл успешно загружен';
			}

			require_once('send_mail.php');
			$_SESSION['boot_option'] = 'login';
			header('Location: ../');
			die();
		}else{
			close($dbConnect);
			$_SESSION['errorMessage'] = 'Регистрация не удалась по техническим причинам, свяжитесь с администратором';
			header('Location: ../');
			die();

		}

}else{
	require_once('../index.php');
}