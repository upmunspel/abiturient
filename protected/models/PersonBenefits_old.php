<?php

/**
 * This is the model class for table "personbenefits".
 *
 * The followings are the available columns in table 'personbenefits':
 * @property integer $idPersonBenefits
 * @property integer $PersonID
 * @property integer $BenefitID
 *
 * The followings are the available model relations:
 * @property documents[] $PersonBenefitDocument
 */
class PersonBenefits_old extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonBenefits the static model class
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
		return 'personbenefits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonBenefits, PersonID, BenefitID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonBenefits, PersonID, BenefitID', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'PersonBenefitDocument', 'PersonBenefitID'),
			
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'idPersonBenefits' => 'Id Person Benefits',
                    'PersonID' => 'Person',
                    'BenefitID' => 'Benefit',
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

		$criteria->compare('idPersonBenefits',$this->idPersonBenefits);
		$criteria->compare('PersonID',$this->PersonID);
		$criteria->compare('BenefitID',$this->BenefitID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       
}