<?php

class ActiveRecord extends CActiveRecord {
     protected function CheckSaveLog(){
            // Збереження користувача та заборона редагування чужих записів
            if ($this->isNewRecord){
                $this->SysUserID = Yii::app()->user->id;
            } elseif ($this->SysUserID != Yii::app()->user->id && !Yii::app()->user->checkAccess('updateAllPost')){
                throw new CHttpException(403,"Доступ заборонено. У Вас відсутні права для редагування чужих записів!");
            } 
     }
     protected function beforeSave() {
            $this->CheckSaveLog();  
            return parent::beforeSave();
          
     }
     protected function beforeDelete() {
            $this->CheckSaveLog();
            return parent::beforeDelete();
     }
}
?>
