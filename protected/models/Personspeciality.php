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
 * @property string  $CoursedpDocument
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
 * @property integer $StatusID
 * @property Personrequeststatustypes $status
 * @property integer $RequestFromEB
 * @property integer $Quota1
 * @property integer $Quota2
 * @property integer $LanguageExID
 * @property integer $EntrantDocumentID
 * @property integer $QuotaID
 */
class Personspeciality extends ActiveRecord {

    public $StatusID = 1;
    public $currentMaxRequestNumber;
    public $currentMaxPersonRequestNumber;
    public $isHigherEducation = 0;
    public $isCopyEntrantDoc = 1;
    public $benefits = array();

    /**
     * ID специальных категория для которых другой набор екзаменов
     * @var array 
     */
    public $specCategoryIds = array(206149, 206159, 206170, 206171, 206185, 206187, 206172, 206173);
    public $gosSlugbaIds = array(206194, 206195);

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Personspeciality the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
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

    public function getRowClass() {
        // deleted
        if ($this->StatusID == 10)
            return "row-red";
        // cenceled
        if ($this->StatusID == 3)
            return "row-reset";
        //denied
        if ($this->StatusID == 2)
            return "row-goldenrod";
        if (!empty($this->edboID))
            return "row-green";
        return "";
    }

    public function tableName() {
        return 'personspeciality';
    }

    public function isShortForm() {
        if ($this->QualificationID == 2 || $this->QualificationID == 3)
            return true;
        return false;
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
                               Exam1ID,  Exam2ID, 
                               Exam3ID,  isHigherEducation, SkipDocumentValue', 'numerical', 'integerOnly' => true),
            array("AdditionalBallComment,  CoursedpID, Quota1,Quota2, OlympiadID, isNotCheckAttestat, isForeinghEntrantDocument, PersonDocumentsAwardsTypesID, edboID, RequestFromEB, StatusID, benefits, QuotaID", 'safe'),
            // SHORTFORM
            //array("Exam1ID, Exam2ID", 'required', 'on' => "SHORTFORM"),
            //array("EntrantDocumentID", 'valididateEntrantDoc', 'on' => "SHORTFORM"),
            array("Exam1ID", 'valididateExam1', 'on' => "SHORTFORM"),
            array("Exam2ID", 'valididateExam2', 'on' => "SHORTFORM"),
            array("Exam3ID", 'valididateExam3', 'on' => "SHORTFORM"),
            array("EntranceTypeID", "required", "except" => "SHORTFORM"),
            //array("CausalityID",  "default", "value"=>100,"except"=>"SHORTFORM"),
            array("Exam1Ball, Exam2Ball, Exam3Ball", 'numerical',
                "max" => 200, "min" => 0, "allowEmpty" => true, 'except' => 'ZNOEXAM, EXAM'),
            array("AdditionalBall, CoursedpBall", 'numerical',
                "max" => 200, "min" => 0, "allowEmpty" => true),
            array('PersonID, SepcialityID,  EducationFormID, 
                               QualificationID,  CourseID, isContract, 
                               isCopyEntrantDoc, EntrantDocumentID, isNeedHostel, LanguageExID', "required"),
            array("DocumentSubject1, DocumentSubject2, DocumentSubject3", "required", "on" => "ZNO"),
            // array("Exam1ID, Exam2ID, Exam3ID, CausalityID", "required", "on" => "EXAM"),
            // array("Exam1Ball, Exam2Ball, Exam3Ball", 'numerical', "max" => 200, "min" => 1,  /*"allowEmpty" => true,*/ "valididateZnoExam", "on" => "EXAM"),
            array("CausalityID", "required", "on" => "ZNOEXAM, EXAM"),
            array("Exam1ID, Exam2ID, Exam3ID, DocumentSubject1, DocumentSubject2, DocumentSubject3", "valididateZnoExam", "on" => "EXAM"),
            array("Exam1ID, Exam2ID, Exam3ID, DocumentSubject1, DocumentSubject2, DocumentSubject3", "valididateZnoExam", "on" => "ZNOEXAM"),
            array("Exam1Ball, Exam2Ball, Exam3Ball", 'numerical', "max" => 200, "min" => 1, "allowEmpty" => true, "on" => "ZNOEXAM"),
            // DocumentSubject1, DocumentSubject2, DocumentSubject3, 
            //  Exam1ID, Exam1Ball, Exam2ID, Exam2Ball, Exam3ID, Exam3Ball', 'numerical', 'integerOnly'=>true),
            //array('AdditionalBall', 'numerical'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idPersonSpeciality, PersonID, SepcialityID,  EducationFormID, QualificationID, EntranceTypeID, CourseID, CausalityID, isContract, AdditionalBall, isCopyEntrantDoc, DocumentSubject1, DocumentSubject2, DocumentSubject3, Exam1ID, Exam1Ball, Exam2ID, Exam2Ball, Exam3ID, Exam3Ball', 'safe', 'on' => 'search'),
            array('CustomerName,DocCustumer,AcademicSemesterID,CustomerAddress,CustomerPaymentDetails,DateОfСontract,PaymentDate,  CoursedpDocument', 'safe'),
            //array('PersonID+SepcialityID+StatusID', 'ext.uniqueMultiColumnValidator', 'message' => "Заявка на дану спеціальність вже додано!"),
            array('isCopyEntrantDoc', 'valididateCopyEntrantDoc'),
            array('CoursedpDocument', 'valididateCoursedpDocument'),
            array('CoursedpID', 'valididateCoursedpID'),
            array('EntranceTypeID', 'valididateEntranceTypeID'),
            array("DocumentSubject1", "valididateDocumentSubject"),
        );
    }

