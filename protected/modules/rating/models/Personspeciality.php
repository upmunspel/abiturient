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
 * @property Facultets $searchFaculty - модель для пошуку факультета
 * @property Benefits $searchBenefit - модель для пошуку пільг
 * @property mixed $searchID - ІД персони або заявки, або ЄДЕБО чи статус заявки
 * @property string $NAME - ПІБ з видаленими незначущими пробілами
 * @property string $SPEC - Спеціальність (разом із спеціалізацією і формою навчання)
 * @property integer $rating_order_mode - прапорець: чи потрібно сортувати для рейтингу
 * @property integer $status_confirmed - прапорець: вибрати лише зі статусом "допущено"
 * @property integer $status_committed - прапорець: вибрати лише зі статусом "рекомендовано"
 * @property integer $status_submitted - прапорець: вибрати лише зі статусом "до наказу"
 * @property integer $ext_param - 1=> вибрати лише ті дані, що не співпадають з даними із edbo_data,
 *                                2=> вибрати лише ті дані, у яких немає зв"язку із таблицею edbo_data,
 *                                3=> вибрати дані, у яких є зв"язок із таблицею edbo_data,
 *                                4=> Неспівпадання з даними ЄДЕБО : лише копія/оригінал,
 *                                5=> Неспівпадання з даними ЄДЕБО : лише бали (зн. документа),
 *                                6=> Неспівпадання з даними ЄДЕБО : лише відмітки пільгового вступу,
 * @property integer $page_size - кількість записів, що відображаються на одній сторінці
 * @property string $DocTypes - типи документів (розділені через ;)
 * @property string $BenefitList - дані про пільги (розділені через ;;)
 * @property string $idBenefitList - ІН пільг (розділені через ;;)
 * @property string $isOutOfCompList - дані про те, чи надає пільга право вступу поза конкурсом (розділені через ;;)
 * @property string $isExtraEntryList - дані про те, чи надає пільга право вступу першочергово (розділені через ;;)
 * @property integer $isOutOfComp - чи є заявка з пільгою позаконкурсного вступу
 * @property integer $isExtraEntry - чи є заявка з пільгою першочергового вступу
 * @property integer[] $rating_counter - статичний масив лічильників для формування рейтингу
 * @property integer $is_rating_order = $rating_order_mode (статична)
 */
class Personspeciality extends ActiveRecord {
  public $searchFaculty;
  public $searchBenefit;
  
  public $searchID;
  public $NAME;
  public $SPEC;
  public $ComputedPoints;
  public $DateFrom;
  public $DateTo;
  public $ZnoDocValue;
  public $PointDocValue;
  
  public $rating_order_mode;
  public $status_confirmed;
  public $status_committed;
  public $status_submitted;
  
  public $ext_param;
  public $page_size;
  public $DocTypes;
  public $BenefitList;
  public $idBenefitList;
  public $isOutOfCompList;
  public $isExtraEntryList;
  public $isOutOfComp;
  public $isExtraEntry;
  
  private static $rating_counter = array();
  public static $is_rating_order = false;

