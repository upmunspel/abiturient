<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property integer $idDocuments
 * @property integer $PersonID
 * @property integer $TypeID
 * @property string $Series
 * @property string $Numbers
 * @property string $DateGet
 * @property integer $ZNOPin
 * @property string $AtestatValue
 * @property string $Issued
 * @property integer $isCopy
 */
class Documents extends ActiveRecord
{
	
        public static function PersonEntrantDocuments($PersonID){
            $res = array();
            $model = Documents::model()->findAll("PersonID = :PersonID", array(":PersonID"=>$PersonID));
            if (!empty($model)){
                foreach ($model as $doc){
                    $doctype = PersonDocumentTypes::model()->findByPk($doc->TypeID);
                    if ($doctype->IsEntrantDocument == 1){
                    $res[$doc->idDocuments] = $doctype->PersonDocumentTypesName."({$doc->Numbers})";
                    }
                }
            }
            return $res;
        }
        public static function ZNODropDown($PersonID, $SepcialityID = 0, $Level = 0){
            $res = array();
            $model = Documents::model()->findAll("PersonID = :PersonID and TypeID = 4", array(":PersonID"=>$PersonID));
            if ($SepcialityID != 0){
                $ssubj = Specialitysubjects::model()->find("SpecialityID=:SpecialityID and LevelID = :LevelID", 
                        array(":SpecialityID"=>$SepcialityID,":LevelID"=>$Level));
                
                if (!empty($model)){
                foreach ($model as $zno){
                    //$res[$zno->idDocuments] = $zno->Numbers;
                    if (!empty($zno->subjects)){
                        foreach ($zno->subjects as $subject){
                            if (!empty($ssubj->subject)){
                            if ($subject->subject->idSubjects==  $ssubj->subject->idSubjects){
                                $res[$subject->idDocumentSubject] = $subject->subject->SubjectName.": ".$subject->SubjectValue." (№".$zno->Numbers." от ".$subject->DateGet.", пин: ".$zno->ZNOPin.")";
                                }
                            } else {
                                $res[$subject->idDocumentSubject] = $subject->subject->SubjectName.": ".$subject->SubjectValue." (№".$zno->Numbers." от ".$subject->DateGet.", пин: ".$zno->ZNOPin.")";
                            }
                        }
                        }
                    }
                }
                
            } else {
            if (!empty($model)){
                foreach ($model as $zno){
                    //$res[$zno->idDocuments] = $zno->Numbers;
                    if (!empty($zno->subjects)){
                        foreach ($zno->subjects as $subject){
                            $res[$subject->idDocumentSubject] = $subject->subject->SubjectName.": ".$subject->SubjectValue." (№".$zno->Numbers." от ".$subject->DateGet.", пин: ".$zno->ZNOPin.")";
                            }
                        }
                    }
                }
            
            }
            return $res;
        } 
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getTypeGroup(){
            $rerult = PersonDocumentTypes::model()->findByPk($this->TypeID);
            return $rerult->IsEntrantDocument;
        }
        protected function afterFind() {
            $from=DateTime::createFromFormat('Y-m-d',$this->DateGet);
            $this->DateGet=$from->format('d.m.Y');   
            parent::afterFind();
            return true;
            
        }
        

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documents';
	}
        
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PersonID, TypeID, ZNOPin, isCopy', 'numerical' , 'integerOnly'=>true),
                        array('AtestatValue', 'numerical' , 'integerOnly'=>false),
			array('Series', 'length', 'max'=>10),
			array('Numbers', 'length', 'max'=>15),
			array('Issued', 'length', 'max'=>250),
			array('DateGet, idDocuments, Series, Numbers,  ', 'safe'),
                    
                        array('DateGet, Series, Numbers, Issued', 'required', "except"=>"INN, HOSP, ZNO"),
                        // INN
                        array('Numbers', 'required', "on"=>"INN"),
                        array('Numbers', 'numerical' , 'integerOnly'=>true, "on"=>"INN"),
                        array('Numbers', 'length', 'is'=>10, "on"=>"INN"),
                        // HOST
                        array('DateGet', 'required', "on"=>"HOSP"),
                        // ENTRANT 
                        array('AtestatValue', 'required', "on"=>"ENTRANT"),
                        /* ZNO SCENARIO */
                        array('Numbers, ZNOPin', 'required', "on"=>"ZNO"),
                        array('Numbers', 'numerical', "on"=>"ZNO"),
                        array('Numbers', 'length', 'is'=>7, "on"=>"ZNO"),
                        array('ZNOPin', 'numerical', "on"=>"ZNO"),
                        array('ZNOPin', 'length', 'is'=>4, "on"=>"ZNO"),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idDocuments, PersonID, TypeID, Series, Numbers, DateGet, ZNOPin, AtestatValue, Issued, isCopy', 'safe', 'on'=>'search'),
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
                    "subjects"=>array(self::HAS_MANY, "Documentsubject", "DocumentID"),
                    "type"=>array(self::BELONGS_TO, "PersonDocumentTypes", "TypeID"),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idDocuments' => 'Id Documents',
			'PersonID' => 'Person',
			'TypeID' => 'Тип документу',
			'Series' => 'Серія ',
			'Numbers' => 'Номер',
			'DateGet' => 'Дата видачі',
			'ZNOPin' => 'ЗНО Пин',
			'AtestatValue' => 'Серадній бал',
			'Issued' => 'Ким виданий',
			'isCopy' => 'Копія',
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

		$criteria->compare('idDocuments',$this->idDocuments);
		$criteria->compare('PersonID',$this->PersonID);
		$criteria->compare('TypeID',$this->TypeID);
		$criteria->compare('Series',$this->Series,true);
		$criteria->compare('Numbers',$this->Numbers,true);
		$criteria->compare('DateGet',$this->DateGet,true);
		$criteria->compare('ZNOPin',$this->ZNOPin);
		$criteria->compare('AtestatValue',$this->AtestatValue,true);
		$criteria->compare('Issued',$this->Issued,true);
		$criteria->compare('isCopy',$this->isCopy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       
        protected function beforeSave() {
          
            $this->DateGet=date('Y-m-d',  strtotime($this->DateGet));      
            return parent::beforeSave();
          
        }
        
}