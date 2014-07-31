<?php

/**
 * This is the model class for table "specialities".
 *
 * The followings are the available columns in table 'specialities':
 * @property $tSPEC - повна назва спеціальності (з кодом, напрямом і формою)
 * @property $cnt_requests_per_day - змінна лічильник (к-сть заяв за день)
 * @property $cnt_requests - змінна лічильник (к-сть заяв за певний проміжок часу)
 * @property $cnt_persons_per_day - змінна лічильник (к-сть окремих персон за день)
 * @property $cnt_persons - змінна лічильник (к-сть окремих персон за певний проміжок часу)
 */
class Specialities extends CActiveRecord {

  public $tSPEC;
  public $cnt_requests_per_day;
  public $cnt_requests;
  public $cnt_persons_per_day;
  public $cnt_persons;
  
  
  public static function model($className=__CLASS__){
    return parent::model($className);
  }
  
    public function tableName() {
        return 'specialities';
    }
  
  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'personsepcialities' => array(self::HAS_MANY, 'Personspeciality', 'SepcialityID'),
        'facultet' => array(self::BELONGS_TO, 'Facultets', 'FacultetID'),
        'eduform' => array(self::BELONGS_TO, 'Personeducationforms', 'PersonEducationFormID'),
        'specquotes' => array(self::HAS_MANY, 'Specialityquotes', 'SpecialityID'),
        'quotas' => array(self::HAS_MANY, 'Quota', 'QuotaID', 'through' => 'specquotes'),
    );
  }

}
