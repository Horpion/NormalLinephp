<?php

/**
 * Функція для обробки $_FILE. 
 * Переміщує файл у вказану директорію і повертає URL до неї (масивом або рядком);
 * 
 * @param $arrFile - сам $ _FILE масив
 * @param $savePath - куди будемо зберігати
 * @param $format - які формати дозволяти (array)
 * 
 * @return string/array
 */
function machiningFILE(array $arrFile,string $savePath,array $format){
    $stringFileFormat = implode('|',$format);
    $imagePaths = [];
    $urlSite = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].'/';
    
    foreach ($arrFile as $key=>$value) {
        /*
         * Перевіряємо якщо такий формат дозволений
         */
        
        if( preg_match("*$stringFileFormat*", $value['type']) ){
            /*
             * Якщо переданий 1 файл - то повертаємо рядок
             * Інакше - масив
             */
            if(count($arrFile) == 1 ){
                if(move_uploaded_file($value['tmp_name'], ROOT.$savePath."/".$value['name'])){
                    return $urlSite.$savePath."/".$value['name'];
                }
            }else{
                if(move_uploaded_file($value['tmp_name'], ROOT.$savePath."/".$value['name'])){
                    $imagePaths[] = $urlSite.$savePath."/".$value['name'];
                }
            }
   
        }else{
            return false;
        } 
    }
    return $imagePaths;
};


