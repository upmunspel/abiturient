<?php

/**
 * This is the model class for table "personspeciality".
 *
 * The followings are the available columns in table 'personspeciality':
 * @property integer $idPersonSpeciality
 * @property integer $RequestNumber
 * @property integer $PersonID
 * @property integer $SepcialityID
 * @property integer $PaymentTypeID
 * @property integer $EducationFormID
 * @property integer $QualificationID
 * @property integer $EntranceTypeID
 * @property integer $CourseID
 * @property integer $CausalityID
 * @property integer $CoursedpID
 * @property integer $OlympiadID
 * @property integer $GraduatedUniversitieID
 * @property integer $GraduatedSpecialitieID
 * @property string  $GraduatedSpeciality
 * @property integer $PersonDocumentsAwardsTypesID
 * @property integer $isTarget
 * @property integer $isContract
 * @property integer $isBudget
 * @property integer $isNeedHostel
 * @property integer $isNotCheckAttestat
 * @property integer $isForeinghEntrantDocument
 * @property double  $AdditionalBall
 * @property double  $CoursedpBall
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
 * @property Documentsubject $documentSubject1
 * @property Documentsubject $documentSubject2
 * @property Documentsubject $documentSubject3
 * @property Subjects $exam1
 * @property Subjects $exam2
 * @property Subjects $exam3
 * @property Olympiadsawards $olymp
 * @property Specialities $sepciality
 * @property Personeducationpaymenttypes $paymentType
 * @property Personeducationforms $educationForm
 * @property Qualifications $qualification
 * @property Personenterancetypes $entranceType
 * @property Courses $course
 * @property Causality $causality
 * @property integer $StatusID
 * @property Personrequeststatustypes $status
 * @property integer $RequestFromEB
 * @property integer $Quota1
 * @property integer $Quota2
 * 
 * Параметри, що опосередковано відносяться до БД
 * @property string $NAME - ПІБ з видаленими незначущими пробілами
 * @property string $SPEC - Спеціальність (разом із спеціалізацією і формою навчання)

 */
class Personspeciality extends ActiveRecord {
  
