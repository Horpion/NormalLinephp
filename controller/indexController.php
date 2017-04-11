<?php

include ROOT.'/model/articleModel.php';
$page_name = "Головна сторінка";

$article = Article::getLimitedArticle(10);

include ROOT.'/view/indexView.php';

