<?php
function cleanFormText($value){
	$value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    
    return $value;
}

function validateRequiredField($value){
		if(empty($value) || cleanFormText($value) === ''){
			$_SESSION['errorMessage'] = 'Не заполненно одно из обязательных полей, или введенное значение неприемлимо.';
			header('Location: ../');
			die();
		}else{
			cleanFormText($value);
			return $value;
			}
}