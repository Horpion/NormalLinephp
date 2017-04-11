<?php

include_once ROOT."/config/db.php";

/**
 * Клас для роботи з категоріями
 */
class Category{
    /**
     * Отримуємо певну кількість. категорій
     */
    static function getLimitedCategory($quantityArticle){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT * FROM article ORDER BY id DESC LIMIT '.$quantityArticle);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    /**
     * Отримуємо певну кількість. новин з певної категорії
     */
    static function getLimitedCategories($quantityCategories , $category){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare("SELECT * FROM article WHERE category = '{$category}' ORDER BY id DESC LIMIT ".$quantityCategories);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    /**
     * Отримуємо популярні пости
     */
    static function getPopularArticle($quantity){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT * FROM article ORDER BY view DESC LIMIT '.$quantity);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    /**
     * Отримуємо список категорій
     */
    static function getListCategory(){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT DISTINCT category FROM article ');
        $query->execute();
        return $query->fetchAll();
    }
}