<?php

/**
 * This is the model class for table "personspec_specialists".
 *
 * The followings are the available columns in table 'personspec_specialists':
 * @property integer $idPersonSpeciality
 * @property string $FIO
 * @property string $FacultetFullName
 * @property string $Specialnost
 * @property string $Kontrakt
 * @property string $Budget
 * @property string $PersonDocumentTypesName
 * @property double $evaluation
 * @property string $Status
 */
class PersonspecSpecialists extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonspecSpecialists the static model class
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
		return 'personspec_specialists';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonSpeciality', 'numerical', 'integerOnly'=>true),
			array('evaluation', 'numerical'),
			array('FIO', 'length', 'max'=>302),
			array('FacultetFullName', 'length', 'max'=>255),
			array('Specialnost', 'length', 'max'=>264),
			array('Kontrakt', 'length', 'max'=>21),
			array('Budget', 'length', 'max'=>19),
			array('PersonDocumentTypesName', 'length', 'max'=>100),
			array('Status', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonSpeciality, FIO, FacultetFullName, Specialnost, Kontrakt, Budget, PersonDocumentTypesName, evaluation, Status', 'safe', 'on'=>'search'),
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
    'idPersonSpeciality'=>'idPersonSpeciality',
    'FIO' => 'ПІБ',
    'FacultetFullName' => 'Факультет',
    'Specialnost' => 'Спеціальність',
    'Kontrakt' => 'Заявка на контракт?',
    'Budget' => 'Заявка на бюджет?',
    'PersonDocumentTypesName' => 'Тип документу',
    'evaluation' => 'Бал',
    'Status' => 'Статус заявки',
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
		$criteria->compare('FIO',$this->FIO,true);
		$criteria->compare('FacultetFullName',$this->FacultetFullName,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('Kontrakt',$this->Kontrakt,true);
		$criteria->compare('Budget',$this->Budget,true);
		$criteria->compare('PersonDocumentTypesName',$this->PersonDocumentTypesName,true);
		$criteria->compare('evaluation',$this->evaluation);
		$criteria->compare('Status',$this->Status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>20000,
                        )
		));
	}
}