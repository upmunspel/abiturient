<?php

class WebServices {

    static private $searchSrv = "http://10.1.22.244:8080/PersonSearch/";
    
    static private $MSG_EDBO_ERROR = "Відсутній доступ до сервера ЄДЕБО!";

    /**
     * Максимальная проолжительность запроса к сервису
     * @var integer 
     */
    static private $requestTimeout = 10;
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
                
                $error = CJSON::decode($res);
                if (is_array($error) && isset( $error['error'] )){
                    throw new Exception($error['error']);
                }
                
                if (!empty($res) && empty($tres) ) {
                    throw new Exception("Фото у ЄДЕБО відсутне!");
                }
                
                if (empty($tres)) {
                    throw new Exception(WebServices::$MSG_EDBO_ERROR);
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
    /**
     * findPerson виконуэ пошук персоны за номером та серією будь-якого докамента
     * @param string $series
     * @param string $number
     * @return string
     * @throws Exception
     */
    public static function findPerson($series, $number) {

        $script = "search.jsp?series=$series&number=$number";
        $series = trim($series);
        $number = trim($number);
        try {
            if (empty($series) && empty($number)) {
                  throw new Exception("Відсутні параметри для пошуку!");
            }
            $ctx = stream_context_create(array('http' => array('timeout' => WebServices::$requestTimeout)));
            $res = @file_get_contents(WebServices::$searchSrv.$script, 0, $ctx);
            if ($res === false) {
                throw new Exception(WebServices::$MSG_EDBO_ERROR);
            }
            
            $error = CJSON::decode($res);
           
            if (is_array($error) && isset( $error['error'] )){
                throw new Exception($error['error']);
            }
                  
        } catch (Exception $ex) {
            if (defined('YII_DEBUG')) {
                Yii::log($ex->getMessage(), CLogger::LEVEL_INFO, 'WebServices::findPerson');
            }
            throw $ex;
        }
            
       
        return $res;
    }
    /**
     * findPersonDocumentsByCodeU
     * @param type $codeU
     * @return type
     * @throws Exception
     */
    public static function findPersonDocumentsByCodeU($codeU) {

        $script = "documents.jsp?personCodeU=$codeU";
        $codeU = trim($codeU);
      
        try {
            if (empty($codeU)) {
                  throw new Exception("Пусте значення кода персони!");
            }
            $ctx = stream_context_create(array('http' => array('timeout' => WebServices::$requestTimeout)));
            $res = @file_get_contents(WebServices::$searchSrv.$script, 0, $ctx);
            if ($res === false) {
                throw new Exception(WebServices::$MSG_EDBO_ERROR);
            }
            
            $error = CJSON::decode($res);
           
            if (is_array($error) && isset( $error['error'] )){
                throw new Exception($error['error']);
            }
                  
        } catch (Exception $ex) {
            if (defined('YII_DEBUG')) {
                Yii::log($ex->getMessage(), CLogger::LEVEL_INFO, 'WebServices::findPersonDocumentsByCodeU');
            }
            throw $ex;
        }
            
       
        return $res;
    }
    /**
     * findPersonContactsByCodeU
     * @param type $codeU
     * @return type
     * @throws Exception
     */
    public static function findPersonContactsByCodeU($codeU) {

        $script = "contacts.jsp?personCodeU=$codeU";
        $codeU = trim($codeU);
      
        try {
            if (empty($codeU)) {
                  throw new Exception("Пусте значення кода персони!");
            }
            $ctx = stream_context_create(array('http' => array('timeout' => WebServices::$requestTimeout)));
            $res = @file_get_contents(WebServices::$searchSrv.$script, 0, $ctx);
            if ($res === false) {
                throw new Exception(WebServices::$MSG_EDBO_ERROR);
            }
            
            $error = CJSON::decode($res);
           
            if (is_array($error) && isset( $error['error'] )){
                throw new Exception($error['error']);
            }
                  
        } catch (Exception $ex) {
            if (defined('YII_DEBUG')) {
                Yii::log($ex->getMessage(), CLogger::LEVEL_INFO, 'WebServices::findPersonContactsByCodeU');
            }
            throw $ex;
        }
            
       
        return $res;
    }

}