  public $NAME;
  public $SPEC;
  public $KOATUU;
  public $ZNO;
  public $EXAM;
  public $DOCS;
  public $BENEFITS;
  public $BENTYPES;
  public $DIRECTION;
  
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Personspeciality the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  public function tableName() {
    return 'personspeciality';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('PersonID, SepcialityID,  EducationFormID, 
                               QualificationID, EntranceTypeID, CourseID, CausalityID, 
                               isContract, isBudget, isCopyEntrantDoc, DocumentSubject1, 
                               DocumentSubject2, DocumentSubject3, 
                               Exam1ID, Exam1Ball, Exam2ID, Exam2Ball,
                               Exam3ID, Exam3Ball, isHigherEducation, SkipDocumentValue', 'numerical', 'integerOnly' => true),
        array("AdditionalBallComment,  CoursedpID, Quota1,Quota2, OlympiadID, isNotCheckAttestat, isForeinghEntrantDocument, PersonDocumentsAwardsTypesID, edboID, RequestFromEB, StatusID", 'safe'),
        array("Exam1ID", 'required', 'on' => "SHORTFORM"),
        array("EntranceTypeID", "required", "except" => "SHORTFORM"),
        //array("CausalityID",  "default", "value"=>100,"except"=>"SHORTFORM"),
        array("Exam1Ball, Exam2Ball, Exam3Ball", 'numerical',
            "max" => 200, "min" => 1, "allowEmpty" => true, 'except' => 'ZNOEXAM, EXAM'),
        array("AdditionalBall, CoursedpBall", 'numerical',
            "max" => 200, "min" => 1, "allowEmpty" => true),
        array('PersonID, SepcialityID,  EducationFormID, 
                               QualificationID,  CourseID, isContract, 
                               isCopyEntrantDoc, EntrantDocumentID, isNeedHostel', "required"),
        array("DocumentSubject1, DocumentSubject2, DocumentSubject3", "required", "on" => "ZNO"),
        array("Exam1ID, Exam2ID, Exam3ID, CausalityID", "required", "on" => "EXAM"),
        array("Exam1Ball, Exam2Ball, Exam3Ball", 'numerical', "max" => 200, "min" => 1, "allowEmpty" => true, "on" => "EXAM"),
        array("CausalityID", "required", "on" => "ZNOEXAM"),
        array("Exam1ID, Exam2ID, Exam3ID, DocumentSubject1, DocumentSubject2, DocumentSubject3", "valididateZnoExam", "on" => "ZNOEXAM"),
        array("Exam1Ball, Exam2Ball, Exam3Ball", 'numerical', "max" => 200, "min" => 1, "allowEmpty" => true, "on" => "ZNOEXAM"),
        // DocumentSubject1, DocumentSubject2, DocumentSubject3, 
        //  Exam1ID, Exam1Ball, Exam2ID, Exam2Ball, Exam3ID, Exam3Ball', 'numerical', 'integerOnly'=>true),
        //array('AdditionalBall', 'numerical'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('idPersonSpeciality, PersonID, SepcialityID,  EducationFormID, QualificationID, EntranceTypeID, CourseID, CausalityID, isContract, AdditionalBall, isCopyEntrantDoc, DocumentSubject1, DocumentSubject2, DocumentSubject3, Exam1ID, Exam1Ball, Exam2ID, Exam2Ball, Exam3ID, Exam3Ball', 'safe', 'on' => 'search'),
        array('CustomerName,DocCustumer,AcademicSemesterID,CustomerAddress,CustomerPaymentDetails,DateОfСontract,PaymentDate', 'safe'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'person' => array(self::BELONGS_TO, 'Person', 'PersonID'),
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
        'documentSubject2' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject2'),
        'documentSubject3' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject3'),
        'olymp' => array(self::BELONGS_TO, 'Olympiadsawards', 'OlympiadID'),
        'status' => array(self::BELONGS_TO, 'Personrequeststatustypes', 'StatusID'),
        'edbo' => array(self::BELONGS_TO, 'EdboData', 'edboID'),
//                     
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'idPersonSpeciality' => 'Id Person Speciality',
        'PersonID' => 'Person',
        'SepcialityID' => 'Спеціальність',
        'PaymentTypeID' => 'Форма оплати',
        'EducationFormID' => 'Форма навчання',
        'QualificationID' => 'Навчальний рівень',
        'EntranceTypeID' => 'Форма вступу',
        'CourseID' => 'Курс',
        'CausalityID' => 'Причина відсутності сертифікату',
        'isTarget' => 'Цільовий вступ',
        'isContract' => 'Контракт',
        'isBudget' => 'Бюджет',
        'isNeedHostel' => 'Потрібен гуртожиток',
        'AdditionalBall' => 'Додатковий бал',
        'EntrantDocumentID' => 'Документ-основа вступу',
        'isCopyEntrantDoc' => 'Копія',
        'DocumentSubject1' => 'Предмет сертифікату',
        'DocumentSubject2' => 'Предмет сертифікату',
        'DocumentSubject3' => 'Предмет сертифікату',
        'Exam1ID' => 'Екзамен 1',
        'Exam1Ball' => 'Бал 1',
        'Exam2ID' => 'Екзамен 2',
        'Exam2Ball' => 'Бал 2',
        'Exam3ID' => 'Екзамен 3',
        'Exam3Ball' => 'Бал 3',
        'isHigherEducation' => 'Освіта аналогічного кваліфікаційного рівня',
        'SkipDocumentValue' => 'Бал док-та не враховується',
        'AdditionalBallComment' => 'Коментар до додаткового балу',
        'CoursedpID' => 'Курси довузівської підготовки',
        'CoursedpBall' => 'Бал за курси',
        'OlympiadId' => 'Олімпіади',
        'Quota1' => 'Квота (с-ка міс-ть)',
        'Quota2' => 'Квота (держ. сл-ба)',
        'RequestNumber' => "Номер заявки",
        'PersonRequestNumber' => "Номер справи",
        "PersonDocumentsAwardsTypesID" => "Відзнака",
        'isForeinghEntrantDocument' => "Іноземн. док-т",
        'OlympiadID' => "Олимпиада",
        'isNotCheckAttestat' => "Не перевіряти",
        'GraduatedUniversitieID' => "ВНЗ, який закінчив",
        'GraduatedSpecialitieID' => "Напрямок (спеціальність), яку закінчив",
        "GraduatedSpeciality" => "Напрямок (спеціальність), яку закінчив",
        'RequestFromEB' => 'Эл-на за-ка',
        "edboID" => "ЄДБО Код",
        "StatusID" => "Статус заявки",
        "SPEC" => "Ключові слова через пробіл для вибірки за спеціальністю",
        "NAME" => "ПІБ : ключові слова через пробіл",
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('idPersonSpeciality', $this->idPersonSpeciality);
    $criteria->compare('PersonID', $this->PersonID);
    $criteria->compare('SepcialityID', $this->SepcialityID);
    $criteria->compare('PaymentTypeID', $this->PaymentTypeID);
    $criteria->compare('EducationFormID', $this->EducationFormID);
    $criteria->compare('QualificationID', $this->QualificationID);
    $criteria->compare('EntranceTypeID', $this->EntranceTypeID);
    $criteria->compare('CourseID', $this->CourseID);
    $criteria->compare('CausalityID', $this->CausalityID);
    $criteria->compare('isTarget', $this->isTarget);
    $criteria->compare('isContact', $this->isContact);
    $criteria->compare('AdditionalBall', $this->AdditionalBall);
    $criteria->compare('isCopyEntrantDoc', $this->isCopyEntrantDoc);
    $criteria->compare('DocumentSubject1', $this->DocumentSubject1);
    $criteria->compare('DocumentSubject2', $this->DocumentSubject2);
    $criteria->compare('DocumentSubject3', $this->DocumentSubject3);
    $criteria->compare('Exam1ID', $this->Exam1ID);
    $criteria->compare('Exam1Ball', $this->Exam1Ball);
    $criteria->compare('Exam2ID', $this->Exam2ID);
    $criteria->compare('Exam2Ball', $this->Exam2Ball);
    $criteria->compare('Exam3ID', $this->Exam3ID);
    $criteria->compare('Exam3Ball', $this->Exam3Ball);

    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
    ));
  }
  
  /**
   * Я не знаю, для чого це. Валєра знає.
   * @param type $lol WTF
   * @author Veleriy Efimov <valera_e@ukr.net>
   */
  public function loadOnlineStatementFromJSON($lol) {
    //$json_string = preg_replace("/[+-]?\d+\.\d+/", '"\0"', $json_string ); 

    /* $objarr = CJSON::decode($json_string);

      if (!empty($this->codeU)){
      Yii::app()->session[$this->codeU."-documents"] = serialize($objarr);
      }

      if ( trim($json_string) == "0" && empty($json_string) && count($objarr) == 0) return;

      foreach($objarr as $item){
      $val = (object)$item; */
    $model = $this;
//1	Код ЄДБО

    $model->edboID = $lol;
    /* if ($val->id_Type == 7)   {
      $model->entrantdoc = new Documents();
      $model->entrantdoc->TypeID = $val->id_Type;
      $model->entrantdoc->edboID = $val->id_Document;
      $model->entrantdoc->AtestatValue=$val->attestatValue;
      $model->entrantdoc->Numbers=$val->number;
      $model->entrantdoc->Series=$val->series;
      $model->entrantdoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
      $model->entrantdoc->ZNOPin = $val->znoPin;
      $model->entrantdoc->Issued = $val->issued;
      }
      } */
  }

}
