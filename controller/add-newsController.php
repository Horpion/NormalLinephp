<?php

include_once 'model/categoryModel.php';
include ROOT.'/class/addingNews.php';

$categoryList = Category::getListCategory();

/*
 * Перевіряємо якщо це адміністратор
 */
if( isset($_SESSION) && ($_SESSION['access'] == 2)){
    $addNews = new addingNews;
    $addNews->run();
    
    $page_name = "Додавання матеріалу на сайт";
    include ROOT.'/view/add-newsView.php';
    
}else{
    echo "<h1 style='text-align:center;color:red;'>Доступ заборонений!</h1>";
}

