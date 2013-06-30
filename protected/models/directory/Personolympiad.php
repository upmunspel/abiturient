<?php

/**
 * This is the model class for table "personolympiad".
 *
 * The followings are the available columns in table 'personolympiad':
 * @property integer $idPersonOlympiad
 * @property integer $PersonID
 * @property integer $OlympiadAwarID
 * @property integer $edboID
 *
 * The followings are the available model relations:
 * @property Olympiadsawards $olympiadAwar
 * @property Person $person
 */
class Personolympiad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personolympiad the static model class
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
		return 'personolympiad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PersonID, OlympiadAwarID, edboID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonOlympiad, PersonID, OlympiadAwarID, edboID', 'safe', 'on'=>'search'),
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
			'olympiadAwar' => array(self::BELONGS_TO, 'Olympiadsawards', 'OlympiadAwarID'),
			'person' => array(self::BELONGS_TO, 'Person', 'PersonID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idPersonOlympiad' => 'Id Person Olympiad',
    'PersonID' => 'Person',
    'OlympiadAwarID' => 'Olympiad Awar',
    'edboID' => 'Edbo',
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

		$criteria->compare('idPersonOlympiad',$this->idPersonOlympiad);
		$criteria->compare('PersonID',$this->PersonID);
		$criteria->compare('OlympiadAwarID',$this->OlympiadAwarID);
		$criteria->compare('edboID',$this->edboID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}