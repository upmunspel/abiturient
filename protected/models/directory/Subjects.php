<?php

/**
 * This is the model class for table "subjects".
 *
 * The followings are the available columns in table 'subjects':
 * @property integer $idSubjects
 * @property integer $idZNOSubject
 * @property string $SubjectName
 * @property integer $ParentSubject
 * @property string $SubjectKey
 *
 * The followings are the available model relations:
 * @property Documentsubject[] $documentsubjects
 * @property Personsepciality[] $personsepcialities
 * @property Personsepciality[] $personsepcialities1
 * @property Personsepciality[] $personsepcialities2
 */
class Subjects extends CActiveRecord
{
     
        public static function DropDown($SepcialityID = 0, $Level = 0){
           $res = array();
           $c = new CDbCriteria();
           $c->order = 'SubjectName';
          
           //if ($SepcialityID == 0){
                foreach(Subjects::model()->findAll($c) as $record) {
                     $res[$record->idSubjects] = $record->SubjectName;
                }
//           } else {
//               
//                $ssubj = Specialitysubjects::model()->find("SpecialityID=:SpecialityID and LevelID = :LevelID", 
//                        array(":SpecialityID"=>$SepcialityID,":LevelID"=>$Level));
//                if (!empty($ssubj->subject)){
//                      $res[$ssubj->subject->idSubjects] = $ssubj->subject->SubjectName;
//                } else {
//                    foreach(Subjects::model()->findAll() as $record) {
//                         $res[$record->idSubjects] = $record->SubjectName;
//                    }
//                }
//            }
           return $res;
        }	
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subjects the static model class
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
		return 'subjects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idSubjects', 'required'),
			array('idSubjects, idZNOSubject, ParentSubject', 'numerical', 'integerOnly'=>true),
			array('SubjectName', 'length', 'max'=>50),
			array('SubjectKey', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idSubjects, idZNOSubject, SubjectName, ParentSubject, SubjectKey', 'safe', 'on'=>'search'),
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
                 
//			'documentsubjects' => array(self::HAS_MANY, 'Documentsubject', 'SubjectID'),
//			'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'Exam1ID'),
//			'personsepcialities1' => array(self::HAS_MANY, 'Personsepciality', 'Exam2ID'),
//			'personsepcialities2' => array(self::HAS_MANY, 'Personsepciality', 'Exam3ID'),
		
			'documentsubjects' => array(self::HAS_MANY, 'Documentsubject', 'SubjectID'),
			'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'Exam1ID'),
			'personsepcialities1' => array(self::HAS_MANY, 'Personsepciality', 'Exam2ID'),
			'personsepcialities2' => array(self::HAS_MANY, 'Personsepciality', 'Exam3ID'),
                        'personsepcialities2' => array(self::HAS_MANY, 'Personsepciality', 'Exam3ID'),
                        'is' => array(self::HAS_MANY, 'Subjects', 'idSubjects'),
                        'ps' => array(self::BELONGS_TO, 'Subjects', 'ParentSubject'),
                    );
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idSubjects' => 'Код предмета',
    'idZNOSubject' => 'Id Znosubject',
    'SubjectName' => 'Назва предмета',
   'ParentSubject' => 'Parent Subject',
    'SubjectKey' => 'Ключ предмета',
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

		$criteria->compare('idSubjects',$this->idSubjects);
		$criteria->compare('idZNOSubject',$this->idZNOSubject);
		$criteria->compare('SubjectName',$this->SubjectName,true);
		$criteria->compare('ParentSubject',$this->ParentSubject);
		$criteria->compare('SubjectKey',$this->SubjectKey,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}