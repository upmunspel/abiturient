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
 * @property integer $IsResident
 * @property integer $KOATUUCode
 * @property integer $PersonEducationTypeID
 * @property integer $StreetTypeID
 * @property string $Address
 * @property string $HomeNumber
 * @property string $PostIndex
 */
class Person extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Person the static model class
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
			array('PersonSexID, IsResident, KOATUUCode, PersonEducationTypeID, StreetTypeID', 'numerical', 'integerOnly'=>true),
			array('FirstName, MiddleName, LastName', 'length', 'max'=>50),
			array('Address', 'length', 'max'=>250),
			array('HomeNumber, PostIndex', 'length', 'max'=>10),
			array('Birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPerson, Birthday, PersonSexID, FirstName, MiddleName, LastName, IsResident, KOATUUCode, PersonEducationTypeID, StreetTypeID, Address, HomeNumber, PostIndex', 'safe', 'on'=>'search'),
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
			'idPerson' => 'Id Person',
			'Birthday' => 'Birthday',
			'PersonSexID' => 'Person Sex',
			'FirstName' => 'First Name',
			'MiddleName' => 'Middle Name',
			'LastName' => 'Last Name',
			'IsResident' => 'Is Resident',
			'KOATUUCode' => 'Koatuucode',
			'PersonEducationTypeID' => 'Person Education Type',
			'StreetTypeID' => 'Street Type',
			'Address' => 'Address',
			'HomeNumber' => 'Home Number',
			'PostIndex' => 'Post Index',
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
		$criteria->compare('IsResident',$this->IsResident);
		$criteria->compare('KOATUUCode',$this->KOATUUCode);
		$criteria->compare('PersonEducationTypeID',$this->PersonEducationTypeID);
		$criteria->compare('StreetTypeID',$this->StreetTypeID);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('HomeNumber',$this->HomeNumber,true);
		$criteria->compare('PostIndex',$this->PostIndex,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}