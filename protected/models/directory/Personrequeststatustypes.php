<?php

/**
 * This is the model class for table "personrequeststatustypes".
 *
 * The followings are the available columns in table 'personrequeststatustypes':
 * @property integer $idPersonRequestStatusType
 * @property string $PersonRequestStatusCode
 * @property string $PersonRequestStatusTypeName
 * @property string $PersonRequestStatusTypeDescription
 */
class Personrequeststatustypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personrequeststatustypes the static model class
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
		return 'personrequeststatustypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonRequestStatusType, PersonRequestStatusCode, PersonRequestStatusTypeName, PersonRequestStatusTypeDescription', 'required'),
			array('idPersonRequestStatusType', 'numerical', 'integerOnly'=>true),
			array('PersonRequestStatusCode', 'length', 'max'=>20),
			array('PersonRequestStatusTypeName', 'length', 'max'=>50),
			array('PersonRequestStatusTypeDescription', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonRequestStatusType, PersonRequestStatusCode, PersonRequestStatusTypeName, PersonRequestStatusTypeDescription', 'safe', 'on'=>'search'),
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
    'idPersonRequestStatusType' => 'Id Person Request Status Type',
    'PersonRequestStatusCode' => 'Person Request Status Code',
    'PersonRequestStatusTypeName' => 'Person Request Status Type Name',
    'PersonRequestStatusTypeDescription' => 'Person Request Status Type Description',
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

		$criteria->compare('idPersonRequestStatusType',$this->idPersonRequestStatusType);
		$criteria->compare('PersonRequestStatusCode',$this->PersonRequestStatusCode,true);
		$criteria->compare('PersonRequestStatusTypeName',$this->PersonRequestStatusTypeName,true);
		$criteria->compare('PersonRequestStatusTypeDescription',$this->PersonRequestStatusTypeDescription,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}