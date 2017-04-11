<?php
$page_name = "Реєстрація";

/*
 * Регистрация
 */
include 'class/registrationClass.php';
$registration = new Registration();
$registration->run();

if(!isset($_SESSION)){
    include ROOT.'/view/registrView.php';
}

