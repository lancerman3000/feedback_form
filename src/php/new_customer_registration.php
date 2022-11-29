<?php
session_start();
require_once 'connect.php';

echo('<pre>');
print_r($_POST);
print_r($_FILES);
echo('</pre>');


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


function cleanFormText($value){
	$value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    
    return $value;
}

function validateRequiredField($value){
		if(empty($value)){
			$_SESSION['errorMessage'] = 'Введенное значение неприемлимо';
			header('Location: ../');
			die();
		}else{
			cleanFormText($value);
			return $value;
			}
}

function exitOnEmptyInput(){
	exit('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<div class="alert alert-warning" role="alert">Введенные Вами данные не прошли валидацию, пожалуйста заполните все поля корректно. <a href="../index.php">Назад.</a></div>');
}