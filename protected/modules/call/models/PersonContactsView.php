<?php

/**
 * This is the model class for table "person_contacts_view".
 *
 * The followings are the available columns in table 'person_contacts_view':
 * @property string $FIO
 * @property integer $SepcialityID
 * @property integer $EducationFormID
 * @property integer $isBudget
 * @property integer $isContract
 * @property string $SpecName
 * @property string $Contacts
 */
class PersonContactsView extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonContactsView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
         public function primaryKey() {
            return "SepcialityID";
        }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person_contacts_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isBudget', 'required'),
			array('SepcialityID, EducationFormID, isBudget, isContract', 'numerical', 'integerOnly'=>true),
			array('FIO', 'length', 'max'=>302),
			array('SpecName', 'length', 'max'=>315),
			array('Contacts', 'length', 'max'=>341),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FIO, SepcialityID, EducationFormID, isBudget, isContract, SpecName, Contacts', 'safe', 'on'=>'search'),
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
    'FIO' => 'Fio',
    'SepcialityID' => 'Спеціальність',
    'EducationFormID' => 'Education Form',
    'isBudget' => 'Is Budget',
    'isContract' => 'Is Contract',
    'SpecName' => 'Spec Name',
    'Contacts' => 'Contacts',
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
                $criteria->order = "FIO";
		$criteria->compare('FIO',$this->FIO,true);
		$criteria->compare('SepcialityID',$this->SepcialityID);
		$criteria->compare('EducationFormID',$this->EducationFormID);
		$criteria->compare('isBudget',$this->isBudget);
		$criteria->compare('isContract',$this->isContract);
		$criteria->compare('SpecName',$this->SpecName,true);
		$criteria->compare('Contacts',$this->Contacts,true);
                $criteria->compare('RequestNumber',$this->RequestNumber);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                           'pageSize'=>10000,
                       )
		));
	}
}