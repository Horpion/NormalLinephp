<?php

/**
 * Відповідає за виведення інформації в сайдбар
 */

include_once ROOT.'/config/db.php';

class Aside{
    /*
     * Отримуємо популярні пости
     */
    static function getPopularArticle($quantity){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT * FROM article ORDER BY view DESC LIMIT '.$quantity);
        if($query->execute()){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    /*
     * Отримуємо список категорій
     */
    static function getListCategory(){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('SELECT DISTINCT category FROM article ');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}