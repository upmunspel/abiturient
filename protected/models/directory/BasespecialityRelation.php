<?php

/**
 * This is the model class for table "basespeciality_relation".
 *
 * The followings are the available columns in table 'basespeciality_relation':
 * @property integer $PersonBaseSpecialityID
 * @property integer $SpecialityID
 */
class BasespecialityRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BasespecialityRelation the static model class
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
		return 'basespeciality_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PersonBaseSpecialityID, SpecialityID', 'required'),
			array('PersonBaseSpecialityID, SpecialityID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PersonBaseSpecialityID, SpecialityID', 'safe', 'on'=>'search'),
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
    'PersonBaseSpecialityID' => 'Person Base Speciality',
    'SpecialityID' => 'Speciality',
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

		$criteria->compare('PersonBaseSpecialityID',$this->PersonBaseSpecialityID);
		$criteria->compare('SpecialityID',$this->SpecialityID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}