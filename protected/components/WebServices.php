<?php

class WebServices {

    static private $searchSrv = "http://10.1.22.177:8080/PersonSearch/";

    /**
     * return base64 string or null
     * $codeU string
     */
    public static function getPersonPhotoByCodeU($codeU) {
        
        $script = "getphoto.jsp?personCodeU=";
        $res = null;
        try {
            if (empty($codeU)) {
                throw new Exception("getPersonPhotoByCode:: Пустое значение personCodeU!");
            }
            $res = @file_get_contents(WebServices::$searchSrv . $script . $codeU);

            if (empty($res)) {
                throw new Exception("getPersonPhotoByCode:: Нет доступа к сервису!");
            }
        } catch (Exception $ex) {
            if (defined('YII_DEBUG')) {
                Yii::log($ex->getMessage(), CLogger::LEVEL_INFO, 'WebServices');
            }
            return null;
        }
        return $res;
    }

}
