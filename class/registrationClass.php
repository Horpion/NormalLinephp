<?php
include_once (ROOT."/config/db.php");

class Registration{
    public $regAlarm;
    private $regLogin;
    private $regPass;
    private $regPass2;
    
    public function run(){
        
        /**
         * Перевіряємо якщо кнопка SUBMIT була натиснута
         */
        if(isset($_POST['registr-submit'])){
            /*
             * Перевіряємо якщо всі поля заповнені
             */
            if(!empty($_POST['regLogin']) && !empty($_POST['regPass']) && !empty($_POST['regPass-confirm']) ){
                $this->regLogin = (string)trim(strip_tags($_POST['regLogin'])); 
                $this->regPass = (string)trim(strip_tags($_POST['regPass'])); 
                $this->regPass2  = (string)trim(strip_tags($_POST['regPass-confirm'])); 
                
                /*
                 * Перевіряємо якщо regPass == regPass-confirm
                 */
                if( $_POST['regPass'] === $_POST['regPass-confirm'] ){
                    
                    /**
                     * Перевіряємо якщо логін вільний
                     */
                    if(!$this->checkLogin($this->regLogin)){
                        
                        if($this->sendUser($this->regLogin,$this->regPass)){
                            $this->regAlarm = 'Ви успішно зареєструвалися.';
                        }else{
                            $this->regAlarm = 'У процесі реєстрації виникла помилка.';
                        }
                        
                    }else{
                        $this->regAlarm = 'Логін зайнятий!';
                    }
                    
                }else{
                    $this->regAlarm = 'Паролі не співпадають!';
                }
                
            }else{
                $this->regAlarm = 'Заповніть всі поля!';
            }
            
        }
        
    }
    
    /**
     * Перевіряє якщо такий логін присутній в БД
     *
     * @param $login - логін
     * @return true - логін зайнятий 
     * @return false - логін не зайнятий 
     */
    private function checkLogin($login){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare("SELECT login FROM user WHERE login= :login");
        $query->execute(['login' => $login]);
        
        if( $query->fetchColumn() ){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Відправляємо дані юзера в БД
     * 
     * @param $login - логін який буде відправлений
     * @param $pass - пароль який буде відправлений
     * @return true - дані були успішно відправлені
     * @return false - помилка відправки
     */
    private function sendUser($login,$pass){
        $db = new PDO( "mysql:host=localhost; dbname=".DB_NAME,DB_USER,DB_PASS);
        $query = $db->prepare("INSERT INTO user(login,password) VALUES(:login,:password)");
        
        if( $query->execute(['login' => $login,'password' => $pass]) ){
            return true;
        }else{
            return false;
        }
    }
    
}
