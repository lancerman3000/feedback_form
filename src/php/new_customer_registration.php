<?php
session_start();
require_once 'connect.php';
require_once 'functions.php';

echo('<pre>');
print_r($_POST);
print_r($_FILES);
echo('</pre>');


if(!empty($_POST)){
	$customerName = cleanFormText(validateRequiredField($_POST['customer_name']));
	$customerEmail = cleanFormText(validateRequiredField($_POST['customer_email']));
	$customerPassword = md5(cleanFormText(validateRequiredField($_POST['customer_password'])));
	$mainAnswer = cleanFormText($_POST['main_answer']);
	
	if(isset($_POST['peel_color'])){
		$peelColor = cleanFormText($_POST['peel_color']);
	}else{
		$peelColor = NULL;
	}
	
	$customerMessage = cleanFormText($_POST['customer_message']);
	$agreement = cleanFormText($_POST['agreement']);

	if($_FILES['customer_file']['size'] > 2097152){
		$_SESSION['errorMessage'] = 'Размер файла превысил 2 мегабайта и не был загружен';
			header('Location: ../');
			die();
	}

	$uploadingFileName = $_FILES['customer_file']['name'];
	$fileUploadPath = 'uploads/' . $customerEmail . '_' . date("Y-m-d--H:i:s") . '_' . $uploadingFileName;
	move_uploaded_file($_FILES['customer_file']['tmp_name'], '../' . $fileUploadPath);

	if(
		mysqli_query($dbConnect, "INSERT INTO `customers` (`customer_name`, `customer_email`, `customer_password`, `main_answer`, `peel_color`, `customer_message`, `agreement`, `file_path`) VALUES ('$customerName', '$customerEmail', '$customerPassword', '$mainAnswer', '$peelColor', '$customerMessage', '$agreement', '$fileUploadPath')")
		){
			$_SESSION['succsessMessage'] = 'Данные пользователя и Ваше обращение успешно зарегистрированы';
			header('Location: ../');
			die();
		}else{
			$_SESSION['errorMessage'] = 'Регистрация не удалась по техническим причинам, свяжитесь с администратором';
			header('Location: ../');
			die();

		}

}else{
	require_once('../index.php');
}