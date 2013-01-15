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
 */
class Person extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Person1 the static model class
	 */
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
			array('PersonSexID, KOATUUCodeL1ID, KOATUUCodeL2ID, KOATUUCodeL3ID, IsResident, PersonEducationTypeID, StreetTypeID, SchoolID', 'numerical', 'integerOnly'=>true),
			array('FirstName, MiddleName, LastName, FirstNameR, MiddleNameR, LastNameR', 'length', 'max'=>100),
			array('Address', 'length', 'max'=>250),
			array('HomeNumber, PostIndex', 'length', 'max'=>10),
			array('Birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPerson, Birthday, PersonSexID, FirstName, MiddleName, LastName, KOATUUCodeL1ID, KOATUUCodeL2ID, KOATUUCodeL3ID, IsResident, PersonEducationTypeID, StreetTypeID, Address, HomeNumber, PostIndex, SchoolID, FirstNameR, MiddleNameR, LastNameR', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
         protected function beforeSave() {
             
            if ($this->KOATUUCodeL1ID == "0") $this->KOATUUCodeL1ID = NULL;
            if ($this->KOATUUCodeL2ID == "0") $this->KOATUUCodeL2ID = NULL;
            if ($this->KOATUUCodeL3ID == "0") $this->KOATUUCodeL3ID = NULL;
            if ($this->SchoolID == "0") $this->SchoolID = NULL;
            
            $from=DateTime::createFromFormat('d.m.Y',$this->Birthday);
            $this->Birthday=$from->format('Y-m-d');       
            
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
            if (empty($this->KOATUUCodeL1ID)) $this->KOATUUCodeL1ID = 105572;
            if (empty($this->KOATUUCodeL2ID)) $this->KOATUUCodeL2ID = 105574;
            if (empty($this->KOATUUCodeL3ID)) $this->KOATUUCodeL3ID = 105576;
            $this->IsResident = 1;
            parent::afterConstruct();
        }
	public function attributeLabels()
	{
		return array(
			'idPerson' => 'Id Person',
			'Birthday' => 'Дата народження',
			'PersonSexID' => 'Стать',
			'FirstName' => 'Прізвище',
			'MiddleName' => 'Побатькові',
			'LastName' => "Ім'я",
			'IsResident' => 'Українець',
			'KOATUUCode' => 'Koatuucode',
			'PersonEducationTypeID' => 'Person Education Type',
			'StreetTypeID' => "Тип міського об'єкуту",
			'Address' => "Назва мыського об'єкуту",
			'HomeNumber' => 'Номер',
			'PostIndex' => 'Індекс',
			'idKOATUU' => 'Id Koatuu',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}