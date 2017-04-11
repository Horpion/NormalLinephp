<?php
include ROOT.'/model/categoryModel.php';


/*
 * Виводимо всі категорії
 */
if(empty($_GET['category'])){
    $page_name = 'Усі категорії';
    $category_name = "Усі категорії";
    $categoriesPosts = Category::getLimitedCategory(10);
    
    include ROOT.'/view/categoryAllView.php';
}

/*
 * Виводимо певну категорію
 */
else{
    $id = (string)$definePage['category'];
    $posts = Category::getLimitedCategories(10, $id);
    $page_name = 'Категорія: '.$posts[0]["category"];
    
    $category_name = $posts[0]["category"];
    include ROOT.'/view/categoryDefineView.php';
}