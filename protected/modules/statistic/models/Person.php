<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $idPerson
 * @property string $Birthday
 * @property string $BirthPlace
 * @property integer $PersonSexID
 * @property string $FirstName
 * @property string $MiddleName
 * @property string $LastName
 * @property integer $KOATUUCodeL1ID
 * @property integer $KOATUUCodeL2ID
 * @property integer $KOATUUCodeL3ID
 * @property integer $IsResident
 * @property integer $PersonEducationTypeID
 * @property integer $StreetTypeID
 * @property string $Address
 * @property string $HomeNumber
 * @property string $PostIndex
 * @property integer $SchoolID
 * @property string $FirstNameR
 * @property string $MiddleNameR
 * @property string $LastNameR
 * @property integer $LanguageID
 * @property integer $CountryID
 * @property string  $PhotoName
 * @property integer $isCampus
 * @property integer $SysUserID
 * @property integer $isSamaSchoolAddr
 * @property Documents $entrantdoc
 * @property Documents $persondoc
 * @property Documents $edboID
 * @property string $CreateDate
 * @property integer $KOATUUCodeID
 */
class Person extends ActiveRecord {
  public $NAME;
  public $PsnContacts;
  public $SPECS;
  public $idSTATUSES;
  public $STATUSES;
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Person the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'person';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('HomeNumber, PostIndex, Address,
                  FirstName, LastName, FirstNameR, 
                  LastNameR, LanguageID', 'required'),
        array('PersonSexID, KOATUUCodeL1ID, KOATUUCodeL2ID, 
                  KOATUUCodeL3ID, IsResident, PersonEducationTypeID,
                  StreetTypeID, SchoolID, LanguageID, CountryID, 
                  KOATUUCodeID', 'numerical', 'integerOnly' => true),
        array('FirstName, MiddleName, LastName, FirstNameR, MiddleNameR, LastNameR, codeU', 'length', 'max' => 100),
        array('codeU, edboID', "unique", "allowEmpty" => 'true'),
        array('Address, PhotoName', 'length', 'max' => 250),
        array('HomeNumber, PostIndex', 'length', 'max' => 10),
        array('Birthday, BirthPlace, isCampus, isSamaSchoolAddrk, CreateDate, isSamaSchoolAddr', 'safe'),
        //array('Birthday', 'date', "format"=>'dd.MM.yyyy', 'allowEmpty'=>true ),
        //
			// The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('idPerson, Birthday, PersonSexID, FirstName, MiddleName,
                  LastName, KOATUUCodeL1ID, KOATUUCodeL2ID, KOATUUCodeL3ID, 
                  IsResident, PersonEducationTypeID, StreetTypeID, Address, HomeNumber, 
                  PostIndex, SchoolID, FirstNameR, MiddleNameR, LastNameR,  
                  CountryID, PersonDocumentID, EntrantDocumentID,KOATUUCodeID', 
            'safe', 'on' => 'search'),
        array('PhotoName', 'file', 'types' => 'jpg, gif, png', 'maxSize' => 5048576, 'on' => 'PHOTO'),
    );
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
        'thspecs' => array(self::HAS_MANY, 'Specialities', 'SepcialityID', 
            'through' => 'specs'),
        'country' => array(self::BELONGS_TO,'Country','CountryID'),
        'language' => array(self::BELONGS_TO,'Languages','LanguageID'),
        'school' => array(self::BELONGS_TO,'Schools','SchoolID'),
    );
  }


  protected function afterFind() {
    //if (empty($this->KOATUUCodeL1ID)) $this->KOATUUCodeL1ID = 105572;
    //if (empty($this->KOATUUCodeL2ID)) $this->KOATUUCodeL2ID = 105574;
    //if (empty($this->KOATUUCodeL3ID)) $this->KOATUUCodeL3ID = 105576;

    if ($this->Birthday == "0000-00-00") {
      $this->Birthday = "01.01.1995";
    } else {
      $this->Birthday = date("d.m.Y", strtotime($this->Birthday));
    }

    $this->CreateDate = date("d.m.Y", strtotime($this->CreateDate));
    parent::afterFind();
    return true;
  }


  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'idPerson' => 'Код',
        'Birthday' => 'Дата народження',
        'PersonSexID' => 'Стать',
        'FirstName' => "Ім'я",
        'MiddleName' => 'По батькові',
        'LastName' => "Прізвище",
        'FirstNameR' => "Ім'я (родовий)",
        'MiddleNameR' => 'По батькові (родовий)',
        'LastNameR' => "Прізвище (родовий)",
        'IsResident' => 'Громадянин України',
        'KOATUUCode' => 'Koatuucode',
        'PersonEducationTypeID' => 'Person Education Type',
        'StreetTypeID' => "Тип вулиці",
        'Address' => "Назва вулиці",
        'HomeNumber' => '№ будинку, кв.',
        'PostIndex' => 'Індекс',
        'idKOATUU' => 'Id Koatuu',
        'LanguageID' => 'Іноземна мова',
        'CountryID' => 'Країна громадянства',
        "PersonEducationTypeID" => "Попередня освіта",
        "PhotoName" => "Фото абітурієнта",
        "SchoolID" => "Назва школи",
        "isCampus" => "Гуртожиток",
        "codeU" => "GUID Код",
        "edboID" => "Ідентифікатор ЄДБО",
        'BirthPlace' => 'Місце народження',
        'CreateDate' => 'Дата додання',
        "FIO" => "ПІБ",
        "operatorInfo" => "Оператор",
    );
  }

  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.
    $user = Yii::app()->user->getUserModel();

    $criteria = new CDbCriteria;

    if (!empty($user)) {
      // $criteria->with = 
    }
    $criteria->compare('idPerson', $this->idPerson);
    $criteria->compare('Birthday', $this->Birthday, true);
    $criteria->compare('PersonSexID', $this->PersonSexID);
    $criteria->compare('FirstName', $this->FirstName, true);
    $criteria->compare('MiddleName', $this->MiddleName, true);
    $criteria->compare('LastName', $this->LastName, true);
    $criteria->compare('KOATUUCodeL1ID', $this->KOATUUCodeL1ID);
    $criteria->compare('KOATUUCodeL2ID', $this->KOATUUCodeL2ID);
    $criteria->compare('KOATUUCodeL3ID', $this->KOATUUCodeL3ID);
    $criteria->compare('IsResident', $this->IsResident);
    $criteria->compare('PersonEducationTypeID', $this->PersonEducationTypeID);
    $criteria->compare('StreetTypeID', $this->StreetTypeID);
    $criteria->compare('Address', $this->Address, true);
    $criteria->compare('HomeNumber', $this->HomeNumber, true);
    $criteria->compare('PostIndex', $this->PostIndex, true);
    $criteria->compare('SchoolID', $this->SchoolID);
    $criteria->compare('FirstNameR', $this->FirstNameR, true);
    $criteria->compare('MiddleNameR', $this->MiddleNameR, true);
    $criteria->compare('LastNameR', $this->LastNameR, true);
    $criteria->compare('LanguageID', $this->LanguageID);
    $criteria->compare('CountryID', $this->CountryID);
    if (!empty($this->CreateDate)) {
      $criteria->addBetweenCondition('CreateDate', date('Y-m-d', strtotime($this->CreateDate)), date('Y-m-d', strtotime($this->CreateDate)) . " 23:59:59");
    }

    //$criteria->compare('CreateDate',$this->CreateDate);
    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
    ));
  }
  
  }
