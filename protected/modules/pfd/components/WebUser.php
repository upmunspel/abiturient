<?php
class WebUser extends CWebUser {
    
    public function getGroup(){
        if (!Yii::app()->user->hasState("group")){
            Yii::app()->user->setState("group","");
        }
        return Yii::app()->user->getState("group");
    }
    public function getUserModel(){
        return User::model()->findByPk($this->id);
    }
    /**
     * isPkSet - проверяет установлен ли параметр в парематрах приемной комиссии
     * @param type $attribute
     * @return boolean
     */
    public function isPkSet($attribute = null){
        $model = $this->getUserModel();
        if (empty($model->syspk)) return false;
        
        if (!empty($attribute)){
            return !empty($model->syspk->{$attribute});
        } 
        return true;
    }
     public function isShortForm(){
        $model = $this->getUserModel();
        if (empty($model->syspk)) return false;
        
        if ($model->syspk->idPk != 6 && ($model->syspk->QualificationID == 2 || $model->syspk->QualificationID == 3)){
            return true;
        }
        
        return false;
    }
    public static function getPkName(){
        if (!Yii::app()->user->isGuest){
            
            $user = User::model()->findByPk(Yii::app()->user->id);
            if (!empty($user->syspk)) return $user->syspk->PkName;
        }
        return "";
    }
    public function getPrintUrl($personid, $specid){
        
//        http://10.1.103.26:8080/request_report-1.0/magistr.jsp?PersonID=197&PersonSpecialityID=205  - магистры
//        http://10.1.103.26:8080/request_report-1.0/bachelor.jsp?PersonID=197&PersonSpecialityID=205 - бакалавры
            
            
        $model = $this->getUserModel();
        if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
        $ip = $model->syspk->printIP;  
        
        $spec = Personspeciality::model()->find("idPersonSpeciality=$specid");
        if (empty($spec)) throw new Exception ("Необхідно визначити спеціальність!");
        if ($spec->QualificationID > 1){
            return "http://".$ip.":8080/request_report-1.0/magistr.jsp?PersonID=$personid&PersonSpecialityID=$specid&iframe=true&width=1024&height=600";
        } else {
            return "http://".$ip.":8080/request_report-1.0/bachelor.jsp?PersonID=$personid&PersonSpecialityID=$specid&iframe=true&width=1024&height=600";
        }
        return "";
    }
    public function getEdboSearchUrl(){
        $model = $this->getUserModel();
        if (empty($model->syspk) || empty($model->syspk->searchIP) ) throw new Exception ("Необхідно визначити адресу серверу для пошуку!!");
        return "http://".$model->syspk->searchIP;  
    }
     public function getPrintPriceUrl($specid){
        
//        http://10.1.103.26:8080/request_report-1.0/magistr.jsp?PersonID=197&PersonSpecialityID=205  - магистры
//        http://10.1.103.26:8080/request_report-1.0/bachelor.jsp?PersonID=197&PersonSpecialityID=205 - бакалавры
            
            
        $model = $this->getUserModel();
        if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
        $ip = $model->syspk->printIP; 
        $spec = Specialities::model()->find("idSpeciality=$specid");
        if (empty($spec)) throw new Exception ("Необхідно визначити спеціальність!");
            return "http://".$ip.":8080/request_report-1.0/price_sort.jsp?idSpeciality=$specid&iframe=true&width=1024&height=600";
        return "";
    }   
     public function getPrintFackultetUrl($fuckultet){
        
//        http://10.1.103.26:8080/request_report-1.0/magistr.jsp?PersonID=197&PersonSpecialityID=205  - магистры
//        http://10.1.103.26:8080/request_report-1.0/bachelor.jsp?PersonID=197&PersonSpecialityID=205 - бакалавры
            
            
        $model = $this->getUserModel();
        if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
        $ip = $model->syspk->printIP; 
        $spec = Facultets::model()->find("idFacultet=$fuckultet");
        if (empty($spec)) throw new Exception ("Необхідно визначити спеціальність!");
            return "http://".$ip.":8080/request_report-1.0/price_sort_facultet.jsp?idFacultet=$fuckultet&iframe=true&width=1024&height=600";
        return "";
    }
    public function getPrintUrlstat($id){     
        $model = $this->getUserModel();
        if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
        $ip = $model->syspk->printIP;  
        return "http://".$ip.":8080/request_report-1.0/price_sort_speciality.jsp?idQualification=$id&iframe=true&width=1024&height=600";

    }
    public function getPrintUrlstatFORM($id,$idform){     
        $model = $this->getUserModel();
        if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
        $ip = $model->syspk->printIP;  
        return "http://".$ip.":8080/request_report-1.0/price_sort_specialityEducationForm.jsp?idQualification=$id&idPersonEducationForm=$idform&iframe=true&width=1024&height=600";

    }
    public function getLanguagesUrl($faculty,$lang){
        $WU = new WebUser();
        $model = $WU->getUserModel();
        if (empty($model->syspk) || empty($model->syspk->printIP) ) throw new Exception ("Необхідно визначити адресу серверу друку документів!");
        $ip = $model->syspk->printIP;  
        $_faculty = Facultets::model()->find("idFacultet=$faculty");
        $_lang = Languages::model()->find("idLanguages=$lang");
        if (empty($_faculty) || (empty($_lang) && $lang != '0')) 
            throw new Exception ("Помилка вхідних даних!");
        return "http://".$ip.":8080/request_report-1.0/language.jsp?faculty=$faculty&lang=$lang&iframe=true&width=1024&height=600";
    }
    
}
?>
