<?php

/**
 * This is the model class for table "personrequeststatustypes".
 */
class Personrequeststatustypes extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Documents the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
  /**
   * Method returns array (id => status name)
   */
  public function getStatusList(){
    $list = array();
    foreach (Personrequeststatustypes::model()->findAll() as $model){
      $list[$model->idPersonRequestStatusType] = 
              $model->PersonRequestStatusTypeName;
    }
    return $list;
  }
  
    public function tableName() {
        return 'personrequeststatustypes';
    }

}
