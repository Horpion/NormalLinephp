<?php
include ROOT.'/model/articleModel.php';
include ROOT.'/class/addingNews.php';
$url = $_SERVER["REQUEST_URI"];

/*
 * Виводимо всі статті
 */
if(empty($_GET['article'])){
    $page_name = 'Всі новини';
    $category_name = "Всі новини";
    $posts = Article::getLimitedArticle(10);
    
    include ROOT.'/view/articleAllView.php';
}
/*
 * Виводимо певну статтю
 */
else{
    if(isset($definePage['delete'])){
        header("Location: index.php");
        addingNews::removeNews($definePage['delete']);
    }else{
        $id = (int)$definePage['article'];
        $post = Article::getArticle($id)[0];
        $page_name = $post['name'];
        $category_name = 'Стаття';
        include ROOT.'/view/articleDefineView.php';
        Article::addView($id);
    }
    
}


