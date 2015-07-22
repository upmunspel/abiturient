<?php

/**
 * This is the model class for table "personspeciality".
 *
 * 
 * Параметри, що опосередковано відносяться до БД
 * @property Facultets $searchFaculty - модель для пошуку факультета
 * @property Benefits $searchBenefit - модель для пошуку пільг
 * @property mixed $searchID - ІД персони або заявки, або ЄДЕБО чи статус заявки
 * @property string $NAME - ПІБ з видаленими незначущими пробілами
 * @property string $SPEC - Спеціальність (разом із спеціалізацією і формою навчання)
 * @property string $ComputedPoints - загальна сума рейтингових балів
 * @property string $DateFrom - початок календарного проміжку для пошуку
 * @property string $DateTo - кінець календарного проміжку для пошуку
 * @property string $ZnoDocValue - значення документа у специфічній шкалі ЄДЕБО
 * @property string $PointDocValue - значення документа, округлене до двох знаків після коми
 * @property integer $rating_order_mode - прапорець: чи потрібно сортувати для рейтингу
 * @property integer $AnyOriginal - чи є у персони хоча б один оригінал
 * @property integer $ZNOSum - сума балів ЗНО
 * @property integer $ForeignOnly - шукати лише іноземців (країна громадянства - не Україна)
 * @property integer $status_confirmed - прапорець: вибрати лише зі статусом "допущено"
 * @property integer $status_committed - прапорець: вибрати лише зі статусом "рекомендовано"
 * @property integer $status_submitted - прапорець: вибрати лише зі статусом "до наказу"
 * @property integer $ext_param - 1=> вибрати лише ті дані, що не співпадають з даними із edbo_data,
 *                                2=> вибрати лише ті дані, у яких немає зв"язку із таблицею edbo_data,
 *                                3=> вибрати дані, у яких є зв"язок із таблицею edbo_data,
 *                                4=> Неспівпадання з даними ЄДЕБО : лише копія/оригінал,
 *                                5=> Неспівпадання з даними ЄДЕБО : лише бали (зн. документа),
 *                                6=> Неспівпадання з даними ЄДЕБО : лише відмітки пільгового вступу,
 *                                7=> Неспівпадання з даними ЄДЕБО : лише сума балів ЗНО,
 *                                8=> Неспівпадання з даними ЄДЕБО : лише країна громадянства,
 * @property integer $page_size - кількість записів, що відображаються на одній сторінці
 * @property string $BenefitList - дані про пільги (розділені через ;;)
 * @property string $idBenefitList - ІН пільг (розділені через ;;)
 * @property string $isOutOfCompList - дані про те, чи надає пільга право вступу поза конкурсом (розділені через ;;)
 * @property string $isExtraEntryList - дані про те, чи надає пільга право вступу першочергово (розділені через ;;)
 * @property integer $isOutOfComp - чи є заявка з пільгою позаконкурсного вступу
 * @property integer $isExtraEntry - чи є заявка з пільгою першочергового вступу
 * @property integer $tDocSeria - перероблена серія документа вступу в ЄДЕБО англійськими малими літерами для порівняння
 * @property integer $tDocSeries - перероблена серія документа вступу в Абітурієнті англійськими малими літерами для порівняння
 * @property integer $ProfileSubjectValue - бал профільного предмету ЗНО
 * @property integer $PesronCase - № справи (наприклад, Б1-00402)
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
  public $AnyOriginal;
  public $ZNOSum;
  public $ForeignOnly;
  
  public $rating_order_mode;
  public $status_confirmed;
  public $status_committed;
  public $status_submitted;
  
  public $ext_param;
  public $page_size;
  public $BenefitList;
  public $idBenefitList;
  public $isOutOfCompList;
  public $isExtraEntryList;
  public $isOutOfComp;
  public $isExtraEntry;
  public $tDocSeria;
  public $tDocSeries;
  public $ProfileSubjectValue;
  public $PersonCase;
  public $excludedIDs = array();
  public $param_quotaID;
  public $quota_budget_places;
  
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
        array("Exam1ID, Exam2ID, Exam3ID, DocumentSubject1, DocumentSubject2, DocumentSubject3", "valididateZnoExam","on" => "ZNOEXAM"),
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
        'entrantdoc' => array(self::BELONGS_TO, 'Documents', 'EntrantDocumentID'),
        'course' => array(self::BELONGS_TO, 'Courses', 'CourseID'),
        'causality' => array(self::BELONGS_TO, 'Causality', 'CausalityID'),
        'documentSubject1' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject1'),
        'documentSubject2' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject2'),
        'documentSubject3' => array(self::BELONGS_TO, 'Documentsubject', 'DocumentSubject3'),
        'olymp' => array(self::BELONGS_TO, 'Olympiadsawards', 'OlympiadID'),
        'status' => array(self::BELONGS_TO, 'Personrequeststatustypes', 'StatusID'),
        'edbo' => array(self::BELONGS_TO, 'EdboData', 'edboID'),
        'pbenefits' => array(self::HAS_MANY, 'Personspecialitybenefits', 'PersonSpecialityID'),
        //'ZnoKoef1' => array(self::BELONGS_TO, 'Documentsubject', 'ZnoKoef1'),
        //'ZnoKoef2' => array(self::BELONGS_TO, 'Documentsubject', 'ZnoKoef2'),
        //'ZnoKoef3' => array(self::BELONGS_TO, 'Documentsubject', 'ZnoKoef3'),
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
        "rating_order_mode" => "Сортування у режимі 'РЕЙТИНГ' (за балами)",
        "status_confirmed" => "Допущено",
        "status_committed" => "Рекомендовано",
        "status_submitted" => "До наказу (зараховано)",
        "ext_param" => "Додаткові умови вибірки",
        "page_size" => "Кількість рядків (елементів) для однієї сторінки у таблиці заявок",
        "SPEC" => "Ключові слова через пробіл для вибірки за спеціальністю",
        "searchID" => "ID персони чи заявки або ж статус заяви",
        "NAME" => "ПІБ : ключові слова через пробіл",
        "DateFrom" => "Від дати",
        "DateTo" => "До дати",
        "ForeignOnly" => "Обрати лише іноземців",
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
    
    $criteria->compare('ZnoKoef1', $this->ZnoKoef1);
    $criteria->compare('ZnoKoef2', $this->ZnoKoef2);
    $criteria->compare('ZnoKoef3', $this->ZnoKoef3);
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
      
      
    Yii::import('application.models.Qualifications');
      
    $rating_order_mode = 0;
    $page_size = 3;
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
    array_push($with_rel, 'entrantdoc');
    array_push($with_rel, 'educationForm');
    array_push($with_rel, 'edbo');
    array_push($with_rel, 'documentSubject1');
    array_push($with_rel, 'documentSubject2');
    array_push($with_rel, 'documentSubject3');
    array_push($with_rel, 'documentSubject1.subject1');
    array_push($with_rel, 'documentSubject2.subject2');
    array_push($with_rel, 'documentSubject3.subject3');
    //array_push($with_rel, 'ZnoKoef1');
    //array_push($with_rel, 'ZnoKoef2');
    //array_push($with_rel, 'ZnoKoef3');
    
    $with_rel['sepciality.facultet'] = array('select' => false);
    $with_rel['person.country'] = array('select' => false);
    $with_rel['status'] = array('select' => false);
    $with_rel['pbenefits'] = array('select' => false);
    $with_rel['pbenefits.psbenefit'] = array('select' => false);
    $with_rel['pbenefits.psbenefit.benefit'] = array('select' => false);
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
    // Остання редакція: Жиленко О.С. ЕПК
    $criteria->select = array('*',
      new CDbExpression("concat_ws(' ',trim(person.LastName),trim(person.FirstName),trim(person.MiddleName)) AS NAME"),
      new CDbExpression("concat_ws(' ',"
              . "sepciality.SpecialityClasifierCode,"
              . "(case substr(sepciality.SpecialityClasifierCode,1,1) when '6' then "
              . "sepciality.SpecialityDirectionName else sepciality.SpecialityName end),"
              . "(case sepciality.SpecialitySpecializationName when '' then '' "
              . " else concat('(',sepciality.SpecialitySpecializationName,')') end)"
              . ",',',concat('форма: ',educationForm.PersonEducationFormName)) AS SPEC"),
      new CDbExpression('ROUND(
            IF( ISNULL(entrantdoc.AtestatValue),
                0.0, 
                IF( t.QualificationID = '.Qualifications::$bakalavr.', 
                    set_bal(entrantdoc.AtestatValue)* '.Yii::app()->params['scoreweight_AtestatValue'].' , 
                    entrantdoc.AtestatValue
                )
            )
          ,2) AS ZnoDocValue'),
      new CDbExpression('ROUND(
            IF(ISNULL(entrantdoc.AtestatValue),0.0,entrantdoc.AtestatValue),2) AS PointDocValue'),
      new CDbExpression('(ROUND((
        ROUND(
        IF( ISNULL(entrantdoc.AtestatValue),
                        0.0, 
                        IF( t.QualificationID = '.Qualifications::$bakalavr.', 
                            set_bal(entrantdoc.AtestatValue)* '.Yii::app()->params['scoreweight_AtestatValue'].' , 
                            entrantdoc.AtestatValue
                        )
        ),2)+
        IF(ISNULL(documentSubject1.SubjectValue),0.0,documentSubject1.SubjectValue*sepciality.ZnoKoef1)+
        IF(ISNULL(documentSubject2.SubjectValue),0.0,documentSubject2.SubjectValue*sepciality.ZnoKoef2)+
        IF(ISNULL(documentSubject3.SubjectValue),0.0,documentSubject3.SubjectValue*sepciality.ZnoKoef3)+
        IF(ISNULL(t.AdditionalBall),0.0,t.AdditionalBall)+
        IF(ISNULL(t.CoursedpBall),0.0,t.CoursedpBall* '.Yii::app()->params['scoreweight_CoursedpBall'].')+
        IF(ISNULL(olymp.OlympiadAwardBonus),0.0,olymp.OlympiadAwardBonus)+
        IF(ISNULL(t.Exam1Ball),0.0,t.Exam1Ball)+
        IF(ISNULL(t.Exam2Ball),0.0,t.Exam2Ball)+
        IF(ISNULL(t.Exam3Ball),0.0,t.Exam3Ball)),2)) AS ComputedPoints'), 
      new CDbExpression('COUNT(DISTINCT benefit.idBenefit) AS cntBenefit'),
      new CDbExpression('IF(documentSubject1.SubjectID 
        IN(SELECT ssj.SubjectID FROM specialitysubjects ssj WHERE ssj.isProfile=1 AND ssj.SpecialityID=t.SepcialityID),
          documentSubject1.SubjectValue,
          IF(documentSubject2.SubjectID 
            IN(SELECT ssj.SubjectID FROM specialitysubjects ssj WHERE ssj.isProfile=1 AND ssj.SpecialityID=t.SepcialityID),
            documentSubject2.SubjectValue,
            IF(documentSubject3.SubjectID 
              IN(SELECT ssj.SubjectID FROM specialitysubjects ssj WHERE ssj.isProfile=1 AND ssj.SpecialityID=t.SepcialityID),documentSubject3.SubjectValue, 0
            )
          )
      ) AS ProfileSubjectValue'),
      new CDbExpression('GROUP_CONCAT(benefit.BenefitName '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS BenefitList'),
      new CDbExpression('GROUP_CONCAT(benefit.idBenefit '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS idBenefitList'),
      new CDbExpression('if(sum(benefit.isPZK)>0,1,0) AS isOutOfComp'),
      new CDbExpression('if(sum(benefit.isPV)>0,1,0) AS isExtraEntry'),
      new CDbExpression('GROUP_CONCAT(benefit.isPZK '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS isOutOfCompList'),
      new CDbExpression('GROUP_CONCAT(benefit.isPV '
              . 'ORDER BY benefit.BenefitName ASC SEPARATOR \';;\') AS isExtraEntryList'),
      new CDbExpression('(SELECT SUM(IF((ISNULL(prsp.isCopyEntrantDoc) OR prsp.isCopyEntrantDoc = 0),1,0)) 
        FROM personspeciality prsp WHERE prsp.PersonID=t.PersonID) AS AnyOriginal'),
      new CDbExpression('(IF(ISNULL(documentSubject1.SubjectValue),0.0,documentSubject1.SubjectValue)+
        IF(ISNULL(documentSubject2.SubjectValue),0.0,documentSubject2.SubjectValue)+
        IF(ISNULL(documentSubject3.SubjectValue),0.0,documentSubject3.SubjectValue)) AS ZNOSum'),
      new CDbExpression('lower(IF(ISNULL(edbo.DocSeria),"none",edbo.DocSeria)) AS tDocSeria'),
      new CDbExpression('lower(IF(ISNULL(entrantdoc.Series),"none",transliterate(entrantdoc.Series))) AS tDocSeries'),
      new CDbExpression('CONCAT((CASE t.QualificationID 
                WHEN 1 THEN "Б" 
                WHEN 2 THEN "СМ" 
                WHEN 3 THEN "СМ" 
                WHEN 4 THEN "МС" END), t.CourseID, "-", LPAD(t.PersonRequestNumber,5,"0")) AS PersonCase'),
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

    // Yii::log("abit-ext-param:".$this->ext_param, CLogger::LEVEL_INFO, 'system.db.x');
    switch ($this->ext_param){
      case 1: 
      //якщо встановлений прапорець, щоб шукати лише неточності (неспівпадання у нас і даними ЄДЕБО)
      // тоді додаткові умови ::
      //  щоб сума усіх балів не співпадала
      //  щоб ПІБ не співпадало
      //  щоб країна громадянства не співпадала
      //  щоб відмітка у документі (атестат або диплом) не співпадала
      //  щоб номер і серія документа (атестата або диплому) не співпадали
      //  щоб відмітка першочерговості не співпадала
      //  щоб відмітка позаконкурсного вступу не співпадала
      //  щоб відмітка вступу за цільовим направленням не співпадала
      //  щоб відмітка копії/оригінала не співпадала
      //  щоб напрям або спеціальність або форма не співпадали
      //  щоб статус заяви не співпадав
      //  --! щоб серія документа вступу не співпадала
      //    OR (lower(IF(ISNULL(entrantdoc.Series),"none",entrantdoc.Series)) COLLATE utf8_unicode_ci
      //    NOT LIKE lower(IF(ISNULL(edbo.DocSeria),"none",edbo.DocSeria)) COLLATE utf8_unicode_ci)
      //    Qualifications::$bakalavr
      // Yii::log(" Qualifications::bakalavr:", CLogger::LEVEL_INFO, 'system.db.x');
      // Yii::log(" Qualifications::bakalavr:". Qualifications::$bakalavr, CLogger::LEVEL_INFO, 'system.db.x');
      $criteria->addCondition('
        (
            ABS(

                (
                    IF( ISNULL(entrantdoc.AtestatValue),
                        0.0, 
                        IF( t.QualificationID = '.Qualifications::$bakalavr.', 
                            set_bal(entrantdoc.AtestatValue)* '.Yii::app()->params['scoreweight_AtestatValue'].' , 
                            entrantdoc.AtestatValue
                        )
                    )
                    +

                    IF(ISNULL(documentSubject1.SubjectValue),0.0,documentSubject1.SubjectValue*sepciality.ZnoKoef1)+
                    IF(ISNULL(documentSubject2.SubjectValue),0.0,documentSubject2.SubjectValue*sepciality.ZnoKoef2)+
                    IF(ISNULL(documentSubject3.SubjectValue),0.0,documentSubject3.SubjectValue*sepciality.ZnoKoef3)+
                    IF(ISNULL(t.AdditionalBall),0.0,t.AdditionalBall)+
                    IF(ISNULL(t.CoursedpBall),0.0,t.CoursedpBall*'.Yii::app()->params['scoreweight_CoursedpBall'].')+
                    IF(ISNULL(olymp.OlympiadAwardBonus),0.0,olymp.OlympiadAwardBonus)+
                    IF(ISNULL(t.Exam1Ball),0.0,t.Exam1Ball)+
                    IF(ISNULL(t.Exam2Ball),0.0,t.Exam2Ball)+
                    IF( ISNULL(t.Exam3Ball),0.0,t.Exam3Ball )
                )
                - edbo.RatingPoints
            ) > 0.001
            
            OR
            
            (
                REPLACE(
                    REPLACE(
                        REPLACE( 
                            concat_ws(\' \',trim(person.LastName),trim(person.FirstName),trim(person.MiddleName)), 
                            "  ", " "
                        ),
                        "  ", " "
                    ), 
                    "  ", " "
                ) 
                NOT LIKE 
                REPLACE( 
                    REPLACE( 
                        REPLACE( 
                            edbo.PIB, "  ", " "
                        ), 
                        "  ", " " 
                     ), "  ", " " 
                )
            )
        
            OR (edbo.Country NOT LIKE country.CountryName) 
            
            OR (ROUND(edbo.DocPoint,2) <> ROUND(
                IF(ISNULL(entrantdoc.AtestatValue),0.0,entrantdoc.AtestatValue),2)) 
            
            OR (edbo.DocNumber NOT LIKE entrantdoc.Numbers) 
        
            OR (edbo.Benefit <> 
              if(isnull(benefit.isPZK),0,benefit.isPZK))
            
            OR (edbo.PriorityEntry <> 
              if(isnull(benefit.isPV),0,benefit.isPV))

            OR (edbo.Quota=0 AND t.QuotaID > 0)
            OR (edbo.Quota=1 AND (t.QuotaID IS NULL OR t.QuotaID = 0))
        
            OR (edbo.OD=1 AND t.isCopyEntrantDoc=1)
            OR (edbo.OD=0 AND (t.isCopyEntrantDoc IS NULL OR t.isCopyEntrantDoc = 0))
            
            OR (
                (edbo.EduForm NOT LIKE educationForm.PersonEducationFormName) 
                OR (edbo.Direction NOT LIKE sepciality.SpecialityDirectionName AND t.QualificationID = 1) 
                OR (edbo.Speciality NOT LIKE sepciality.SpecialityName AND t.QualificationID > 1) 
                OR (sepciality.SpecialitySpecializationName NOT LIKE CONCAT("%",edbo.Specialization,"%"))
            )
            OR (
                MID(status.PersonRequestStatusTypeName,1,6) COLLATE utf8_unicode_ci NOT LIKE MID(edbo.Status,1,6)
            ) 
        ) AND edbo.ID IS NOT NULL'
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
        (ROUND(edbo.DocPoint,2) <> ROUND(
            IF(ISNULL(entrantdoc.AtestatValue),0.0,entrantdoc.AtestatValue),2)))'
      );
      break;
      case 6: 
      //якщо встановлений прапорець, щоб шукати лише неточності у відмітках пільгового вступу
      // тоді додаткові умови ::
      //  ??????щоб відмітка першочерговості не співпадала
      //  щоб відмітка позаконкурсного вступу не співпадала
      //  щоб відмітка вступу за цільовим направленням не співпадала
      $criteria->addCondition('(
        (edbo.Benefit <> 
          if(isnull(benefit.isPZK),0,benefit.isPZK))
            
        OR (edbo.PriorityEntry <> 
          if(isnull(benefit.isPV),0,benefit.isPV))

        OR (edbo.Quota=0 AND t.QuotaID > 0)
        OR (edbo.Quota=1 AND (t.QuotaID IS NULL OR t.QuotaID = 0)))'
      );
      break;
      case 7: 
      //якщо встановлений прапорець, щоб шукати лише неточності в сумі балів ЗНО
      // тоді додаткові умови ::
      // 
      $criteria->addCondition('(
               ABS(
                  - SUBSTRING(LEFT(edbo.DetailPoints,LOCATE("+Е:",edbo.DetailPoints)-1),LOCATE("+ЗНО:",edbo.DetailPoints)+5)
                  + 
                  (
                     IF(ISNULL(documentSubject1.SubjectValue),0.0,documentSubject1.SubjectValue*sepciality.ZnoKoef1)
                     +
                     IF(ISNULL(documentSubject2.SubjectValue),0.0,documentSubject2.SubjectValue*sepciality.ZnoKoef2)
                     +
                     IF(ISNULL(documentSubject3.SubjectValue),0.0,documentSubject3.SubjectValue*sepciality.ZnoKoef3)
                  )
               ) > 0.001
      )'
      );
      break;
      case 8: 
      //якщо встановлений прапорець, щоб шукати лише неточності для країни громадянства
      // тоді додаткові умови ::
      // 
      $criteria->addCondition('(edbo.Country NOT LIKE country.CountryName)'
      );
      break;
      //якщо встановлений прапорець, щоб шукати лише неточності для аттестату
      // Жиленко О.С.
      case 9:
      $criteria->addCondition('(entrantdoc.TypeID = 2)  AND '
                            . '('
                            . '(lower(transliterate(edbo.DocSeria)) <> lower(transliterate(entrantdoc.Series)))' 
                            . 'OR (edbo.DocNumber <> entrantdoc.numbers)'
                            . 'OR (ROUND(edbo.DocPoint,2) <> ROUND(IF(ISNULL(entrantdoc.AtestatValue),0.0,entrantdoc.AtestatValue),2))'
                            . 'OR (edbo.DocDate <> STR_TO_DATE(entrantdoc.DateGet, \'%Y/%m/%d\'))'
                            . ')'
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
      } else {
        $criteria->addCondition('t.StatusID IN (1,4,5,7,8)');
      }
    }
    
    if ($this->ext_param == 3){
      //якщо потрібно вибрати тільки ті дані, що відповідають даним з таблиці edbo_data
      $criteria->addCondition('edbo.ID IS NOT NULL');
    }
    if ($this->ext_param == 2){
      //якщо потрібно вибрати тільки ті дані, що не відповідають даним з таблиці edbo_data
      $criteria->addCondition('edbo.ID IS NULL');
    }
    
    if ($this->ForeignOnly){
      $criteria->addCondition('country.CountryName NOT LIKE "Україна"');
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
            . 'IF (t.QuotaID IS NULL, 0, t.QuotaID) DESC,'//потім - цільовики
            . 'ComputedPoints DESC,'//усі дані впорядковуються за рейтинговими балами
            . 'IF(SUM(benefit.isPV)>0,1,0) DESC, 
            IF(ISNULL(entrantdoc.PersonDocumentsAwardsTypesID),0,10-entrantdoc.PersonDocumentsAwardsTypesID) DESC, 
            ProfileSubjectValue DESC';//якщо є відмітка першочергового вступу - що ж... нехай щастить!
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
    $dataProvider = new CActiveDataProvider($this, array(
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
    //$dataProvider->setTotalItemCount(count($this->findAll($criteria)));
    return $dataProvider;
  }
  
  
  /**
   * Формування рейтингових даних для цільовиків.
   * @param integer $mode 0 - цільовики, 1 - пільговики, 2 - бюджетники, 3 - контрактники, 4 - решта
   * @param boolean $sort_status сортувати за статусом?
   * @return Personspeciality[]
   */
  public function rating_search($mode,$sort_status = false){
    if (!is_numeric($this->SepcialityID)){
      return array();
    }
    Yii::import('application.models.Qualifications');
    $spec_model = Specialities::model()->findByPk($this->SepcialityID);
    $first_symbol = mb_substr($spec_model->SpecialityClasifierCode,0,1,'utf-8');
    $is_spec_mag = ($first_symbol == '7' ||
      $first_symbol == '8');
    if (!$spec_model){
      return array();
    }
    $criteria = new CDbCriteria();
    //З якими відношеннями маємо справу
    $with_rel = array();
    array_push($with_rel, 'sepciality');
    array_push($with_rel, 'person');
    array_push($with_rel, 'olymp');
    array_push($with_rel, 'entrantdoc');
    array_push($with_rel, 'educationForm');
    array_push($with_rel, 'edbo');
    array_push($with_rel, 'documentSubject1');
    array_push($with_rel, 'documentSubject2');
    array_push($with_rel, 'documentSubject3');
    array_push($with_rel, 'documentSubject1.subject1');
    array_push($with_rel, 'documentSubject2.subject2');
    array_push($with_rel, 'documentSubject3.subject3');
    
    $with_rel['sepciality.facultet'] = array('select' => false);
    $with_rel['person.country'] = array('select' => false);
    $with_rel['status'] = array('select' => false);
    $with_rel['pbenefits'] = array('select' => false);
    $with_rel['pbenefits.psbenefit'] = array('select' => false);
    $with_rel['pbenefits.psbenefit.benefit'] = array('select' => false);
    $criteria->with = $with_rel;
    
    //також йде вибірка ::
    // ПІБ персон і спеціальності,
    // формат поля спеціальності: (( код_спеціальності назва_спеціальності[ (назва_напряму)] , форма: назва_форми ))
    // бал документу ,перерахований по шкалі ЄДЕБО,
    // бал документу,
    // загальна сума балів для рейтингу,
    // бал профільного предмету,
    // відмітка про позаконкурсний вступ або ж про те, що є відповідна пільга,
    // відмітка про першочерговий вступ або ж про те, що є відповідна пільга,
    // відмітка про оригінал на іншій спеціальності,
    // сума балів ЗНО.
    
    // МЫ ТУТ МЕНЯЛИ УМНОЖЕНИЕ НА 5
    $criteria->select = array(
      '*',
      new CDbExpression("concat_ws(' ',trim(person.LastName),trim(person.FirstName),trim(person.MiddleName)) AS NAME"),
      new CDbExpression("concat_ws(' ',"
              . "sepciality.SpecialityClasifierCode,"
              . "(case substr(sepciality.SpecialityClasifierCode,1,1) when '6' then "
              . "sepciality.SpecialityDirectionName else sepciality.SpecialityName end),"
              . "(case sepciality.SpecialitySpecializationName when '' then '' "
              . " else concat('(',sepciality.SpecialitySpecializationName,')') end)"
              . ",',',concat('форма: ',educationForm.PersonEducationFormName)) AS SPEC"),
      new CDbExpression('ROUND(
            IF(ISNULL(entrantdoc.AtestatValue),0.0, IF((entrantdoc.AtestatValue > 12), entrantdoc.AtestatValue ,entrantdoc.AtestatValue))
          ,2) AS ZnoDocValue'),
      new CDbExpression('ROUND(
            IF(ISNULL(entrantdoc.AtestatValue),0.0,entrantdoc.AtestatValue),2) AS PointDocValue'),
      new CDbExpression('(ROUND((
        ROUND(
            IF( ISNULL(entrantdoc.AtestatValue),
                0.0, 
                IF( t.QualificationID = '.Qualifications::$bakalavr.', 
                    set_bal(entrantdoc.AtestatValue)* '.Yii::app()->params['scoreweight_AtestatValue'].' , 
                    entrantdoc.AtestatValue
                )
            ),2)+
        IF(ISNULL(documentSubject1.SubjectValue),0.0,documentSubject1.SubjectValue*sepciality.ZnoKoef1)+
        IF(ISNULL(documentSubject2.SubjectValue),0.0,documentSubject2.SubjectValue*sepciality.ZnoKoef2)+
        IF(ISNULL(documentSubject3.SubjectValue),0.0,documentSubject3.SubjectValue*sepciality.ZnoKoef3)+
        IF(ISNULL(t.AdditionalBall),0.0,t.AdditionalBall)+
        IF(ISNULL(t.CoursedpBall),0.0,t.CoursedpBall*'.Yii::app()->params['scoreweight_CoursedpBall'].')+
        IF(ISNULL(olymp.OlympiadAwardBonus),0.0,olymp.OlympiadAwardBonus)+
        IF(ISNULL(t.Exam1Ball),0.0,t.Exam1Ball)+
        IF(ISNULL(t.Exam2Ball),0.0,t.Exam2Ball)+
        IF(ISNULL(t.Exam3Ball),0.0,t.Exam3Ball*sepciality.ZnoKoef3)),2)) AS ComputedPoints'), 
      new CDbExpression('IF(documentSubject1.SubjectID 
        IN(SELECT ssj.SubjectID FROM specialitysubjects ssj WHERE ssj.isProfile=1 AND ssj.SpecialityID=t.SepcialityID),
          documentSubject1.SubjectValue,
          IF(documentSubject2.SubjectID 
            IN(SELECT ssj.SubjectID FROM specialitysubjects ssj WHERE ssj.isProfile=1 AND ssj.SpecialityID=t.SepcialityID),
            documentSubject2.SubjectValue,
            IF(documentSubject3.SubjectID 
              IN(SELECT ssj.SubjectID FROM specialitysubjects ssj WHERE ssj.isProfile=1 AND ssj.SpecialityID=t.SepcialityID),documentSubject3.SubjectValue, 0
            )
          )
      ) AS ProfileSubjectValue'),
      new CDbExpression('if(ISNULL((SELECT bf.idBenefit FROM personspecialitybenefits psbf '
        . 'LEFT JOIN personbenefits pbf ON psbf.PersonBenefitID=pbf.idPersonBenefits '
        . 'LEFT JOIN benefit bf ON pbf.BenefitID=bf.idBenefit '
        . 'WHERE psbf.PersonSpecialityID=t.idPersonSpeciality AND bf.isPZK>0 LIMIT 1)),0,1) AS isOutOfComp'),
      new CDbExpression('if(ISNULL((SELECT bf.idBenefit FROM personspecialitybenefits psbf '
        . 'LEFT JOIN personbenefits pbf ON psbf.PersonBenefitID=pbf.idPersonBenefits '
        . 'LEFT JOIN benefit bf ON pbf.BenefitID=bf.idBenefit '
        . 'WHERE psbf.PersonSpecialityID=t.idPersonSpeciality AND bf.isPV>0 LIMIT 1)),0,1) AS isExtraEntry'),

      new CDbExpression('IF((t.isCopyEntrantDoc = 0),0,(SELECT SUM(IF((ISNULL(prsp.isCopyEntrantDoc) OR prsp.isCopyEntrantDoc = 0),1,0)) 
        FROM personspeciality prsp WHERE prsp.PersonID=t.PersonID)) AS AnyOriginal'),
      new CDbExpression('(IF(ISNULL(documentSubject1.SubjectValue),0.0,documentSubject1.SubjectValue)+
        IF(ISNULL(documentSubject2.SubjectValue),0.0,documentSubject2.SubjectValue)+
        IF(ISNULL(documentSubject3.SubjectValue),0.0,documentSubject3.SubjectValue)) AS ZNOSum'),
    );
    //оформлення єдиного запиту на вибірку
    $criteria->together = true;
    //вибірка для певної спеціальності/напряму певної форми
    $criteria->compare("t.SepcialityID",$this->SepcialityID);
    //вибірка для обраних статусів або для нових заяв, допущених, рекомендованих, до наказу і затриманих
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
    } else {
      $criteria->addCondition('t.StatusID IN (1,4,5,7,8)');
    }
    if ($sort_status){
      $criteria->addCondition('t.StatusID < 8');
    }
    switch ($mode){
      //цільовики
      case 0:
        $criteria->compare('t.QuotaID',$this->param_quotaID);
        if (is_numeric($this->param_quotaID)){
          $criteria->limit = intval($this->quota_budget_places);
        } else {
          return array();
        }
        if ($sort_status){
          $criteria->addCondition('t.StatusID IN (7)');
        }
        break;
      //пільговики
      case 1:
        $criteria->compare('if(isnull(benefit.isPZK),0,benefit.isPZK)',1);
        $criteria->addCondition('t.isBudget > 0');
        if (!empty($this->exludedIDs)){
          $criteria->addCondition('t.idPersonSpeciality NOT IN ('.implode(',',$this->excludedIDs).')');
        }
        $criteria->limit = intval($spec_model->Quota1);
        if ($sort_status){
          $criteria->addCondition('t.StatusID IN (7)');
        }
        break;
      //бюджетники
      case 2:
        $criteria->addCondition('t.isBudget > 0');
        $place_num = intval($spec_model->SpecialityBudgetCount) - count($this->excludedIDs);
        $criteria->limit = ($place_num >= 0) ? $place_num : 0;
        if ($sort_status){
          $criteria->addCondition('t.StatusID IN (7)');
        }
        break;
      //контрактники
      case 3:
        $criteria->limit = intval($spec_model->SpecialityContractCount);
        if ($sort_status){
          $criteria->addCondition('t.StatusID IN (7,5,4)');
        }
        break;
      //решта
      case 4:
        $criteria->limit = 100000;
        break;
    }
    if (count($this->excludedIDs) > 0){
      $criteria->addCondition('t.idPersonSpeciality NOT IN ('.implode(',',$this->excludedIDs).')');
    }
    
    //дані групуються по ІД заявки
    $criteria->group = "t.idPersonSpeciality";
    //параметр сортування даних для формування рейтингу
    //$rating_order = ($sort_status)? "t.StatusID DESC, ":"";
    $rating_order = 'ComputedPoints DESC,'//усі дані впорядковуються за рейтинговими балами
            . 'IF(SUM(benefit.isPV)>0,1,0) DESC, 
            IF(ISNULL(entrantdoc.PersonDocumentsAwardsTypesID),0,10-entrantdoc.PersonDocumentsAwardsTypesID) DESC, 
            ProfileSubjectValue DESC, t.CreateDate ASC';//
    $criteria->order = $rating_order;
    $result_models = Personspeciality::model()->findAll($criteria);
    if ($mode < 4){
      $excl_ids = array();
      foreach ($result_models as $res_model){
        $excl_ids[] = $res_model->idPersonSpeciality;
      }
      $this->excludedIDs = array_merge($this->excludedIDs,$excl_ids);
    }
    return $result_models;
  }
  
}
