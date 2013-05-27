<?php

/**
 * This is the model class for table "educationtype".
 *
 * The followings are the available columns in table 'educationtype':
 * @property integer $idEducationType
 * @property string $EducationTypeFullName
 * @property string $EducationTypeShortName
 * @property integer $EducationTypeClassID
 *
 * The followings are the available model relations:
 * @property Educationclass $educationTypeClass
 * @property Schools[] $schools
 */
class Educationtype extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Educationtype the static model class
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
		return 'educationtype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEducationType', 'required'),
			array('idEducationType, EducationTypeClassID', 'numerical', 'integerOnly'=>true),
			array('EducationTypeFullName', 'length', 'max'=>100),
			array('EducationTypeShortName', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEducationType, EducationTypeFullName, EducationTypeShortName, EducationTypeClassID', 'safe', 'on'=>'search'),
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
			'educationTypeClass' => array(self::BELONGS_TO, 'Educationclass', 'EducationTypeClassID'),
			'schools' => array(self::HAS_MANY, 'Schools', 'EducationTypeID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idEducationType' => 'Код типу освіти',
    'EducationTypeFullName' => 'Повна назва типу освіти',
    'EducationTypeShortName' => 'Скорочена назва',
    'EducationTypeClassID' => 'Education Type Class',
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

		$criteria->compare('idEducationType',$this->idEducationType);
		$criteria->compare('EducationTypeFullName',$this->EducationTypeFullName,true);
		$criteria->compare('EducationTypeShortName',$this->EducationTypeShortName,true);
		$criteria->compare('EducationTypeClassID',$this->EducationTypeClassID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}