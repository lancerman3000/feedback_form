<?php
error_reporting(0);
 $dbConnect = mysqli_connect('mysql', 'root', 'qwerty', 'customers');
 if (!$dbConnect) {
	die('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<div class="alert alert-warning" role="alert">Что-то пошло не так и база данных не хочет с нами общаться. Попробуйте вернуться <a href="../index.php">Назад.</a></div>');
 }else{
	print_r(
		'<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
		<div class="alert alert-success" role="alert">Подключение к базе данных прошло успешно.</div>');
 }