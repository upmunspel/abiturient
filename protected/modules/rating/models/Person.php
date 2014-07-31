<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property Country $country
 */
class Person extends ActiveRecord {
  public static function model($className=__CLASS__){
    return parent::model($className);
  }
  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'benefits' => array(self::HAS_MANY, 'Personbenefits', 'PersonID'),
        'znos' => array(self::HAS_MANY, 'Documents', 'PersonID', 'on' => 'znos.TypeID=4'),
        'specs' => array(self::HAS_MANY, 'Personspeciality', 'PersonID'),
        'docs' => array(self::HAS_MANY, 'Documents', 'PersonID'),
        'contacts' => array(self::HAS_MANY, 'PersonContacts', 'PersonID'),
        'country' => array(self::BELONGS_TO, 'Country', 'CountryID'),
    );
  }
}
