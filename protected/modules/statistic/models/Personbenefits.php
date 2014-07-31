<?php

/**
 * This is the model class for table "personbenefits".
 *
 * The followings are the available model relations:
 * @property Personbenefitdocument[] $personbenefitdocuments
 */
class Personbenefits extends ActiveRecord{
  /**
   * @return array relational rules.
   */
  public function relations(){
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'personbenefitdocuments' => array(self::HAS_MANY, 'Personbenefitdocument', 'PersonBenefitID'),
      'person' => array(self::BELONGS_TO, 'Person', 'PersonID'),
      'benefit' => array(self::BELONGS_TO, 'Benefit', 'BenefitID'),
    );
  }
  
    public function tableName() {
        return 'personbenefits';
    }
}