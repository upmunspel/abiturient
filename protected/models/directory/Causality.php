<?php

/**
 * This is the model class for table "causality".
 *
 * The followings are the available columns in table 'causality':
 * @property integer $idCausality
 * @property string $CausalityName
 * @property string $CausalityShortName
 *
 * The followings are the available model relations:
 * @property Personspeciality[] $personspecialities
 */
class Causality extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Causality the static model class
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
		return 'causality';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCausality', 'required'),
			array('idCausality', 'numerical', 'integerOnly'=>true),
			array('CausalityName', 'length', 'max'=>250),
			array('CausalityShortName', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idCausality, CausalityName, CausalityShortName', 'safe', 'on'=>'search'),
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
			'personspecialities' => array(self::HAS_MANY, 'Personspeciality', 'CausalityID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idCausality' => 'Id Causality',
    'CausalityName' => 'Causality Name',
    'CausalityShortName' => 'Causality Short Name',
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

		$criteria->compare('idCausality',$this->idCausality);
		$criteria->compare('CausalityName',$this->CausalityName,true);
		$criteria->compare('CausalityShortName',$this->CausalityShortName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}