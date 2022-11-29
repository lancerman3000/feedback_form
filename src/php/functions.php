<?php
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