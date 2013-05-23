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
    public static function getPkName(){
        if (!Yii::app()->user->isGuest){
            
            $user = User::model()->findByPk(Yii::app()->user->id);
            if (!empty($user->syspk)) return $user->syspk->PkName;
        }
        return "";
    }
}
?>
