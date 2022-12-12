<?php
error_reporting(0);
session_start();

if (empty($_SESSION['boot_option'])) {
	require_once('html/new_customer_registration_form.html');
}elseif ($_SESSION['boot_option'] === 'login') {
	unset($_SESSION['boot_option']);
	require_once('html/user_login_form.html');	
}elseif($_SESSION['boot_option'] === 'registration'){
	unset($_SESSION['boot_option']);
	require_once('html/new_customer_registration_form.html');
}elseif($_SESSION['boot_option'] = 'table'){
	unset($_SESSION['boot_option']);
	require_once('php/table.php');
}