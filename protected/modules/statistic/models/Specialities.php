<?php

/**
 * This is the model class for table "specialities".
 *
 * The followings are the available columns in table 'specialities':

 */
class Specialities extends CActiveRecord {

  public $tSPEC;
  public $cnt_requests_per_day;
  public $cnt_requests;
  public $cnt_persons_per_day;
  public $cnt_persons;
  
  public $cnt_req_budget;
  public $cnt_req_contract;
  public $cnt_req_electro;
  public $cnt_req_original;
  public $cnt_req_pv;
  public $cnt_req_pzk;
  public $cnt_req_Donetsk;
  public $cnt_req_Lugansk;
  public $cnt_req_Crimea;
  
  public $cnt_requests_from_us;
  public $cnt_requests_from_aliens;
  public $cnt_grad;
  
  public $modes;
  public $statuses;



  public static function model($className = __CLASS__) {
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
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'idSpeciality' => 'Id Speciality',
        'SpecialityName' => 'Спеціальність',
        'SpecialityKode' => 'Speciality Kode',
        'FacultetID' => 'Facultet',
        'SpecialityClasifierCode' => 'Speciality Clasifier Code',
        'SpecialityBudgetCount' => 'Speciality Budget Count',
        'SpecialityContractCount' => 'Speciality Contract Count',
        'isZaoch' => 'Is Zaoch',
        'isPublishIn' => 'Is Publish In',
        'WordPrice' => "Загальна вартість прописом",
        'YearPrice' => "Загальна вартість",
        'SemPrice' => "Ціна за семестр",
        "PersonEducationFormID" => "Форма освіти",
        "StudyPeriodID" => "Період",
        "modes" => "Вивести кількість заявок абітурієнтів :",
        "statuses" => "Статуси заявок абітурієнтів :",
    );
  }

}
