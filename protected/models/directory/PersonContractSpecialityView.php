<?php

/**
 * This is the model class for table "person_contract_speciality_view".
 *
 * The followings are the available columns in table 'person_contract_speciality_view':
 * @property integer $idPersonSpeciality
 * @property integer $idPerson
 * @property string $FIO
 * @property string $SpecCodeName
 * @property integer $EducationFormID
 * @property integer $SepcialityID
 */
class PersonContractSpecialityView extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonContractSpecialityView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function primaryKey() {
            return "idPersonSpeciality";
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person_contract_speciality_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonSpeciality, idPerson, EducationFormID, SepcialityID', 'numerical', 'integerOnly'=>true),
			array('FIO', 'length', 'max'=>302),
			array('SpecCodeName', 'length', 'max'=>316),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonSpeciality, idPerson, FIO, SpecCodeName, EducationFormID, SepcialityID', 'safe', 'on'=>'search'),
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
    'idPersonSpeciality' => 'Id Person Speciality',
    'idPerson' => 'Id Person',
    'FIO' => 'Fio',
    'SpecCodeName' => 'Spec Code Name',
    'EducationFormID' => 'Education Form',
    'SepcialityID' => 'Sepciality',
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

		$criteria->compare('idPersonSpeciality',$this->idPersonSpeciality);
		$criteria->compare('idPerson',$this->idPerson);
		$criteria->compare('FIO',$this->FIO,true);
		$criteria->compare('SpecCodeName',$this->SpecCodeName,true);
		$criteria->compare('EducationFormID',$this->EducationFormID);
		$criteria->compare('SepcialityID',$this->SepcialityID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}