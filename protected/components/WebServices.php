<?php

class WebServices {

    static private $searchSrv = "http://10.1.22.177:8080/PersonSearch/";

    /**
     * Максимальная проолжительность запроса к сервису
     * @var integer 
     */
    static private $requestTimeout = 5;
     /**
     * Максимальная время жизни файлового кеша в минутах
     * @var integer 
     */
    static private $cachTime = 2;

    /**
     * Полукчает фото абитуриента по его коду ЭДЕБО 
     * Выполняет кеширование на указанное в настройках сервиса время
     * Устанавливает сообщение о ошибке с именем 'photomessage' 
     * return base64 string or null
     * $codeU string
     */
    public static function getPersonPhotoByCodeU($codeU) {

        $script = "getphoto.jsp?personCodeU=";
        
        $res = Yii::app()->cache->get($codeU);
        if ($res === false) {

            try {
                if (empty($codeU)) {
                    throw new Exception("Пусте значення кода персони!");
                }
                $ctx = stream_context_create(array('http' => array('timeout' => WebServices::$requestTimeout)));
                $res = @file_get_contents(WebServices::$searchSrv . $script . $codeU, 0, $ctx);
                $tres = trim($res);
                if (!empty($res) && empty($tres) ) {
                    throw new Exception("Фото у ЄДЕБО відсутне!");
                }
                if (empty($tres)) {
                    throw new Exception("Відсутній доступ до сервера ЄДЕБО!");
                }
                Yii::app()->cache->set($codeU, $res);
            } catch (Exception $ex) {
                if (defined('YII_DEBUG')) {
                    Yii::log($ex->getMessage(), CLogger::LEVEL_INFO, 'WebServices');
                }
                Yii::app()->user->setFlash("photomessage", $ex->getMessage());
                return null;
            }
            
        } 
        return $res;
    }

}
