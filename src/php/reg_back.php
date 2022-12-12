<?php
session_start();
$_SESSION['boot_option'] = 'registration';
header('Location: ../');
die();