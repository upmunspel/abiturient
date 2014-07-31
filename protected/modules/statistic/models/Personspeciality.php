<?php

/**
 * This is the model class for table "personspeciality".
 *
 * Параметри, що опосередковано відносяться до БД
 * @property string $NAME - ПІБ з видаленими незначущими пробілами
 * @property string $SPEC - Спеціальність (разом із спеціалізацією і формою навчання)
 * @property string $KOATUU - адреса персони КОАТУУ разом з типом
 * @property string $ZNO - дані сертифікатів ЗНО
 * @property string $EXAM - дані екзамени
 * @property string $DOCS - дані усих документів персони
 * @property string $BENEFITS - дані усих пільг персони
 * @property string $BENTYPES - усі типи пільг персони
 * @property string $DOCTYPES - усі типи документів персони
 * @property string $DIRECTION - напрям
 * @property string $PersonCase - номер справи

 */
class Personspeciality extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Documents the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'personspeciality';
    }
  
  public $NAME;
  public $SPEC;
  public $KOATUU;
  public $ZNO;
  public $EXAM;
  public $DOCS;
  public $BENEFITS;
  public $BENTYPES;
  public $DOCTYPES;
  public $DIRECTION;
  public $PersonCase;
  
    /**
     * @return string Префікс у номері справи
     */
    public function getRequestPrefix() {
        $prefix = "";
        switch ($this->QualificationID) {
            case 1: $prefix = "Б";
                break;
            case 2: $prefix = "CМ";
                break;
            case 3: $prefix = "СМ";
                break;
            case 4: $prefix = "МС";
                break;
        }

        $prefix .= $this->CourseID . "-";

        return $prefix;
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
        'entrantdoc' => array(self::BELONGS_TO, 'Documents', 'EntrantDocumentID'),
        'course' => array(self::BELONGS_TO, 'Courses', 'CourseID'),
        'causality' => array(self::BELONGS_TO, 'Causality', 'CausalityID'),
        'documentSubject1' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject1'),
        'documentSubject2' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject2'),
        'documentSubject3' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject3'),
        'olymp' => array(self::BELONGS_TO, 'Olympiadsawards', 'OlympiadID'),
        'status' => array(self::BELONGS_TO, 'Personrequeststatustypes', 'StatusID'),
        'edbo' => array(self::BELONGS_TO, 'EdboData', 'edboID'),
        'coursedp' => array(self::BELONGS_TO, 'Coursedp', 'CoursedpID'),
        'pbenefits' => array(self::HAS_MANY, 'Personspecialitybenefits', 'PersonSpecialityID'),
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
        'RequestNumber' => "Номер заяви",
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
        "StatusID" => "Статус заяви",
        "SPEC" => "Ключові слова через пробіл для вибірки за спеціальністю",
        "NAME" => "ПІБ : ключові слова через пробіл",
    );
  }
}
