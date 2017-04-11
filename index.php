<?php
define('ROOT',__DIR__);
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*
 * Авторизация
 */
include 'class/authorizationClass.php';
$authorization = new Authorization();
$authorization->run();

/*
 * Підключаємо "Популярні новини" і т.д. для правої колонки сайту
 */
include ('class/aside.php');
$popularArticle = Aside::getPopularArticle(5);
$listCategory = Aside::getListCategory();

/*
 * Парсим GET для Router
 */
$definePage = $_GET;

    /*
     * Якщо в $_GET масиві присутня властивість "category"
     */
    if(isset($definePage['category'])){
        include ('controller/categoryController.php');
    }

    /*
     * Якщо в $_GET масиві присутня властивість "article"
     */
    elseif(isset($definePage['article'])){
        include ('controller/articleController.php');
    }
    
    /*
     * Якщо в $_GET масиві присутня властивість "registration"
     */
    elseif(isset($definePage['registration'])){
        include ('controller/registrController.php');
    }
    
    /*
     * Якщо в $_GET масиві присутня  властивість "admin"
     */
    elseif(isset($definePage['admin'])){
        include ('controller/add-newsController.php');
    }
    
    /*
     * Якщо в $_GET масиві присутня властивість logOut
     */
    elseif(isset($definePage['logOut']) && $authorization->login() ){
        $authorization->logOut();
        include ('controller/indexController.php');
    }else{
        include ('controller/indexController.php');
    }