<?php

/**
 * This is the model class for table "specialities".
 *
 * The followings are the available columns in table 'specialities':
 * @property integer $idSpeciality
 * @property string $SpecialityName
 * @property string $SpecialityKode
 * @property integer $FacultetID
 * @property string $SpecialityClasifierCode
 * @property integer $SpecialityBudgetCount
 * @property integer $SpecialityContractCount
 * @property integer $Quota1
 * @property integer $Quota2
 * @property integer $isZaoch
 * @property integer $PersonEducationFormID
 * @property integer $isPublishIn
 * @property string $YearPrice
 * @property string $SemPrice
 * @property string $WordPrice
 * @property integer $StudyPeriodID
 * @property string $SpecialityDirectionName
 * The followings are the available model relations:
 * @property Personsepciality[] $personsepcialities
 * @property Facultets $facultet
 */
class Specialities extends CActiveRecord {

    public $basespecialitys = array();
    public $SPEC;

    public function afterSave() {

        $res = BasespecialityRelation::model()->deleteAll("SpecialityID = {$this->idSpeciality}");

        if (!empty($this->basespecialitys) && is_array($this->basespecialitys)) {
            foreach ($this->basespecialitys as $val) {
                $item = new BasespecialityRelation();
                $item->SpecialityID = $this->idSpeciality;
                $item->PersonBaseSpecialityID = $val;
                $item->save();
            }
        }
//   
        return parent::afterSave();
    }

    public function afterFind() {
        // Формируем массив 
        $this->basespecialitys = array();
        $psb = BasespecialityRelation::model()->findAll("`SpecialityID` = {$this->idSpeciality}");
        foreach ($psb as $item) {
            $this->basespecialitys[] = $item->PersonBaseSpecialityID;
        }
        return parent::afterFind();
    }

    /**
     * DropDownMask
     * @param type $FacultetID
     * @param type $EducationFormID
     * @param type $QualificationID
     * @param type $BaseSpecID
     * @return string
     */
    public static function DropDownMask($FacultetID = 0, $EducationFormID = 0, $QualificationID = 0, $BaseSpecID = 0) {
        $user = Yii::app()->user->getUserModel();
        $records = array();
        $res = array();
        $mask = "";
        if ($QualificationID == 3) {
            $mask = "7";
        }
        if ($QualificationID == 2) {
            $mask = "8";
        }
        if ($QualificationID == 1) {
            $mask = "6";
        }
        
        if ($FacultetID == 0 || $EducationFormID == 0 || $QualificationID == 0) {
            //$records = Specialities::model()->findAll("SpecialityClasifierCode like '7%' or SpecialityClasifierCode like '8%'");
        } else {
            $records = Specialities::model()->findAll("FacultetID = :FacultetID and PersonEducationFormID = :EducationFormID and SpecialityClasifierCode like '$mask%'", array(":FacultetID" => $FacultetID, ":EducationFormID" => $EducationFormID));
        }


        $bs = array();
        if ($BaseSpecID > 0) {
            $doc = Documents::model()->findByPk($BaseSpecID);

            if (!empty($doc->PersonBaseSpecealityID)) {
                $rel = BasespecialityRelation::model()->findAll("PersonBaseSpecialityID = {$doc->PersonBaseSpecealityID}");
                foreach ($rel as $item) {
                    $bs[] = $item->SpecialityID;
                }
            }
        }
       //Yii::log(print_r($BaseSpecID,1)); 
        //Yii::log(print_r($bs,1));                
        foreach ($records as $record) {
            if (!empty($bs)) {
                if (in_array($record->idSpeciality, $bs)) {
                    $res[$record->idSpeciality] = (!empty($record->SpecialityName) ? $record->SpecialityName . " " : "" ) . $record->SpecialityDirectionName . (!empty($record->SpecialitySpecializationName) ? ": " . $record->SpecialitySpecializationName . " " : "") . "(" . $record->SpecialityClasifierCode . ")";
                    if (!empty($record->PersonEducationFormID)) {
                        switch ($record->PersonEducationFormID) {
                            case "1": $res[$record->idSpeciality].="(Д)";
                                break;
                            case "2": $res[$record->idSpeciality].="(З)";
                                break;
                            case "3": $res[$record->idSpeciality].="(Е)";
                                break;
                        }
                    }
                }
            } else {
                $res[$record->idSpeciality] = (!empty($record->SpecialityName) ? $record->SpecialityName . " " : "" ) . $record->SpecialityDirectionName . (!empty($record->SpecialitySpecializationName) ? ": " . $record->SpecialitySpecializationName . " " : "") . "(" . $record->SpecialityClasifierCode . ")";
                if (!empty($record->PersonEducationFormID)) {
                    switch ($record->PersonEducationFormID) {
                        case "1": $res[$record->idSpeciality].="(Д)";
                            break;
                        case "2": $res[$record->idSpeciality].="(З)";
                            break;
                        case "3": $res[$record->idSpeciality].="(Е)";
                            break;
                    }
                }
            }
        }
        //Yii::log(print_r($res, 1));
        return $res;
    }

