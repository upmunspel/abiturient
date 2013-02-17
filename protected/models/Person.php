<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $idPerson
 * @property string $Birthday
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
 */
class Person extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Person the static model class
	 */
      
        private $persondoc = NULL;
        private $entrantdoc = NULL;
        private $inndoc = NULL;
        private $hospdoc = NULL;
        private $homephone = NULL;
        private $mobphone = NULL;
        public function getHomephone(){
            if (!empty($this->homephone)) return $this->homephone;
            if (!$this->isNewRecord){
                $sql = "select * from `personcontacts` where ";
                $sql = $sql."`personcontacts`.`PersonID` = :PersonID and `personcontacts`.PersonContactTypeID = 1;"; 
                $this->homephone = PersonContacts::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->homephone))  $this->homephone = new PersonContacts();
            } else {
                $this->homephone = new PersonContacts();
            }
            $this->homephone->PersonContactTypeID = 1;
            return $this->homephone;
        }
         public function getMobphone(){
            if (!empty($this->mobphone)) return $this->mobphone;
            if (!$this->isNewRecord){
                $sql = "select * from `personcontacts` where ";
                $sql = $sql."`personcontacts`.`PersonID` = :PersonID and `personcontacts`.PersonContactTypeID = 2;"; 
                $this->mobphone = PersonContacts::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->mobphone))  $this->mobphone = new PersonContacts();
            } else {
                $this->mobphone = new PersonContacts();
            }
            $this->mobphone->PersonContactTypeID = 2; 
            return $this->mobphone;
        }
        public function getPersondoc(){
            if (!empty($this->persondoc)) return $this->persondoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`IsEntrantDocument` = 2 and `documents`.PersonID = :PersonID";
                $this->persondoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->persondoc))  $this->persondoc = new Documents();
            } else {
                $this->persondoc = new Documents();
            }
            
            return $this->persondoc;
        }
        public function getEntrantdoc(){
            if (!empty($this->entrantdoc)) return $this->entrantdoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`IsEntrantDocument` = 1 and `documents`.PersonID = :PersonID";
                $this->entrantdoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->entrantdoc))  $this->entrantdoc = new Documents();
            } else {
                $this->entrantdoc = new Documents();
            }
            $this->entrantdoc->scenario = "ENTRANT";
            return $this->entrantdoc;
        }
        public function getInndoc(){
            if (!empty($this->inndoc)) return $this->inndoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`idPersonDocumentTypes` = 5 and `documents`.PersonID = :PersonID";
                $this->inndoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->inndoc))  $this->inndoc = new Documents();
            } else {
                $this->inndoc = new Documents();
            }
            $this->inndoc->scenario = "INN";
            $this->inndoc->TypeID = 5;
            return $this->inndoc;
        }
        public function getHospdoc(){
            if (!empty($this->hospdoc)) return $this->hospdoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`idPersonDocumentTypes` = 6 and `documents`.PersonID = :PersonID";
                $this->hospdoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->hospdoc))  $this->hospdoc = new Documents();
            } else {
                $this->hospdoc = new Documents();
            }
            $this->hospdoc->scenario = "HOSP";
            $this->hospdoc->TypeID = 6;
            return $this->hospdoc;
        }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HomeNumber, PostIndex, Address,
                                FirstName, LastName, FirstNameR, 
                                LastNameR', 'required'),
			array('PersonSexID, KOATUUCodeL1ID, KOATUUCodeL2ID, 
                                KOATUUCodeL3ID, IsResident, PersonEducationTypeID, StreetTypeID, SchoolID, LanguageID, CountryID', 'numerical', 'integerOnly'=>true),
			array('FirstName, MiddleName, LastName, FirstNameR, MiddleNameR, LastNameR', 'length', 'max'=>100),
			array('Address,PhotoName', 'length', 'max'=>250),
			array('HomeNumber, PostIndex', 'length', 'max'=>10),
			array('Birthday, isCampus', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPerson, Birthday, PersonSexID, FirstName, MiddleName, LastName, KOATUUCodeL1ID, KOATUUCodeL2ID, KOATUUCodeL3ID, IsResident, PersonEducationTypeID, StreetTypeID, Address, HomeNumber, PostIndex, SchoolID, FirstNameR, MiddleNameR, LastNameR, LanguageID, CountryID, PersonDocumentID, EntrantDocumentID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'benefits' => array(self::HAS_MANY, 'PersonBenefits', 'PersonID'),
		);
	}

