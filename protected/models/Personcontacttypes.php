<?php

/**
 * This is the model class for table "personcontacttypes".
 *
 * The followings are the available columns in table 'personcontacttypes':
 * @property integer $idPersonContactType
 * @property string $PersonContactTypeName
 *
 * The followings are the available model relations:
 * @property Personcontacts[] $personcontacts
 */
class Personcontacttypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personcontacttypes the static model class
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
		return 'personcontacttypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonContactType', 'required'),
			array('idPersonContactType', 'numerical', 'integerOnly'=>true),
			array('PersonContactTypeName', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonContactType, PersonContactTypeName', 'safe', 'on'=>'search'),
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
			'personcontacts' => array(self::HAS_MANY, 'Personcontacts', 'PersonContactTypeID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idPersonContactType' => 'Код типу контакту з особою',
    'PersonContactTypeName' => 'Назва типу контакту з особою',
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

		$criteria->compare('idPersonContactType',$this->idPersonContactType);
		$criteria->compare('PersonContactTypeName',$this->PersonContactTypeName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}