  public static $C_QUOTA = 3;
  public static $C_OUTOFCOMPETITION = 2;
  public static $C_BUDGET = 1;
  public static $C_CONTRACT = 0;
  
  
  public static $PointMap = array();
  public static $DocTypeNames = array();
  
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Personspeciality the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }
  
  public static function getPointMap(){
    //таблиця відповідностей значення у 12-бальній шкалі значенню у 200-бальній шкалі
    if (empty(Personspeciality::model()->PointMap)){
      Personspeciality::model()->PointMap = CHtml::ListData(Atestatvalue::model()->findAll(),'AtestatValue','ZnoValue');
    }
    return Personspeciality::model()->PointMap;
  }

  public static function getPersonDocTypes(){
    //типи документів персони
    if (empty(Personspeciality::model()->DocTypeNames)){
      Personspeciality::model()->DocTypeNames = CHtml::ListData(PersonDocumentTypes::model()->findAll(),
              'idPersonDocumentTypes','PersonDocumentTypesName');
    }
    return Personspeciality::model()->DocTypeNames;
  }
  
  /**
   * Встановлюються лічильники для формування рейтингу
   * @param integer $_contract_counter - лічильник для контрактників
   * @param integer $_budget_counter - лічильник для бюджетників
   * @param integer $_pzk_counter - лічильник для пільговиків поза конкурсом
   * @param integer $_quota_counter - лічильник для цільовиків
   */
  public static function setCounters($_contract_counter, $_budget_counter, $_pzk_counter, $_quota_counter){
    Personspeciality::$rating_counter[Personspeciality::$C_CONTRACT] = $_contract_counter;
    Personspeciality::$rating_counter[Personspeciality::$C_BUDGET] = $_budget_counter;
    Personspeciality::$rating_counter[Personspeciality::$C_OUTOFCOMPETITION] = $_pzk_counter;
    Personspeciality::$rating_counter[Personspeciality::$C_QUOTA] = $_quota_counter;
  }
  
  /**
   * Віднімає один від певного лічильника і повертає старе значення.
   * Якщо лічильник дорівнює нулю або невизначений, повертає 0.
   * @param integer $counter_index
   * @return integer
   */
  public static function decrementCounter($counter_index){
    if (isset(Personspeciality::$rating_counter[$counter_index])){
      $old_value = Personspeciality::$rating_counter[$counter_index];
      if ($old_value > 0){
        $new_value = $old_value - 1;
        Personspeciality::$rating_counter[$counter_index] = $new_value;
        return $old_value;
      }
    }
    return 0;
  }
  
  /**
   * Повертає значення лічильників для рейтингу у вигляді асиву.
   * @return integer[]
   */
  public static function getCounters(){
    return Personspeciality::$rating_counter;
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

  public function valididateZnoExam($attributes) {
    switch ($attributes) {
      case "DocumentSubject1":
      case "Exam1ID":
        if ((empty($this->DocumentSubject1) && empty($this->Exam1ID)) || (!empty($this->DocumentSubject1) && !empty($this->Exam1ID))) {
          $this->addError("$attributes", "Потрібно обрати сертифікат або предмт");

          return false;
        }
        break;
      case "DocumentSubject2":
      case "Exam2ID":
        if ((empty($this->DocumentSubject2) && empty($this->Exam2ID)) || (!empty($this->DocumentSubject2) && !empty($this->Exam2ID))) {
          $this->addError("$attributes", "Потрібно обрати сертифікат або предмт");

          return false;
        }
        break;
      case "DocumentSubject3":
      case "Exam3ID":

        if ((empty($this->DocumentSubject3) && empty($this->Exam3ID)) || (!empty($this->DocumentSubject3) && !empty($this->Exam3ID))) {
          $this->addError("$attributes", "Потрібно обрати сертифікат або предмет");

          return false;
        }
    }
    return true;
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
        "rating_order_mode" => "Сортування у режимі 'РЕЙТИНГ' (за балами)",
        "status_confirmed" => "Допущено",
        "status_committed" => "Рекомендовано",
        "status_submitted" => "До наказу",
        "ext_param" => "Додаткові умови вибірки",
        "page_size" => "Кількість рядків (елементів) для однієї сторінки у таблиці заявок",
        "SPEC" => "Ключові слова через пробіл для вибірки за спеціальністю",
        "searchID" => "ID персони чи заявки або ж статус заявки",
        "NAME" => "ПІБ : ключові слова через пробіл",
        "DateFrom" => "Від дати",
        "DateTo" => "До дати",
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
   * Пошук із врахування зовнішніх реляційних відношень.
   * Enjoy this code with smiles / %) %) %) /.
   * @param bool $return_array_of_models default false
   * @return \CActiveDataProvider
   */
  public function search_rel($return_array_of_models = false){
    $rating_order_mode = 0;
    $page_size = 15;
    if (is_numeric($this->rating_order_mode)){
      $rating_order_mode = $this->rating_order_mode;
    }
    if (is_numeric($this->page_size) && $this->page_size > 0){
      $page_size = $this->page_size;
    }
    
    $criteria = new CDbCriteria();
    //З якими відношеннями маємо справу
    $with_rel = array();
    array_push($with_rel, 'sepciality');
    array_push($with_rel, 'person');
    array_push($with_rel, 'olymp');
    array_push($with_rel, 'educationForm');
    array_push($with_rel, 'edbo');
    array_push($with_rel, 'documentSubject1');
    array_push($with_rel, 'documentSubject2');
    array_push($with_rel, 'documentSubject3');
    array_push($with_rel, 'documentSubject1.subject1');
    array_push($with_rel, 'documentSubject2.subject2');
    array_push($with_rel, 'documentSubject3.subject3');
    
    $with_rel['sepciality.facultet'] = array('select' => false);
    $with_rel['person.docs'] = array('select' => false);
    $with_rel['person.benefits.benefit'] = array('select' => false);
    $with_rel['status'] = array('select' => false);
    $criteria->with = $with_rel;
    
    //також йде вибірка ::
    // ПІБ персон і спеціальності,
    // формат поля спеціальності: (( код_спеціальності назва_спеціальності[ (назва_напряму)] , форма: назва_форми ))
    // загальна сума балів для рейтингу,
    // кількість пільг,
    // список назв пільг (являє собою рядок із сепаратором : ";;"),
    // список ID пільг (являє собою рядок із сепаратором : ";;"),
    // список значень у документах (поле : AtestatValue, являє собою рядок із сепаратором : ";"),
    // список типів документів (являє собою рядок із сепаратором : ";"),
    // відмітка про позаконкурсний вступ або ж про те, що є відповідна пільга,
    // відмітка про першочерговий вступ або ж про те, що є відповідна пільга,
    // список відміток про позаконкурсний вступ (до відповідних пільг),
    // список відміток про першочерговий вступ (до відповідних пільг).
    $criteria->select = array('*',
      new CDbExpression("concat_ws(' ',trim(person.LastName),trim(person.FirstName),person.MiddleName) AS NAME"),
      new CDbExpression("concat_ws(' ',"
              . "sepciality.SpecialityClasifierCode,"
              . "(case substr(sepciality.SpecialityClasifierCode,1,1) when '6' then "
              . "sepciality.SpecialityDirectionName else sepciality.SpecialityName end),"
              . "(case sepciality.SpecialitySpecializationName when '' then '' "
              . " else concat('(',sepciality.SpecialitySpecializationName,')') end)"
              . ",',',concat('форма: ',educationForm.PersonEducationFormName)) AS SPEC"),
      new CDbExpression('ROUND(MAX(IF (
          ISNULL( 
            (
              SELECT Znovalue
              FROM atestatvalue 
              WHERE ROUND(Atestatvalue,1) IN (ROUND(docs.AtestatValue,1)) 
            ) 
          ),
          IF(ISNULL(docs.AtestatValue),0.0,docs.AtestatValue),
          (
            SELECT ROUND(MAX(Znovalue),2)
            FROM atestatvalue 
            WHERE ROUND(Atestatvalue,1) IN (ROUND(docs.AtestatValue,1)) 
          ) 
        )),2) AS ZnoDocValue'),
      new CDbExpression('ROUND(MAX(
            IF(ISNULL(docs.AtestatValue),0.0,docs.AtestatValue)
          ),2) AS PointDocValue'),
      new CDbExpression('(ROUND((
        MAX(IF (
          ISNULL( 
            (
              SELECT Znovalue
              FROM atestatvalue 
              WHERE ROUND(Atestatvalue,1) IN (ROUND(docs.AtestatValue,1)) 
            ) 
          ),
          IF(ISNULL(docs.AtestatValue),0.0,docs.AtestatValue),
          (
            SELECT ROUND(MAX(Znovalue),2)
            FROM atestatvalue 
            WHERE ROUND(Atestatvalue,1) IN (ROUND(docs.AtestatValue,1)) 
          ) 
        ))+
        IF(ISNULL(documentSubject1.SubjectValue),0.0,documentSubject1.SubjectValue)+
        IF(ISNULL(documentSubject2.SubjectValue),0.0,documentSubject2.SubjectValue)+
        IF(ISNULL(documentSubject3.SubjectValue),0.0,documentSubject3.SubjectValue)+
        IF(ISNULL(t.AdditionalBall),0.0,t.AdditionalBall)+
        IF(ISNULL(t.CoursedpBall),0.0,t.CoursedpBall)+
        IF(ISNULL(olymp.OlympiadAwardBonus),0.0,olymp.OlympiadAwardBonus)+
        IF(ISNULL(t.Exam1Ball),0.0,t.Exam1Ball)+
        IF(ISNULL(t.Exam2Ball),0.0,t.Exam2Ball)+
        IF(ISNULL(t.Exam3Ball),0.0,t.Exam3Ball)),2)) AS ComputedPoints'), 
      new CDbExpression('COUNT(DISTINCT benefit.idBenefit) AS cntBenefit'),
      new CDbExpression('GROUP_CONCAT(benefit.BenefitName '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS BenefitList'),
      new CDbExpression('GROUP_CONCAT(benefit.idBenefit '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS idBenefitList'),
      new CDbExpression('GROUP_CONCAT(docs.TypeID ORDER BY docs.AtestatValue DESC SEPARATOR \';\') AS DocTypes'),
      new CDbExpression('if(sum(benefit.isPZK)>0,1,0) AS isOutOfComp'),
      new CDbExpression('if(sum(benefit.isPV)>0,1,0) AS isExtraEntry'),
      new CDbExpression('GROUP_CONCAT(benefit.isPZK '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS isOutOfCompList'),
      new CDbExpression('GROUP_CONCAT(benefit.isPV '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS isExtraEntryList'),
    );
    //оформлення єдиного запиту на вибірку
    $criteria->together = true;
    
    //якщо прийшов searchID, то пошукати на співпадання з ID заявки, персони і ЄДЕБО 
    if (is_numeric($this->searchID)){
      $criteria->addCondition('(t.idPersonSpeciality='.$this->searchID.') '
              . 'OR (person.idPerson='.$this->searchID.') '
              . 'OR (t.edboID='.$this->searchID.')');
    } else if ((strlen($this->searchID) > 2)){
      $criteria->compare('status.PersonRequestStatusTypeName',$this->searchID,true);
    }
    //пошук факультету з використанням частини рядка його назви
    $criteria->compare('facultet.FacultetFullName', $this->searchFaculty->FacultetFullName,true);
    
    switch ($this->ext_param){
      case 1: 
      //якщо встановлений прапорець, щоб шукати лише неточності (неспівпадання у нас і даними ЄДЕБО)
      // тоді додаткові умови ::
      //  щоб відмітка у документі (атестат або диплом) не співпадала
      //  щоб відмітка першочерговості не співпадала
      //  щоб відмітка позаконкурсного вступу не співпадала
      //  щоб відмітка вступу за цільовим направленням не співпадала
      //  щоб відмітка копії/оригінала не співпадала
      /*
      Вставити в умову, якщо потрібно вибрати неточності по першочерговості вступу
      OR (edbo.PriorityEntry <> IF(((SELECT MAX(b.isPV) FROM personbenefits pb LEFT JOIN benefit b ON pb.BenefitID = b.idBenefit 
        WHERE t.PersonID=pb.PersonID AND b.isPV IS NOT NULL)) IS NULL, 0, 
        ((SELECT MAX(b.isPV) FROM personbenefits pb LEFT JOIN benefit b ON pb.BenefitID = b.idBenefit 
          WHERE t.PersonID=pb.PersonID AND b.isPV IS NOT NULL))))
      */
      $criteria->addCondition('(
        (concat_ws(\' \',trim(person.LastName),trim(person.FirstName),person.MiddleName) NOT LIKE edbo.PIB)
        
        OR (edbo.DocPoint NOT IN ((SELECT documents.AtestatValue FROM documents WHERE documents.PersonID = t.PersonID 
          AND documents.AtestatValue IS NOT NULL))) 

        OR (edbo.Benefit <> IF(((SELECT MAX(b.isPZK) FROM personbenefits pb LEFT JOIN benefit b ON pb.BenefitID = b.idBenefit 
          WHERE t.PersonID=pb.PersonID AND b.isPZK IS NOT NULL )) IS NULL, 0, 
          ((SELECT MAX(b.isPZK) FROM personbenefits pb LEFT JOIN benefit b ON pb.BenefitID = b.idBenefit 
            WHERE t.PersonID=pb.PersonID AND b.isPZK IS NOT NULL ))))

        OR (edbo.Quota=0 AND t.Quota1=1)
        OR (edbo.Quota=1 AND (t.Quota1 IS NULL OR t.Quota1 = 0))
        
        OR (edbo.OD=1 AND t.isCopyEntrantDoc=1)
        OR (edbo.OD=0 AND (t.isCopyEntrantDoc IS NULL OR t.isCopyEntrantDoc = 0)))'
      );
      break;
      case 4: 
      //якщо встановлений прапорець, щоб шукати лише неточності в оригіналах
      // тоді додаткові умови ::
      //  щоб відмітка копії/оригінала не співпадала
      $criteria->addCondition('(
       (edbo.OD=1 AND t.isCopyEntrantDoc=1)
          OR (edbo.OD=0 AND (t.isCopyEntrantDoc IS NULL OR t.isCopyEntrantDoc = 0)))'
      );
      break;
      case 5: 
      //якщо встановлений прапорець, щоб шукати лише неточності в балах
      // тоді додаткові умови ::
      //  щоб відмітка у документі (атестат або диплом) не співпадала
      $criteria->addCondition('(
        (edbo.DocPoint NOT IN ((SELECT documents.AtestatValue FROM documents WHERE documents.PersonID = t.PersonID 
          AND documents.AtestatValue IS NOT NULL))))'
      );
      break;
      case 6: 
      //якщо встановлений прапорець, щоб шукати лише неточності у відмітках пільгового вступу
      // тоді додаткові умови ::
      //  ??????щоб відмітка першочерговості не співпадала
      //  щоб відмітка позаконкурсного вступу не співпадала
      //  щоб відмітка вступу за цільовим направленням не співпадала
      $criteria->addCondition('(
        (edbo.Benefit <> IF(((SELECT MAX(b.isPZK) FROM personbenefits pb LEFT JOIN benefit b ON pb.BenefitID = b.idBenefit 
          WHERE t.PersonID=pb.PersonID AND b.isPZK IS NOT NULL )) IS NULL, 0, 
          ((SELECT MAX(b.isPZK) FROM personbenefits pb LEFT JOIN benefit b ON pb.BenefitID = b.idBenefit 
            WHERE t.PersonID=pb.PersonID AND b.isPZK IS NOT NULL ))))

        OR (edbo.Quota=0 AND t.Quota1=1)
        OR (edbo.Quota=1 AND (t.Quota1 IS NULL OR t.Quota1 = 0)))'
      );
      break;
    }
    
    if ($rating_order_mode){
      //якщо сортувати для рейтингу, тоді відібрати лише потрібні статуси заявок
      $status_in = '(';
      $status_ids = array();
      if ($this->status_confirmed){
        $status_ids[] = '4';
      }
      if ($this->status_committed){
        $status_ids[] = '5';
      }
      if ($this->status_submitted){
        $status_ids[] = '7';
      }
      $status_in .= implode(',',$status_ids) . ')';
      if ($status_in != '()'){
       $criteria->addCondition('t.StatusID IN '.$status_in);
      }
    }
    //вибираємо лише ті документи, у яких є бали (відмітки)
    //$criteria->addCondition('docs.AtestatValue IS NOT NULL');
    //якщо поступає на спеціаліста або магістра, то враховувати бали лише диплому,
    //інакше - атестату
    $criteria->addCondition('IF (t.QualificationID IN (2,3), '
            . '(docs.TypeID IN (11,12,13)), '
            . '(docs.TypeID = 2) )');
    
    if ($this->ext_param == 3){
      //якщо потрібно вибрати тільки ті дані, що відповідають даним з таблиці edbo_data
      $criteria->addCondition('edbo.ID IS NOT NULL');
    }
    if ($this->ext_param == 2){
      //якщо потрібно вибрати тільки ті дані, що не відповідають даним з таблиці edbo_data
      $criteria->addCondition('edbo.ID IS NULL');
    }

    
    if (is_numeric($this->searchBenefit->BenefitName)){
      //якщо частина назви пільги - число, то сприймати це як кількість пільг
      $criteria->having = 'cntBenefit='.$this->searchBenefit->BenefitName;
      if ($this->searchBenefit->BenefitName > 1){
        $page_size = 1000;
      }
    }
    if (!is_numeric($this->searchBenefit->BenefitName)){
      //пошук за частиною назви пільги
      $criteria->compare('benefit.BenefitName', $this->searchBenefit->BenefitName,true);
    }
    if ($this->NAME){
      //пошук прізвища
      $name_keys = explode(' ',$this->NAME);
      foreach ($name_keys as $key){
        $criteria->addCondition('concat_ws(" ",person.LastName,person.FirstName,person.MiddleName) '
              . 'LIKE "%'.$key.'%"');
      }
    }
    
    if (is_numeric($this->QualificationID) && $this->QualificationID > 0 && !$rating_order_mode){
      $criteria->compare('t.QualificationID',$this->QualificationID);
    }
    if (is_numeric($this->CourseID) && $this->CourseID > 0 && !$rating_order_mode){
      $criteria->compare('t.CourseID',$this->CourseID);
    }    
    if ($this->DateFrom && $this->DateTo && !$rating_order_mode){
      $condition_date1 = date('Y-m-d',strtotime(str_replace('.','-',$this->DateFrom))) . ' 00:00:00';
      $condition_date2 = date('Y-m-d',strtotime(str_replace('.','-',$this->DateTo))) . ' 23:59:59';
      $criteria->addCondition("t.CreateDate BETWEEN '".$condition_date1."' "
              . "AND '".$condition_date2."'");
    }
    
    if ($this->SPEC && !$rating_order_mode){
      //пошук спеціальності та спеціалізації
      $keys = explode(' ',$this->SPEC);
      foreach ($keys as $key){
      $criteria->addCondition("concat_ws(' ',"
                . "sepciality.SpecialityClasifierCode,"
                . "(case substr(sepciality.SpecialityClasifierCode,1,1) when '6' then "
                . "sepciality.SpecialityDirectionName else sepciality.SpecialityName end),"
                . "(case sepciality.SpecialitySpecializationName when '' then '' "
                . " else concat('(',sepciality.SpecialitySpecializationName,')') end)"
                . ",',',concat('форма: ',educationForm.PersonEducationFormName)) LIKE '%".$key."%'");
      }
    } else if ($rating_order_mode){
      $criteria->compare("t.SepcialityID",$this->SepcialityID);
    }
    
    //дані групуються по ІД заявки
    $criteria->group = "t.idPersonSpeciality";
    //параметр сортування даних для формування рейтингу
    $rating_order = 'isOutOfComp DESC,'//спочатку обираються ті, що поза конкурсом
            . 'IF (t.Quota1 IS NULL, 0, t.Quota1) DESC,'//потім - цільовики
            . 'ComputedPoints DESC,'//усі дані впорядковуються за рейтинговими балами
            . 'IF(SUM(benefit.isPV)>0,1,0) DESC';//якщо є відмітка першочергового вступу - що ж... нехай щастить!
    if ($rating_order_mode > 0){
      //якщо сортувати треба для формування рейтингу
      $criteria->order = $rating_order;
      //відобразаити усі записи на одній сторінці
      $page_size = 50000;
      Personspeciality::$is_rating_order = true;
    }
    if ($return_array_of_models){
      //для формування рейтингу в Excel-файлі
      return Personspeciality::model()->findAll($criteria);
    }
    //стандартно повертається джерело даних
    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        'sort' => array(
            'defaultOrder' => array(
                'idPersonSpeciality' => CSort::SORT_DESC,
            ),
            'attributes' => array(
                'NAME' => array(
                    'asc' => 'NAME',
                    'desc' => 'NAME DESC',
                ),
                'SPEC' => array(
                    'asc' => 'SPEC',
                    'desc' => 'SPEC DESC',
                ),
                'benefit.BenefitName' => array(
                    'asc' => 'benefit.BenefitName',
                    'desc' => 'benefit.BenefitName DESC',
                ),
                'facultet.FacultetFullName' => array(
                    'asc' => 'facultet.FacultetFullName',
                    'desc' => 'facultet.FacultetFullName DESC',
                ),
                '*',
            ),
        ),
        'pagination' => array(
            'pageSize' => $page_size
        ),
    ));
  }

  /**
   * Максимально повний пошук із врахування зовнішніх реляційних відношень.
   * Можливі гальма.
   * @param bool $return_array_of_models default false
   * @return \CActiveDataProvider
   * @todo Please do it! JUST DO IT!!!!!!
   */
  public function search_all_rel($return_array_of_models = false){
    
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
