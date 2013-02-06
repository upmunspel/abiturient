<?php

/**
 * This is the model class for table "streettypes".
 *
 * The followings are the available columns in table 'streettypes':
 * @property integer $idStreetTypes
 * @property string $StreetTypesFullName
 * @property string $StreetTypesShortName
 */
class StreetTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StreetTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function DropDown(){
           $res = array();
           foreach(StreetTypes::model()->findAll()as $record) {
                $res[$record->idStreetTypes] = $record->StreetTypesFullName;
           }
           return $res;
        }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'streettypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idStreetTypes', 'required'),
			array('idStreetTypes', 'numerical', 'integerOnly'=>true),
			array('StreetTypesFullName, StreetTypesShortName', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idStreetTypes, StreetTypesFullName, StreetTypesShortName', 'safe', 'on'=>'search'),
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
			'idStreetTypes' => 'Id Street Types',
			'StreetTypesFullName' => 'Street Types Full Name',
			'StreetTypesShortName' => 'Street Types Short Name',
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

		$criteria->compare('idStreetTypes',$this->idStreetTypes);
		$criteria->compare('StreetTypesFullName',$this->StreetTypesFullName,true);
		$criteria->compare('StreetTypesShortName',$this->StreetTypesShortName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}