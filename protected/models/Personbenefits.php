<?php

/**
 * This is the model class for table "personbenefits".
 *
 * The followings are the available columns in table 'personbenefits':
 * @property integer $idPersonBenefits
 * @property integer $PersonID
 * @property integer $BenefitID
 * @property string $Series
 * @property string $Numbers
 * @property string $Issued
 * @property string $Modified
 * @property integer $SysUserID
 *
 * The followings are the available model relations:
 * @property Personbenefitdocument[] $personbenefitdocuments
 * @property Person $person
 * @property Benefit $benefit
 */
class Personbenefits extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personbenefits the static model class
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
			array('Series, Numbers, Issued, Numbers','required'),
			array('PersonID, BenefitID', 'numerical', 'integerOnly'=>true),
			array('Series, Numbers', 'length', 'max'=>50),
			array('Issued', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonBenefits, PersonID, BenefitID, Series, Numbers, Issued, Modified, SysUserID', 'safe', 'on'=>'search'),
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
			'personbenefitdocuments' => array(self::HAS_MANY, 'Personbenefitdocument', 'PersonBenefitID'),
			'person' => array(self::BELONGS_TO, 'Person', 'PersonID'),
			'benefit' => array(self::BELONGS_TO, 'Benefit', 'BenefitID'),
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
    'BenefitID' => 'Назва пільги',
    'Series' => 'Серія ',
    'Numbers' => 'Номер ',
    'Issued' => 'Ким виданий',
    'Modified' => 'Modified',
    'SysUserID' => 'Sys User',
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
		$criteria->compare('Series',$this->Series,true);
		$criteria->compare('Numbers',$this->Numbers);
		$criteria->compare('Issued',$this->Issued,true);
		$criteria->compare('Modified',$this->Modified,true);
		$criteria->compare('SysUserID',$this->SysUserID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}