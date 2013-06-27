<?php

/**
 * This is the model class for table "schools".
 *
 * The followings are the available columns in table 'schools':
 * @property integer $idSchool
 * @property integer $EducationTypeID
 * @property string $Kode_School
 * @property string $SchoolName
 * @property string $SchoolShortName
 * @property string $KOATUUCode
 * @property string $KOATUUFullName
 * @property integer $StreetTypeID
 * @property string $StreetName
 * @property string $HouceNum
 * @property string $SchoolBossLastName
 * @property string $SchoolBossFirstName
 * @property string $SchoolBossMiddleName
 * @property string $SchoolPhone
 * @property string $SchoolMobile
 * @property string $SchoolEMail
 */
class Schools extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Schools the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function DropDown($KOATUUCode = '0000000000', $MaskLen = 4){
           $res = array();
           //debug('$MaskLen = '.$MaskLen);
           $KOATUUCode = substr($KOATUUCode, 0, $MaskLen);
           //debug($KOATUUCode);
           foreach(Schools::model()->findAll("KOATUUCode like :KOATUUCode ORDER BY SchoolName", array(":KOATUUCode"=>$KOATUUCode."%"))as $record) {
                 $res[$record->idSchool] = $record->SchoolName;
           }
           return $res;
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'schools';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idSchool', 'required'),
			array('idSchool, EducationTypeID, StreetTypeID', 'numerical', 'integerOnly'=>true),
			array('Kode_School', 'length', 'max'=>45),
			array('SchoolName', 'length', 'max'=>250),
			
			array('KOATUUCode', 'length', 'max'=>10),
			array('KOATUUFullName, StreetName', 'length', 'max'=>150),
			array('HouceNum', 'length', 'max'=>15),
			array('SchoolBossLastName, SchoolBossFirstName, SchoolBossMiddleName, SchoolEMail', 'length', 'max'=>100),
			array('SchoolPhone, SchoolMobile', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idSchool, EducationTypeID, Kode_School, SchoolName, SchoolShortName, KOATUUCode, KOATUUFullName, StreetTypeID, StreetName, HouceNum, SchoolBossLastName, SchoolBossFirstName, SchoolBossMiddleName, SchoolPhone, SchoolMobile, SchoolEMail', 'safe', 'on'=>'search'),
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
	public function attributeLabels()
	{
		return array(
			'idSchool' => 'Номер школи',
			'EducationTypeID' => 'Тип освіти',
			'Kode_School' => 'Код школи',
			'SchoolName' => 'Назва школи',
			'SchoolShortName' => 'Скорочена назва школи',
			'KOATUUCode' => 'Koatuu код',
			'KOATUUFullName' => 'Koatuufull назва',
			'StreetTypeID' => 'Тип вулиці',
			'StreetName' => 'Назва вулиці',
			'HouceNum' => '№ будинку, кв.',
			'SchoolBossLastName' => 'Прізвище директора',
			'SchoolBossFirstName' => 'Ім"я директора',
			'SchoolBossMiddleName' => 'По-батькові директора',
			'SchoolPhone' => 'Телефон школи',
			'SchoolMobile' => 'Мобільний телефон школи',
			'SchoolEMail' => 'Email школи',
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

		$criteria->compare('idSchool',$this->idSchool);
		$criteria->compare('EducationTypeID',$this->EducationTypeID);
		$criteria->compare('Kode_School',$this->Kode_School,true);
		$criteria->compare('SchoolName',$this->SchoolName,true);
		$criteria->compare('SchoolShortName',$this->SchoolShortName,true);
		$criteria->compare('KOATUUCode',$this->KOATUUCode,true);
		$criteria->compare('KOATUUFullName',$this->KOATUUFullName,true);
		$criteria->compare('StreetTypeID',$this->StreetTypeID);
		$criteria->compare('StreetName',$this->StreetName,true);
		$criteria->compare('HouceNum',$this->HouceNum,true);
		$criteria->compare('SchoolBossLastName',$this->SchoolBossLastName,true);
		$criteria->compare('SchoolBossFirstName',$this->SchoolBossFirstName,true);
		$criteria->compare('SchoolBossMiddleName',$this->SchoolBossMiddleName,true);
		$criteria->compare('SchoolPhone',$this->SchoolPhone,true);
		$criteria->compare('SchoolMobile',$this->SchoolMobile,true);
		$criteria->compare('SchoolEMail',$this->SchoolEMail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}