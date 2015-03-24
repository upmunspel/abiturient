<?php

/**
 * This is the model class for table "statements".
 *
 * The followings are the available columns in table 'statements':
 * @property integer $idStatement
 * @property string $number
 * @property string $created
 * @property string $updated
 * @property integer $uid
 * @property integer $SpecialityID
 * @property integer $Subjects1ID
 * @property integer $Subjects2ID
 * @property integer $Subjects3ID
 * @property string $SubjectsDate1
 * @property string $SubjectsDate2
 * @property string $SubjectsDate3
 */
class Statements extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Statements the static model class
     */
    public $FacultetID;
    public $EducationFormID;

    protected function afterFind() {

        if (!empty($this->SpecialityID)) {
            $ps = Specialities::model()->findByPk($this->SpecialityID);
            $this->FacultetID = $ps->facultet->idFacultet;
            $this->EducationFormID = $ps->eduform->idPersonEducationForm;
        }

        if (isset($this->created))
            $this->created = date("d.m.Y", strtotime($this->created));
        if (isset($this->updated))
            $this->updated = date("d.m.Y", strtotime($this->updated));

        if (isset($this->SubjectsDate1))
            $this->SubjectsDate1 = date("d.m.Y", strtotime($this->SubjectsDate1));
        if (isset($this->SubjectsDate2))
            $this->SubjectsDate2 = date("d.m.Y", strtotime($this->SubjectsDate2));
        if (isset($this->SubjectsDate3))
            $this->SubjectsDate3 = date("d.m.Y", strtotime($this->SubjectsDate3));

       

        return parent::afterFind();
    }

   

    protected function beforeSave() {
        if ($this->isNewRecord)  {
            $this->created = date("Y-m-d H:i:s");
        } else {
            $this->created = date("Y-m-d H:i:s", strtotime( $this->created));
        }
        $this->updated = date("Y-m-d H:i:s");
        
        if (isset($this->SubjectsDate1))
            $this->SubjectsDate1 = date("Y-m-d H:i:s", strtotime($this->SubjectsDate1));
        if (isset($this->SubjectsDate2))
            $this->SubjectsDate2 = date("Y-m-d H:i:s", strtotime($this->SubjectsDate2));
        if (isset($this->SubjectsDate3))
            $this->SubjectsDate3 = date("Y-m-d H:i:s", strtotime($this->SubjectsDate3));
        
        return parent::beforeSave();
    }

    public function getSpecFullName() {
        return $this->spec->specialityFullName;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'statements';
    }

    protected function afterConstruct() {
        $criteria = new CDbCriteria;
        $criteria->select = 'max(idStatement) AS idStatement';
        $row = Statements::model()->find($criteria);
        $num = $row->idStatement;

        $this->number = str_pad($num + 1, 8, "0", STR_PAD_LEFT);
        //perent::afterConstruct();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, SpecialityID, Subjects1ID, Subjects2ID, Subjects3ID, SubjectsDate1, SubjectsDate2, SubjectsDate3', 'required'),
            array('uid, SpecialityID, Subjects1ID, Subjects2ID, Subjects3ID', 'numerical', 'integerOnly' => true),
            array('number', 'length', 'max' => 100),
            array('created, updated, SubjectsDate1, SubjectsDate2, SubjectsDate3', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
             array('SpecialityID', 'ext.uniqueMultiColumnValidator', 'message' => "Відомість для обраної спеціальності вже існує!"),
            array('idStatement, number, created, updated, uid, SpecialityID, Subjects1ID, Subjects2ID, Subjects3ID, SubjectsDate1, SubjectsDate2, SubjectsDate3', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'spec' => array(self::BELONGS_TO, 'Specialities', 'SpecialityID'),
            'subj1' => array(self::BELONGS_TO, 'Subjects', 'Subjects1ID'),
            'subj2' => array(self::BELONGS_TO, 'Subjects', 'Subjects2ID'),
            'subj3' => array(self::BELONGS_TO, 'Subjects', 'Subjects3ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idStatement' => 'id',
            'number' => 'Номер',
            'created' => 'Дата створення',
            'updated' => 'Дата редагування',
            'uid' => 'Uid',
            'SpecialityID' => 'Напрям підготовки (група)',
            'specFullName' => 'Напрям підготовки (група)',
            'Subjects1ID' => 'Предмет 1',
            'Subjects2ID' => 'Предмет 2',
            'Subjects3ID' => 'Предмет 2',
            'SubjectsDate1' => 'Дата предмета 1',
            'SubjectsDate2' => 'Дата предмета 2',
            'SubjectsDate3' => 'Дата предмета 3',
            "EducationFormID" => "Форма обучения",
            "FacultetID" => "Факультет"
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

        $criteria->compare('idStatement', $this->idStatement);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('uid', $this->uid);
        $criteria->compare('SpecialityID', $this->SpecialityID);
        $criteria->compare('Subjects1ID', $this->Subjects1ID);
        $criteria->compare('Subjects2ID', $this->Subjects2ID);
        $criteria->compare('Subjects3ID', $this->Subjects3ID);
        $criteria->compare('SubjectsDate1', $this->SubjectsDate1, true);
        $criteria->compare('SubjectsDate2', $this->SubjectsDate2, true);
        $criteria->compare('SubjectsDate3', $this->SubjectsDate3, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
