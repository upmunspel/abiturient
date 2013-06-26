<?php

/**
 * This is the model class for table "sys_pk".
 *
 * The followings are the available columns in table 'sys_pk':
 * @property integer $idPk
 * @property integer $PkName
 * @property integer $DepartmentID
 * @property integer $CourseID
 * @property integer $QualificationID
 * @property string $SpecMask
 * @property string $Info
 * @property string $isBudget
 * @property string $isContract
 * @property string $isShortForm
 * @property integer $EducationFormID
 * @property string $printIP
 * @property string $searchIP
 */
class SysPk extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SysPk the static model class
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
        return 'sys_pk';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('PkName, DepartmentID, printIP, searchIP', 'required'),
            array('DepartmentID, CourseID, QualificationID', 'numerical', 'integerOnly'=>true),
            array('SpecMask, Info, CourseID, isBudget,isShortForm, isContract, EducationFormID, QualificationID', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idPk, PkName, DepartmentID, CourseID, QualificationID, SpecMask, Info, Course, Qualification, Department', 'safe', 'on'=>'search'),
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
                    "Department"=>array(self::BELONGS_TO, "SysDepartments", "DepartmentID"),
                    "Qualification"=>array(self::BELONGS_TO, 'Qualifications', "QualificationID"),
                    "Course"=>array(self::BELONGS_TO, 'Courses',"CourseID"),
           	);
    }
        

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'idPk' => 'Код',
            'PkName' => 'Назва',
            "DepartmentID"=>'Структурний підрозділ',
            'CourseID' => 'Курс',
            'QualificationID' => 'Кваліфікація',
            "Department"=>'Структурний підрозділ',
            'Course' => 'Курс',
            'Qualification' => 'Кваліфікація',
            'SpecMask' => 'Маска спеціальності',
            'Info' => 'Додаткова інформація',       
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
       // debug(print_r($this,true));
      
        $criteria=new CDbCriteria;

        $criteria->compare('idPk',$this->idPk);
        $criteria->compare('PkName',$this->PkName);
        $criteria->compare('DepartmentID', $this->DepartmentID, true);
        $criteria->compare('CourseID',$this->CourseID);
        $criteria->compare('QualificationID',$this->QualificationID);
        $criteria->compare('SpecMask',$this->SpecMask,true);
        $criteria->compare('Info',$this->Info,true);
        $criteria->with = array("Department","Qualification","Course");
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}