    public function valididateDocumentSubject($attributes) {
        if (Yii::app()->user->checkAccess("validateZnoBall")) {

            if ($this->EntranceTypeID == 1) {
                $s1 = Documentsubject::model()->findByPk($this->DocumentSubject1);
                $s2 = Documentsubject::model()->findByPk($this->DocumentSubject2);
                $s3 = Documentsubject::model()->findByPk($this->DocumentSubject3);
                $profball = 0;
                $nprof1 = 0;
                $nprof2 = 0;
                if (!empty($s1) && !empty($s2) && !empty($s3)) {
                    $ss1 = Specialitysubjects::model()->find("SpecialityID = {$this->SepcialityID} and SubjectID = {$s1->SubjectID}");
                    $ss2 = Specialitysubjects::model()->find("SpecialityID = {$this->SepcialityID} and SubjectID = {$s2->SubjectID}");
                    $ss3 = Specialitysubjects::model()->find("SpecialityID = {$this->SepcialityID} and SubjectID = {$s3->SubjectID}");
                    $profball = $s2->SubjectValue;
                    $nprof1 = $s1->SubjectValue;
                    $nprof2 = $s3->SubjectValue;

                    if (!empty($ss1) && $ss1->isProfile) {
                        $profball = $s1->SubjectValue;
                        $nprof1 = $s2->SubjectValue;
                        $nprof2 = $s3->SubjectValue;
                    }
                    if (!empty($ss2) && $ss2->isProfile) {
                        $profball = $s2->SubjectValue;
                        $nprof1 = $s1->SubjectValue;
                        $nprof2 = $s3->SubjectValue;
                    }
                    if (!empty($ss3) && $ss3->isProfile) {
                        $profball = $s3->SubjectValue;
                        $nprof1 = $s1->SubjectValue;
                        $nprof2 = $s2->SubjectValue;
                    }
                    if ($profball < 140) {
                        $this->addError($attributes, "Профільний предмет не може бути нижчім за 140 балів!");
                        return false;
                    }
                    if (($profball >= 140 && $profball < 170) && ($nprof1 < 124 || $nprof2 < 124 )) {
                        $this->addError($attributes, "Недопустимі для вступу бали непрофільних предметів!");
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function valididateEntranceTypeID($attributes) {
        $model = Specialities::model()->findByPk($this->SepcialityID);
        if (!empty($model)) {
            if ($model->isArtExam && $this->EntranceTypeID == 1) {
                $this->addError($attributes, "На дану спеціальність заборонена така форма вступу!");
                return false;
            }
        }


        return true;
    }

    public function valididateCoursedpID($attributes) {

        if (!$this->CoursedpID > 0) {

            $ben = Personbenefits::model()->find("PersonID = {$this->PersonID} and BenefitID = 41");
            if (!empty($ben)) {
                if (in_array($ben->idPersonBenefits, $this->benefits)) {
                    $this->addError($attributes, "Вже існує пільга по курсам! Зверніться до адміністратора!");
                }
            }
        }


        return true;
    }

    public function valididateCopyEntrantDoc($attributes) {

        if ($this->isCopyEntrantDoc == 1) {
            return true;
        }
        $count = Personspeciality::model()->count("PersonID = {$this->PersonID} and isCopyEntrantDoc = 0 and EntrantDocumentID = {$this->EntrantDocumentID} ");
        if ($this->isNewRecord) {
            if ($count > 0) {
                $this->addError($attributes, "В іншій заявці вже вказано оригінал документу!");
                return false;
            }
        } else {
            $model = Personspeciality::model()->findByPk($this->idPersonSpeciality);
            if ($model->isCopyEntrantDoc == 1 && $count > 0) {
                $this->addError($attributes, "В іншій заявці вже вказано оригінал документу!");
                return false;
            }
        }


        return true;
    }

    public function valididateCoursedpDocument($attributes) {

        if ($this->CoursedpID > 0) {
            $this->CoursedpDocument = trim($this->CoursedpDocument);
            if (empty($this->CoursedpDocument)) {
                $this->addError("CoursedpDocument", "Необхідно вказати серію, номер та ким виданий документ!");
                return false;
            }
            $this->CoursedpBall = trim($this->CoursedpBall);
            if ($this->CoursedpBall === "") {
                $this->addError("CoursedpBall", "Необхідно вказати балл за курси або 0!");
            }
        }

        return true;
    }

    public function valididateEntrantDoc($attributes) {
        if (!empty($this->EntrantDocumentID)) {
            $doc = Documents::model()->findByPk($this->EntrantDocumentID);

            if (empty($doc->PersonBaseSpecealityID)) {
                $this->addError($attributes, "Не вказано базовий напрям піготовки документа!");
                return false;
            }
        }
        return true;
    }

    public function valididateExam1($attributes) {

        if (empty($this->{$attributes})) {
            $this->addError($attributes, "Предмет не може бути порожнім!");
            return false;
        }
        if ( $this->{$attributes} != 40) {
            $this->addError($attributes, "Невірний предмет!");
            return false;
        }

        return true;
    }

    public function valididateExam2($attributes) {

        if (empty($this->{$attributes})) {
            $this->addError($attributes, "Предмет не може бути порожнім!");
            return false;
        }
        if (in_array($this->SepcialityID, $this->specCategoryIds)) {
            if ( $this->{$attributes} != 3) {
            $this->addError($attributes, "Невірний предмет!");
            return false;
            }
        } else {
            if ( $this->{$attributes} !=40) {
            $this->addError($attributes, "Невірний предмет!");
            return false;
            }
        }

        return true;
    }

    public function valididateExam3($attributes) {
        if ($this->QualificationID == 3) { // spec 
            if (!empty($this->Exam3ID)) {
                $this->addError($attributes, "Предмет повинен бути порожнім!");
                return false;
            }
        }
        if ($this->QualificationID == 2) { // магістр 
            if (in_array($this->SepcialityID, $this->specCategoryIds)) {
                if (!empty($this->Exam3ID)) {
                    $this->addError($attributes, "Предмет повинен бути порожнім!");
                    return false;
                }
            } elseif (in_array($this->SepcialityID, $this->gosSlugbaIds)) {
                if ( empty($this->Exam3ID)) {
                    $this->addError($attributes, "Предмет не може бути порожнім!");
                    return false;
                }
                if ($this->Exam3ID != 40) {
                    $this->addError($attributes, "Невірний предмет!");
                    return false;
                }
            } else {
                if ( empty($this->Exam3ID)) {
                    $this->addError($attributes, "Предмет не може бути порожнім!");
                    return false;
                }
                if ($this->Exam3ID != 3) {
                    $this->addError($attributes, "Невірний предмет!");
                    return false;
                }
            }
        }


        return true;
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

    public function validate($attributes = null, $clearErrors = true) {
        if ($this->EntranceTypeID == 1)
            $this->scenario = "ZNO";
        if ($this->EntranceTypeID == 2)
            $this->scenario = "EXAM";
        if ($this->EntranceTypeID == 3)
            $this->scenario = "ZNOEXAM";

        return parent::validate($attributes, $clearErrors);
    }

    public function beforeSave() {
        $this->SysUserID = Yii::app()->user->id;
        if ($this->isNewRecord) {
            $c = new CDbCriteria();
            $c->compare("SepcialityID", $this->SepcialityID);
            $c->compare("QualificationID", $this->QualificationID);
            $c->compare("CourseID", $this->CourseID);
            $c->select = 'max(RequestNumber) as currentMaxRequestNumber';
            $res = self::model()->find($c);

            $this->RequestNumber = $res->currentMaxRequestNumber + 1;
        }

        if ($this->isNewRecord) {
            $c = new CDbCriteria();


            if ($this->QualificationID == 3 || $this->QualificationID == 2) {
                $c->addCondition("(QualificationID = 2 or QualificationID = 3) and PersonID = '{$this->PersonID}' and '{$this->CourseID}'");
            } else {
                $c->compare("PersonID", $this->PersonID);
                $c->compare("QualificationID", $this->QualificationID);
                $c->compare("CourseID", $this->CourseID);
            }

            $c->compare("CourseID", $this->CourseID);

            $res = self::model()->find($c);

            if (!empty($res) && !empty($res->PersonRequestNumber)) {
                $this->PersonRequestNumber = $res->PersonRequestNumber;
            } else {
                $c = new CDbCriteria();
                if ($this->QualificationID == 3 || $this->QualificationID == 2) {
                    $c->addCondition("(QualificationID = 2 or QualificationID = 3) and '{$this->CourseID}'");
                } else {
                    //$c->compare("PersonID", $this->PersonID);
                    $c->compare("QualificationID", $this->QualificationID);
                    $c->compare("CourseID", $this->CourseID);
                }
                $c->compare("CourseID", $this->CourseID);
                $c->select = 'max(PersonRequestNumber) as currentMaxPersonRequestNumber';
                $res = self::model()->find($c);
                $this->PersonRequestNumber = $res->currentMaxPersonRequestNumber + 1;
            }
        }



        return parent::beforeSave();
    }

    public function afterSave() {
        // автоматическое добавление льготы 
        if ($this->CoursedpID > 0) {
            $ben = Personbenefits::model()->find("PersonID = {$this->PersonID} and BenefitID = 41");
            if (empty($ben)) {
                $ben = new Personbenefits("CONVERT");
                $ben->PersonID = $this->PersonID;
                $ben->BenefitID = 41;
                $ben->save();
            };

            if (!in_array($ben->idPersonBenefits, $this->benefits)) {
                $this->benefits[] = $ben->idPersonBenefits;
            }
        } else {
            
        }

        // Сохраняем массив льгот привязанных к специальности
        Personspecialitybenefits::model()->deleteAll("PersonSpecialityID = {$this->idPersonSpeciality}");

        if (!empty($this->benefits) && is_array($this->benefits)) {
            foreach ($this->benefits as $val) {
                $item = Personspecialitybenefits::model()->findByPk(array("PersonBenefitID" => $val, 'PersonSpecialityID' => $this->idPersonSpeciality));
                if (count($item) == 0) {
                    $item = new Personspecialitybenefits();
                }
                $item->PersonBenefitID = $val;
                $item->PersonSpecialityID = $this->idPersonSpeciality;
                $item->save();
            }
        }

        return parent::afterSave();
    }

    public function afterFind() {
        // Формируем массив льгот привязанных к специальности
        $this->benefits = array();
        $psb = Personspecialitybenefits::model()->findAll("PersonSpecialityID = '{$this->idPersonSpeciality}'");
        foreach ($psb as $item) {
            //$item = new Personspecialitybenefits();
            $this->benefits[] = $item->PersonBenefitID;
        }
        //if ($this->isNewRecord || empty($this->LanguageID) )    $this->LanguageID = $this->person->LanguageID; 


        return parent::afterFind();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
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
            'status' => array(self::BELONGS_TO, 'Personrequeststatustypes', 'StatusID'),
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
            'Exam1ID' => 'Екзамен',
            'Exam1Ball' => 'Бал',
            'Exam2ID' => 'Екзамен',
            'Exam2Ball' => 'Бал',
            'Exam3ID' => 'Екзамен',
            'Exam3Ball' => 'Бал',
            'isHigherEducation' => 'Освіта аналогічного кваліфікаційного рівня',
            'SkipDocumentValue' => 'Бал не врах-ся',
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
            "benefits" => "Пільги",
            "LanguageExID" => "Іноземна мова",
            "CoursedpDocument" => "Серія номер та ким виданий документ",
            "QuotaID" => "Квота",
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

    public function loadRequestFromJsqon($jsondata, $sbj) {
        $data = CJSON::decode($jsondata);
        if (empty($data)) {
            throw new Exception("Заявку не знайдено!");
        }


        $data = (object) $data[0];
        $this->RequestFromEB = 1;
        $this->edboID = $data->idPersonRequest;
        $this->isBudget = $data->isBudget;
        $this->isContract = $data->isContract;
        $this->isNeedHostel = $data->isNeedHostel;
        $this->StatusID = $data->idPersonRequestStatusType;
        Yii::log($this->StatusID);
        $doc = Documents::model()->find("edboID=" . $data->idPersonDocument);
        if (empty($doc)) {
            throw new Exception("Документ для вступу відсутный або не синхронізований!");
        }
        $this->EntrantDocumentID = $doc->idDocuments;
        $this->EducationFormID = $data->idPersonEducationForm;
        $this->QualificationID = $data->idQualification;
        $spec = Specialities::model()->find("SpecialityKode = '" . $data->universitySpecialitiesKode . "'");
        if (empty($spec)) {
            throw new Exception("Пропозиція відсутня");
            //$this->SepcialityID = 153677;
        } else {
            $this->SepcialityID = $spec->idSpeciality;
        }
        Yii::log($this->SepcialityID);
        $this->LanguageExID = $data->idLanguageEx;
        $this->EntranceTypeID = $data->idPersonEnteranceTypes;
        $this->CausalityID = $data->idPersonRequestExaminationCause;
        $this->SkipDocumentValue = $data->skipDocumentValue;

        // Load subjects
        $sdata = CJSON::decode($sbj);
        if (empty($data)) {
            throw new Exception("Не задано передмети!");
        }
        if (!empty($sdata[0])) {
            $s1 = (object) $sdata[0];
            $doc = Documents::model()->find("edboID=" . $s1->idPersonDocument);
            $subj1 = Documentsubject::model()->find("DocumentID = {$doc->idDocuments} and SubjectID = {$s1->idSubject}");
            $this->DocumentSubject1 = $subj1->idDocumentSubject;
        }
        if (!empty($sdata[1])) {
            $s1 = (object) $sdata[1];
            $doc = Documents::model()->find("edboID=" . $s1->idPersonDocument);
            $subj1 = Documentsubject::model()->find("DocumentID = {$doc->idDocuments} and SubjectID = {$s1->idSubject}");
            $this->DocumentSubject2 = $subj1->idDocumentSubject;
        }
        if (!empty($sdata[2])) {
            $s1 = (object) $sdata[2];
            $doc = Documents::model()->find("edboID=" . $s1->idPersonDocument);
            $subj1 = Documentsubject::model()->find("DocumentID = {$doc->idDocuments} and SubjectID = {$s1->idSubject}");
            $this->DocumentSubject3 = $subj1->idDocumentSubject;
        }
        Yii::log(print_r($this->DocumentSubject1 . " " . $this->DocumentSubject2 . " " . $this->DocumentSubject3, 1));
    }

}
