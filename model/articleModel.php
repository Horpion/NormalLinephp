<?php
include_once (ROOT."/config/db.php");

/**
 * Модель для роботи з даними статті
 */
class Article{
    
    /**
     * Отримуємо певну одну статтю по id
     */
    static function getArticle(int $id = 1){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT * FROM article WHERE id='.$id);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    /**
     * Отримуємо певну кількість. новин
     * 
     * @param $quantityArticle - скільки новин запитувати
     */
    static function getLimitedArticle($quantityArticle){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT * FROM article ORDER BY id DESC LIMIT '.$quantityArticle);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    /**
     * Отримуємо певну кількість. новин з певної категорії
     * 
     * @param $quantityCategories - скільки новин запитувати
     * @param $category - з якої категорії виводимо
     * 
     * @return array
     */
    static function getLimitedCategories($quantityCategories , $category){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare("SELECT * FROM article WHERE category = '{$category}' ORDER BY id DESC LIMIT ".$quantityCategories);
        var_dump($query);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    
    /**
     * Лічильник переглядів.
     * 
     * @param $id - id новини
     */
    static function addView(int $id){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT view FROM article WHERE id= '.$id);
        $query->execute();
        $view = (int)$query->fetchColumn();
        $view++;
        $query = $db->prepare("UPDATE article SET view={$view} WHERE id = ".$id);
        $query->execute();
    }
    
}

