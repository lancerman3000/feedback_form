<?php
session_start();
$_SESSION['boot_option'] = 'login';
header('Location: ../');
die();