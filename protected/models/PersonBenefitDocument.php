<?php

/**
 * This is the model class for table "personbenefitdocument".
 *
 * The followings are the available columns in table 'personbenefitdocument':
 * @property integer $idPersonBenefitDocument
 * @property integer $PersonBenefitID
 * @property integer $DocumentID
 *
 * The followings are the available model relations:
 * @property Personbenefits $personBenefit
 * @property Documents $document
 */
class PersonBenefitDocument extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonBenefitDocument the static model class
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
		return 'personbenefitdocument';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PersonBenefitID, DocumentID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonBenefitDocument, PersonBenefitID, DocumentID', 'safe', 'on'=>'search'),
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
			'personBenefit' => array(self::BELONGS_TO, 'Personbenefits', 'PersonBenefitID'),
			'document' => array(self::BELONGS_TO, 'Documents', 'DocumentID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idPersonBenefitDocument' => 'Id Person Benefit Document',
    'PersonBenefitID' => 'Person Benefit',
    'DocumentID' => 'Document',
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

		$criteria->compare('idPersonBenefitDocument',$this->idPersonBenefitDocument);
		$criteria->compare('PersonBenefitID',$this->PersonBenefitID);
		$criteria->compare('DocumentID',$this->DocumentID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}