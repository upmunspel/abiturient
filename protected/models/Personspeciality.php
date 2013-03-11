<?php

/**
 * This is the model class for table "personspeciality".
 *
 * The followings are the available columns in table 'personspeciality':
 * @property integer $idPersonSpeciality
 * @property integer $PersonID
 * @property integer $SepcialityID
 * @property integer $PaymentTypeID
 * @property integer $EducationFormID
 * @property integer $QualificationID
 * @property integer $EntranceTypeID
 * @property integer $CourseID
 * @property integer $CausalityID
 * @property integer $isTarget
 * @property integer $isContact
 * @property double $AdditionalBall
 * @property integer $isCopyEntrantDoc
 * @property integer $DocumentSubject1
 * @property integer $DocumentSubject2
 * @property integer $DocumentSubject3
 * @property integer $Exam1ID
 * @property integer $Exam1Ball
 * @property integer $Exam2ID
 * @property integer $Exam2Ball
 * @property integer $Exam3ID
 * @property integer $Exam3Ball
 *
 * The followings are the available model relations:
 * @property Person $person
 * @property Documentsubject $documentSubject2
 * @property Documentsubject $documentSubject3
 * @property Subjects $exam1
 * @property Subjects $exam2
 * @property Subjects $exam3
 * @property Specialities $sepciality
 * @property Personeducationpaymenttypes $paymentType
 * @property Personeducationforms $educationForm
 * @property Qualifications $qualification
 * @property Personenterancetypes $entranceType
 * @property Courses $course
 * @property Causality $causality
 * @property Documentsubject $documentSubject1
 */
class Personspeciality extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personspeciality the static model class
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
		return 'personspeciality';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PersonID, SepcialityID, PaymentTypeID, EducationFormID, QualificationID, EntranceTypeID, CourseID, CausalityID, isTarget, isContact, isCopyEntrantDoc, DocumentSubject1, DocumentSubject2, DocumentSubject3, Exam1ID, Exam1Ball, Exam2ID, Exam2Ball, Exam3ID, Exam3Ball', 'numerical', 'integerOnly'=>true),
			array('AdditionalBall', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonSpeciality, PersonID, SepcialityID, PaymentTypeID, EducationFormID, QualificationID, EntranceTypeID, CourseID, CausalityID, isTarget, isContact, AdditionalBall, isCopyEntrantDoc, DocumentSubject1, DocumentSubject2, DocumentSubject3, Exam1ID, Exam1Ball, Exam2ID, Exam2Ball, Exam3ID, Exam3Ball', 'safe', 'on'=>'search'),
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
			'person' => array(self::BELONGS_TO, 'Person', 'PersonID'),
			'documentSubject2' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject2'),
			'documentSubject3' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject3'),
			'exam1' => array(self::BELONGS_TO, 'Subjects', 'Exam1ID'),
			'exam2' => array(self::BELONGS_TO, 'Subjects', 'Exam2ID'),
			'exam3' => array(self::BELONGS_TO, 'Subjects', 'Exam3ID'),
			'sepciality' => array(self::BELONGS_TO, 'Specialities', 'SepcialityID'),
			'paymentType' => array(self::BELONGS_TO, 'Personeducationpaymenttypes', 'PaymentTypeID'),
			'educationForm' => array(self::BELONGS_TO, 'Personeducationforms', 'EducationFormID'),
			'qualification' => array(self::BELONGS_TO, 'Qualifications', 'QualificationID'),
			'entranceType' => array(self::BELONGS_TO, 'Personenterancetypes', 'EntranceTypeID'),
			'course' => array(self::BELONGS_TO, 'Courses', 'CourseID'),
			'causality' => array(self::BELONGS_TO, 'Causality', 'CausalityID'),
			'documentSubject1' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject1'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idPersonSpeciality' => 'Id Person Speciality',
    'PersonID' => 'Person',
    'SepcialityID' => 'Напрям підготовки',
    'PaymentTypeID' => 'Форма оплати',
    'EducationFormID' => 'Форма навчання',
    'QualificationID' => 'Навчальний рівень',
    'EntranceTypeID' => 'Форма вступу',
    'CourseID' => 'Курс',
    'CausalityID' => 'Причина відсутності сертифікату',
    'isTarget' => 'Цільовий вступ',
    'isContact' => 'Проп-ти контракт',
    'AdditionalBall' => 'Додатковий бал',
    'isCopyEntrantDoc' => 'Копія',
    'DocumentSubject1' => 'Предмет сертифікату',
    'DocumentSubject2' => 'Document Subject2',
    'DocumentSubject3' => 'Document Subject3',
    'Exam1ID' => 'Екзамен',
    'Exam1Ball' => 'Бал',
    'Exam2ID' => 'Exam2',
    'Exam2Ball' => 'Exam2 Ball',
    'Exam3ID' => 'Exam3',
    'Exam3Ball' => 'Exam3 Ball',
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
		$criteria->compare('PersonID',$this->PersonID);
		$criteria->compare('SepcialityID',$this->SepcialityID);
		$criteria->compare('PaymentTypeID',$this->PaymentTypeID);
		$criteria->compare('EducationFormID',$this->EducationFormID);
		$criteria->compare('QualificationID',$this->QualificationID);
		$criteria->compare('EntranceTypeID',$this->EntranceTypeID);
		$criteria->compare('CourseID',$this->CourseID);
		$criteria->compare('CausalityID',$this->CausalityID);
		$criteria->compare('isTarget',$this->isTarget);
		$criteria->compare('isContact',$this->isContact);
		$criteria->compare('AdditionalBall',$this->AdditionalBall);
		$criteria->compare('isCopyEntrantDoc',$this->isCopyEntrantDoc);
		$criteria->compare('DocumentSubject1',$this->DocumentSubject1);
		$criteria->compare('DocumentSubject2',$this->DocumentSubject2);
		$criteria->compare('DocumentSubject3',$this->DocumentSubject3);
		$criteria->compare('Exam1ID',$this->Exam1ID);
		$criteria->compare('Exam1Ball',$this->Exam1Ball);
		$criteria->compare('Exam2ID',$this->Exam2ID);
		$criteria->compare('Exam2Ball',$this->Exam2Ball);
		$criteria->compare('Exam3ID',$this->Exam3ID);
		$criteria->compare('Exam3Ball',$this->Exam3Ball);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}