protected function beforeSave() {
             
            if ($this->KOATUUCodeL1ID == "0") $this->KOATUUCodeL1ID = NULL;
            if ($this->KOATUUCodeL2ID == "0") $this->KOATUUCodeL2ID = NULL;
            if ($this->KOATUUCodeL3ID == "0") $this->KOATUUCodeL3ID = NULL;
            if ($this->SchoolID == "0") $this->SchoolID = NULL;
            
           // $from=DateTime::createFromFormat('d.m.Y',$this->Birthday);
            $this->Birthday=date('Y-m-d', strtotime($this->Birthday));       
            
            parent::beforeSave();
            return true;
        }
        protected function afterFind() {
            if (empty($this->KOATUUCodeL1ID)) $this->KOATUUCodeL1ID = 105572;
            if (empty($this->KOATUUCodeL2ID)) $this->KOATUUCodeL2ID = 105574;
            if (empty($this->KOATUUCodeL3ID)) $this->KOATUUCodeL3ID = 105576;
            if ($this->Birthday=="0000-00-00"){
                $this->Birthday="01.01.1995";     
            } else {
                $this->Birthday = date("d.m.Y", strtotime($this->Birthday));
            }
            parent::afterFind();
            return true;
        }
        protected function afterConstruct() {
            if (empty($this->PhotoName))      $this->PhotoName = "images/180x240.gif";
            if (empty($this->KOATUUCodeL1ID)) $this->KOATUUCodeL1ID = 105572;
            if (empty($this->KOATUUCodeL2ID)) $this->KOATUUCodeL2ID = 105574;
            if (empty($this->KOATUUCodeL3ID)) $this->KOATUUCodeL3ID = 105576;
            $this->IsResident = 1;
            parent::afterConstruct();
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idPerson' => 'Код',
			'Birthday' => 'Дата народження',
			'PersonSexID' => 'Стать',
			'FirstName' => 'Прізвище',
			'MiddleName' => 'Побатькові',
			'LastName' => "Ім'я",
                        'FirstNameR' => 'Прізвище (родовий)',
			'MiddleNameR' => 'Побатькові (родовий)',
			'LastNameR' => "Ім'я (родовий)",
			'IsResident' => 'Українець',
			'KOATUUCode' => 'Koatuucode',
			'PersonEducationTypeID' => 'Person Education Type',
			'StreetTypeID' => "Тип об'єкуту",
			'Address' => "Назва мыського об'єкуту",
			'HomeNumber' => 'Номер',
			'PostIndex' => 'Індекс',
			'idKOATUU' => 'Id Koatuu',
                        'LanguageID' => 'Іноземна мова',
			'CountryID' => 'Громадянство',
                        "PersonEducationTypeID"=>"Попередня освіта",
                        "PhotoName"=>"Фото абітурієнта",
                        "SchoolID"=>"Назва школи",
                        "isCampus"=>"Гуртожиток",
                    
		);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idPerson',$this->idPerson);
		$criteria->compare('Birthday',$this->Birthday,true);
		$criteria->compare('PersonSexID',$this->PersonSexID);
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('MiddleName',$this->MiddleName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('KOATUUCodeL1ID',$this->KOATUUCodeL1ID);
		$criteria->compare('KOATUUCodeL2ID',$this->KOATUUCodeL2ID);
		$criteria->compare('KOATUUCodeL3ID',$this->KOATUUCodeL3ID);
		$criteria->compare('IsResident',$this->IsResident);
		$criteria->compare('PersonEducationTypeID',$this->PersonEducationTypeID);
		$criteria->compare('StreetTypeID',$this->StreetTypeID);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('HomeNumber',$this->HomeNumber,true);
		$criteria->compare('PostIndex',$this->PostIndex,true);
		$criteria->compare('SchoolID',$this->SchoolID);
		$criteria->compare('FirstNameR',$this->FirstNameR,true);
		$criteria->compare('MiddleNameR',$this->MiddleNameR,true);
		$criteria->compare('LastNameR',$this->LastNameR,true);
		$criteria->compare('LanguageID',$this->LanguageID);
		$criteria->compare('CountryID',$this->CountryID);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}