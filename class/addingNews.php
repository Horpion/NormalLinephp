<?php
include_once (ROOT."/config/db.php");
include (ROOT."/components/functions.php");

/**
 * Клас який відповідає за відправку статей в БД
 */
class addingNews{
    
    public $article_title;
    public $article_img;
    public $article_category;
    public $article_shortDescr;
    public $article_fullDescr;
    public $newsAlarm;
    
    
    public function run(){
        /*
        * Перевіряємо якщо кнопка SUBMIT натиснута
        */
        if(isset($_POST['article-title']) ){
            /*
            * Перевіряємо якщо поля не порожні.
            * Інакше - виводить помилку.
            */
            if(!empty($_POST['article-title']) && !empty($_FILES['article-img']) && !empty($_POST['article-category']) && !empty($_POST['article-shortDescr']) && !empty($_POST['article-fullDescr']) ){
                $this->article_title = trim(strip_tags($_POST['article-title']));
                $this->article_img = $_FILES;
                $this->article_category = trim(strip_tags($_POST['article-category']));
                $this->article_shortDescr = $_POST['article-shortDescr'];
                $this->article_fullDescr = $_POST['article-fullDescr'];
                
                $imgArticle = machiningFILE($this->article_img, '/template/image/articles', ['png','jpeg','jpg']);
                $statusQuery = $this->sendNews($this->article_title, $imgArticle, $this->article_category, $this->article_shortDescr, $this->article_fullDescr);
               
                if($statusQuery){
                    $this->newsAlarm = 'Новина успішно занесена в базу даних';
                }else{
                    $this->newsAlarm = 'При додаванні новини сталася помилка';
                }
                
            }else{
                $this->newsAlarm = "Заповніть всі поля!";
            } 
        } 
    }
    
    /**
     * Відправляємо дані в БД
     * 
     * @param $name - Назва статті
     * @param $img - URL картинки
     * @param $category    - Категорія
     * @param $shortDescr  - Короткий опис
     * @param $fullDescr   - Повний опис
     */
    private function sendNews($name,$img,$category,$shortDescr,$fullDescr){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare('INSERT INTO article(name,image,short_descr,full_descr,category) VALUES( :name , :img, :shortDescr, :fullDescr, :category )');
        
        if( $query->execute(['name' => $name ,'img' => $img,'shortDescr' => $shortDescr,'fullDescr' => $fullDescr,'category' => $category]) ){
            return true;
        }
    }
    
    /**
     * Метод відповідає за видалення новини
     * 
     * @param $id - ID новини яку потрібно видалити
     */
    static public function removeNews($id){
        $id = (int)$id;
        $access = $_SESSION['access'];
        if($access == 2){
            $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
            $query = $db->prepare('DELETE FROM article WHERE id = :id');
        
            if( $query->execute(['id' => $id]) ){
                return true;
            }
        }else{
            return false;
        }
        
    }
  
    
    
}