    public static function DropDown($FacultetID = 0) {
        $res = array();
        $c = new CDbCriteria();
        $c->order = 'SpecialityDirectionName';
        if ($FacultetID != 0) {
            $c->addCondition('FacultetID = '.$FacultetID);
        }

        foreach (Specialities::model()->findAll($c) as $record) {
            $res[$record->idSpeciality] = ($res[$record->idSpeciality] = (!empty($record->SpecialityName) ? $record->SpecialityName . " " : "" ) . $record->SpecialityDirectionName . (!empty($record->SpecialitySpecializationName) ? ": " . $record->SpecialitySpecializationName . " " : "") . "(" . $record->SpecialityClasifierCode . ")");
            if (!empty($record->PersonEducationFormID)) {
                switch ($record->PersonEducationFormID) {
                    case "1": $res[$record->idSpeciality].="(Д)";
                        break;
                    case "2": $res[$record->idSpeciality].="(З)";
                        break;
                    case "3": $res[$record->idSpeciality].="(Е)";
                        break;
                }
            }
        }


        return $res;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'specialities';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idSpeciality', 'required'),
            array('idSpeciality, FacultetID, SpecialityBudgetCount, 
                              SpecialityContractCount, isZaoch, isPublishIn', 'numerical', 'integerOnly' => true),
            array('SpecialityName', 'length', 'max' => 100),
            array('SpecialityKode', 'length', 'max' => 40),
            array('SpecialityClasifierCode', 'length', 'max' => 12),
            array("WordPrice, StudyPeriodID, basespecialitys", "safe"),
            array("YearPrice, SemPrice", 'numerical', 'integerOnly' => false),
            array("Quota1, Quota2, PersonEducationFormID", 'numerical', 'integerOnly' => false),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idSpeciality, SpecialityName, SpecialityKode, 
                            FacultetID, SpecialityClasifierCode, SpecialityBudgetCount, SpecialityContractCount, isZaoch, isPublishIn, Quota1, Quota2,
                            WordPrice, YearPrice', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'SepcialityID'),
            'facultet' => array(self::BELONGS_TO, 'Facultets', 'FacultetID'),
            'eduform' => array(self::BELONGS_TO, 'Personeducationforms', 'PersonEducationFormID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idSpeciality' => 'Id Speciality',
            'SpecialityName' => 'Спеціальність',
            'SpecialityKode' => 'Speciality Kode',
            'FacultetID' => 'Facultet',
            'SpecialityClasifierCode' => 'Speciality Clasifier Code',
            'SpecialityBudgetCount' => 'К-сть бюджетних місць',
            'SpecialityContractCount' => 'К-сть контрактних місць',
            'isZaoch' => 'Is Zaoch',
            'PersonEducationFormID' => 'Форма навчання',
            'isPublishIn' => 'Is Publish In',
            'WordPrice' => "Загальна вартість прописом",
            'YearPrice' => "Загальна вартість",
            'SemPrice' => "Ціна за семестр",
            "PersonEducationFormID" => "Форма освіти",
            "StudyPeriodID" => "Період",
            "basespecialitys" => "Пов'язаний базовий напрям підготовки",
            "Quota1" => "Квота \"ПозаКонкурсом\"",
            "Quota2" => "Квота \"ЦільовеНаправлення\"",
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
        $criteria->with = array('eduform');
        $criteria->select = array('*',
          new CDbExpression("concat_ws(' ',"
                    . "SpecialityClasifierCode,"
                    . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
                    . "SpecialityDirectionName else SpecialityName end),"
                    . "(case SpecialitySpecializationName when '' then '' "
                    . " else concat('(',SpecialitySpecializationName,')') end)"
                    . ",',',concat('форма: ',eduform.PersonEducationFormName)) AS SPEC"),
        );
        $criteria->together = true;
        $criteria->compare("concat_ws(' ',"
                    . "SpecialityClasifierCode,"
                    . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
                    . "SpecialityDirectionName else SpecialityName end),"
                    . "(case SpecialitySpecializationName when '' then '' "
                    . " else concat('(',SpecialitySpecializationName,')') end)"
                    . ",',',concat('форма: ',eduform.PersonEducationFormName))", $this->SPEC);
        $criteria->compare('SpecialityName', $this->SpecialityName, true);
        $criteria->compare('SpecialityName', $this->SpecialityName, true);
        $criteria->compare('SpecialityKode', $this->SpecialityKode, true);
        $criteria->compare('FacultetID', $this->FacultetID);
        $criteria->compare('SpecialityClasifierCode', $this->SpecialityClasifierCode, true);
        $criteria->compare('SpecialityBudgetCount', $this->SpecialityBudgetCount);
        $criteria->compare('SpecialityContractCount', $this->SpecialityContractCount);
        $criteria->compare('Quota1', $this->Quota1);
        $criteria->compare('Quota2', $this->Quota2);
        $criteria->compare('isZaoch', $this->isZaoch);
        $criteria->compare('PersonEducationFormID', $this->PersonEducationFormID);
        $criteria->compare('isPublishIn', $this->isPublishIn);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    public function searchSpec($idFacultet) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idSpeciality', $this->idSpeciality);
        $criteria->compare('SpecialityName', $this->SpecialityName, true);
        $criteria->compare('SpecialityKode', $this->SpecialityKode, true);
        $criteria->compare('FacultetID', $this->FacultetID);
        $criteria->compare('SpecialityClasifierCode', $this->SpecialityClasifierCode, true);
        $criteria->compare('SpecialityBudgetCount', $this->SpecialityBudgetCount);
        $criteria->compare('SpecialityContractCount', $this->SpecialityContractCount);
        $criteria->compare('isZaoch', $this->isZaoch);
        $criteria->compare('PersonEducationFormID', $this->PersonEducationFormID);
        $criteria->compare('isPublishIn', $this->isPublishIn);
        $criteria->compare('YearPrice', $this->YearPrice);
        $criteria->compare('WordPrice', $this->WordPrice);
        $criteria->compare('FacultetID', $idFacultet);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10000,
            ),
            'sort' => array(
                'attributes' => array("",
                ),
            ),
        ));
    }

    public function getSpecialityFullNames() {
        $Data = $this->findAll();

        $data = array();
        for ($i = 0; $i < count($Data); $i++) {
            $specID = $Data[$i]->getAttribute('idSpeciality');
            $BachelorSpecNm = $Data[$i]->getAttribute('SpecialityDirectionName');
            $Specialization = $Data[$i]->getAttribute('SpecialitySpecializationName');
            $FormID = $Data[$i]->getAttribute('PersonEducationFormID');
            $Form = "Денна";
            switch ($FormID) {
                case 2: $Form = "Заочна";
                    break;
                case 3: $Form = "Екстернат";
                    break;
            }
            if (!empty($BachelorSpecNm)) {
                $data[$i]['spec'] = $BachelorSpecNm . " " . $Specialization . " (" . $Form . ")";
                $data[$i]['id'] = $specID;
            }
        }

        sort($data);
        for ($i = 0; $i < count($data); $i++) {
            $d[$data[$i]['id']] = $data[$i]['spec'];
        }
        unset($data);
        return $d;
    }

    public static function getAllSpecialityFullNamesWichCodes() {
        $Data = Specialities::model()->findAll();
        $res = array();
        foreach ($Data as $record) {
            $res[$record->idSpeciality] = (!empty($record->SpecialityName) ? $record->SpecialityName . " " : "" ) . $record->SpecialityDirectionName . (!empty($record->SpecialitySpecializationName) ? ": " . $record->SpecialitySpecializationName . " " : "") . "(" . $record->SpecialityClasifierCode . ")";
        }
        return $res;
    }

    public function getSpecialityFullName() {
        $record = $this;
        $res = (!empty($record->SpecialityName) ? $record->SpecialityName . " " : "" ) . $record->SpecialityDirectionName . (!empty($record->SpecialitySpecializationName) ? ": " . $record->SpecialitySpecializationName . " " : "") . "(" . $record->SpecialityClasifierCode . ")";
        if (!empty($record->PersonEducationFormID)) {
            switch ($record->PersonEducationFormID) {
                case "1": $res.="(Д)";
                    break;
                case "2": $res.="(З)";
                    break;
                case "3": $res.="(Е)";
                    break;
            }
        }
        return $res;
    }

}
