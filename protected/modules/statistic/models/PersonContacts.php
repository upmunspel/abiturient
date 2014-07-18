<?php

/**
 * This is the model class for table "personcontacts".
 *
 * The followings are the available columns in table 'personcontacts':
 * @property integer $idPersonContacts
 * @property integer $PersonID
 * @property integer $PersonContactTypeID
 * @property string $Value
 */
class PersonContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonContacts the static model class
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
		return 'personcontacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('idPersonContacts', 'required'),
			array('idPersonContacts, PersonID, PersonContactTypeID', 'numerical', 'integerOnly'=>true),
			array('Value', 'length', 'max'=>50),
                        array('Value', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonContacts, PersonID, PersonContactTypeID, Value', 'safe', 'on'=>'search'),
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
        'contacttype' => array(self::BELONGS_TO, 
            'Personcontacttypes', 'PersonContactTypeID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idPersonContacts' => 'Id Person Contacts',
    'PersonID' => 'Person',
    'PersonContactTypeID' => 'Person Contact Type',
    'Value' => 'Контакт',
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

		$criteria->compare('idPersonContacts',$this->idPersonContacts);
		$criteria->compare('PersonID',$this->PersonID);
		$criteria->compare('PersonContactTypeID',$this->PersonContactTypeID);
		$criteria->compare('Value',$this->Value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}