<?php

include_once (ROOT."/config/db.php");

/**
 * Клас відповідає за авторизацію
 */
class Authorization{
    private $login;
    private $password;
    public $authorStatus;
    public $messageError;

    public function run(){
        
        /*
         * Перевіряємо якщо присутні кукі сесії
         */
        if(Authorization::login()){
            session_start();
            $this->authorStatus = true;
        }else{
            /*
            * Перевіряємо якщо кнопка SUBMIT натиснута
            */
            if(isset($_POST['Submit']) ){
                
               /*
                * Перевіряємо якщо поля не порожні.
                * Інакше - виводить помилку.
                */
               if(!empty($_POST['autor-login']) && !empty($_POST['autor-pass'])){
                   $this->login = trim(strip_tags($_POST['autor-login']));
                   $this->password = trim(strip_tags($_POST['autor-pass']));

                   /*
                    * Перевіряємо якщо вказані правильно логін \ пароль.
                    * Інакше - виводимо помилку.
                    */
                   if(!empty($this->checkNamePass($this->login, $this->password)) ){
                       $this->authorStatus = true;
                       session_start();
                       $_SESSION["login"] = $this->login;
                       $_SESSION["pass"] =  $this->password; 
                       $_SESSION["access"] = $this->getUserAccess($_SESSION["login"]) ;
                   }else{
                       $this->messageError = "Неправильний логін/пароль";
                   }
                }else{
                   echo "Введіть логін/пароль";
                } 
            }
        }
        
    }
    
    /**
     * Порівнюємо отриману інфу від користувача з БД
     * 
     * @param $login - нік користувача
     * @param $password - пароль юзера
     */
    private function checkNamePass($login,$password){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare("SELECT * FROM user WHERE login = '{$login}' AND password = ".$password);
        if( $query->execute() ){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    /**
     * Отримуємо access номер користувача
     * 
     * @param $login - для якого користувача запитувати з БД номер доступу
     */
    private function getUserAccess($login){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare("SELECT access FROM user WHERE login = '{$login}' ");
        if( $query->execute() ){
            return (int)$query->fetchColumn();
        }
    }
    
    /**
     * Перевіряємо на наявности сесії в кукі
     */
    static function login(){
        if( isset($_COOKIE['PHPSESSID'])){
            return true;
        }else{
            return false;
        }
    }
    
    public function logOut(){
        unset($_SESSION);
        session_destroy();
        setcookie('PHPSESSID',"",time()-1);
        $this->authorStatus = false;
        header("Location:/");
    }
    
}

