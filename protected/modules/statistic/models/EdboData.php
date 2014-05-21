<?php

/**
 * This is the model class for table "edbo_data".
 *
 * The followings are the available columns in table 'edbo_data':
 * @property integer $ID
 * @property string $PIB
 * @property integer $EZ
 * @property string $Status
 * @property string $Created
 * @property string $PersonCase
 * @property integer $Course
 * @property string $EduForm
 * @property string $EduQualification
 * @property integer $B
 * @property integer $K
 * @property double $RatingPoints
 * @property string $SpecCode
 * @property string $Direction
 * @property string $SpecialCode
 * @property string $Speciality
 * @property string $Specialization
 * @property string $StructBranch
 * @property string $Changed
 * @property string $DetailPoints
 * @property string $DocType
 * @property string $DocSeria
 * @property string $DocNumber
 * @property double $DocPoint
 * @property string $DocDate
 * @property string $Honours
 * @property string $EntranceType
 * @property string $EntranceReason
 * @property integer $Benefit
 * @property integer $PriorityEntry
 * @property integer $Quota
 * @property string $Language
 * @property integer $OI
 * @property string $Category
 * @property string $Gender
 * @property string $Citizen
 * @property string $Country
 * @property string $TH
 * @property string $Tel
 * @property string $MobTel
 * @property integer $OD
 * @property integer $NeedHostel
 * @property string $EntranceCodes
 * 
 * @property file $csv_file File for uploading edbo data
 */
class EdboData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EdboData the static model class
	 */
  
  public $csv_file;
  
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'edbo_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID', 'required'),
			array('ID, EZ, Course, B, K, Benefit, PriorityEntry, Quota, OI, OD, NeedHostel', 'numerical', 'integerOnly'=>true),
			array('RatingPoints, DocPoint', 'numerical'),
			array('PIB', 'length', 'max'=>255),
			array('Status, Created, EduQualification, SpecCode, SpecialCode, Changed, DocNumber, Honours, Category, Gender, Citizen, TH, Tel, MobTel', 'length', 'max'=>64),
			array('PersonCase, EduForm, DocSeria', 'length', 'max'=>16),
			array('Direction, Speciality, Specialization, StructBranch, DetailPoints, DocType, EntranceType, EntranceReason, Language', 'length', 'max'=>128),
			array('DocDate, EntranceCodes', 'length', 'max'=>32),
			array('Country', 'length', 'max'=>192),
      array('csv_file', 'file', 'types' => 'csv', 'maxSize' => 1024 * 1024 * 20, 
          'tooLarge' => 'Перевищена межа у 20MB !', 'on' => 'upload'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, PIB, EZ, Status, Created, PersonCase, Course, EduForm, EduQualification, B, K, RatingPoints, SpecCode, Direction, SpecialCode, Speciality, Specialization, StructBranch, Changed, DetailPoints, DocType, DocSeria, DocNumber, DocPoint, DocDate, Honours, EntranceType, EntranceReason, Benefit, PriorityEntry, Quota, Language, OI, Category, Gender, Citizen, Country, TH, Tel, MobTel, OD, NeedHostel, EntranceCodes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
  		  'ID' => 'ID',
  		  'PIB' => 'Pib',
  		  'EZ' => 'Ez',
  		  'Status' => 'Status',
  		  'Created' => 'Created',
  		  'PersonCase' => 'Person Case',
  		  'Course' => 'Course',
  		  'EduForm' => 'Edu Form',
  		  'EduQualification' => 'Edu Qualification',
  		  'B' => 'B',
  		  'K' => 'K',
  		  'RatingPoints' => 'Rating Points',
  		  'SpecCode' => 'Spec Code',
  		  'Direction' => 'Direction',
  		  'SpecialCode' => 'Special Code',
  		  'Speciality' => 'Speciality',
  		  'Specialization' => 'Specialization',
  		  'StructBranch' => 'Struct Branch',
  		  'Changed' => 'Changed',
  		  'DetailPoints' => 'Detail Points',
  		  'DocType' => 'Doc Type',
  		  'DocSeria' => 'Doc Seria',
  		  'DocNumber' => 'Doc Number',
  		  'DocPoint' => 'Doc Point',
  		  'DocDate' => 'Doc Date',
  		  'Honours' => 'Honours',
  		  'EntranceType' => 'Entrance Type',
  		  'EntranceReason' => 'Entrance Reason',
  		  'Benefit' => 'Benefit',
  		  'PriorityEntry' => 'Priority Entry',
  		  'Quota' => 'Quota',
  		  'Language' => 'Language',
  		  'OI' => 'Oi',
  		  'Category' => 'Category',
  		  'Gender' => 'Gender',
  		  'Citizen' => 'Citizen',
  		  'Country' => 'Country',
  		  'TH' => 'Th',
  		  'Tel' => 'Tel',
  		  'MobTel' => 'Mob Tel',
  		  'OD' => 'Od',
  		  'NeedHostel' => 'Need Hostel',
  		  'EntranceCodes' => 'Entrance Codes',
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

    $criteria->compare('ID',$this->ID);
    $criteria->compare('PIB',$this->PIB,true);
    $criteria->compare('EZ',$this->EZ);
    $criteria->compare('Status',$this->Status,true);
    $criteria->compare('Created',$this->Created,true);
    $criteria->compare('PersonCase',$this->PersonCase,true);
    $criteria->compare('Course',$this->Course);
    $criteria->compare('EduForm',$this->EduForm,true);
    $criteria->compare('EduQualification',$this->EduQualification,true);
    $criteria->compare('B',$this->B);
    $criteria->compare('K',$this->K);
    $criteria->compare('RatingPoints',$this->RatingPoints);
    $criteria->compare('SpecCode',$this->SpecCode,true);
    $criteria->compare('Direction',$this->Direction,true);
    $criteria->compare('SpecialCode',$this->SpecialCode,true);
    $criteria->compare('Speciality',$this->Speciality,true);
    $criteria->compare('Specialization',$this->Specialization,true);
    $criteria->compare('StructBranch',$this->StructBranch,true);
    $criteria->compare('Changed',$this->Changed,true);
    $criteria->compare('DetailPoints',$this->DetailPoints,true);
    $criteria->compare('DocType',$this->DocType,true);
    $criteria->compare('DocSeria',$this->DocSeria,true);
    $criteria->compare('DocNumber',$this->DocNumber,true);
    $criteria->compare('DocPoint',$this->DocPoint);
    $criteria->compare('DocDate',$this->DocDate,true);
    $criteria->compare('Honours',$this->Honours,true);
    $criteria->compare('EntranceType',$this->EntranceType,true);
    $criteria->compare('EntranceReason',$this->EntranceReason,true);
    $criteria->compare('Benefit',$this->Benefit);
    $criteria->compare('PriorityEntry',$this->PriorityEntry);
    $criteria->compare('Quota',$this->Quota);
    $criteria->compare('Language',$this->Language,true);
    $criteria->compare('OI',$this->OI);
    $criteria->compare('Category',$this->Category,true);
    $criteria->compare('Gender',$this->Gender,true);
    $criteria->compare('Citizen',$this->Citizen,true);
    $criteria->compare('Country',$this->Country,true);
    $criteria->compare('TH',$this->TH,true);
    $criteria->compare('Tel',$this->Tel,true);
    $criteria->compare('MobTel',$this->MobTel,true);
    $criteria->compare('OD',$this->OD);
    $criteria->compare('NeedHostel',$this->NeedHostel);
    $criteria->compare('EntranceCodes',$this->EntranceCodes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}