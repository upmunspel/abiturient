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
 * @property integer $isForeinghEntrantDocument
 * @property integer $isNotCheckAttestat
 * @property integer $PersonDocumentsAwardsTypesID
 * @property integer $PersonBaseSpecealityID
 */
class Documents extends ActiveRecord
{
	
        public static function PersonEntrantDocuments($PersonID){
            $res = array();
            $model = Documents::model()->findAll("PersonID = :PersonID", array(":PersonID"=>$PersonID));
            if (!empty($model)){
                $entrCount = 0;
                $res[""]="";
                foreach ($model as $doc){
                    $doctype = PersonDocumentTypes::model()->findByPk($doc->TypeID);
                    if ($doctype->IsEntrantDocument == 1){
                     $entrCount++;   
                     $res[$doc->idDocuments] = $doctype->PersonDocumentTypesName."({$doc->Series} {$doc->Numbers})";
                    }
                }
                if ($entrCount == 1) unset($res[""]);
            }
            return $res;
        }
        public static function ZNODropDown($PersonID, $SepcialityID = 0, $Level = 0){
            $res = array(""=>"");
            
            $model = Documents::model()->findAll("PersonID = :PersonID and TypeID = 4", array(":PersonID"=>$PersonID));
            if ($SepcialityID != 0){
                $ssubj = Specialitysubjects::model()->findAll("SpecialityID=:SpecialityID and LevelID = :LevelID", 
                        array(":SpecialityID"=>$SepcialityID,":LevelID"=>$Level));
                //debug(print_r($ssubj,true));
                
                
                if (!empty($model)){
                foreach ($model as $zno){
                    //$res[$zno->idDocuments] = $zno->Numbers;
                    if (!empty($zno->subjects)){
                        foreach ($zno->subjects as $subject){
                            if (!empty($ssubj)){
                                //debug('$ssubj->SubjectID='.$ssubj->SubjectID);
                                
                                foreach ($ssubj as $rec){
                                    if ($subject->subject->idSubjects ==  $rec->SubjectID){
                                        //debug('$ssubj->SubjectID='.$ssubj->SubjectID);
                                        $res[$subject->idDocumentSubject] = $subject->subject->SubjectName.": ".$subject->SubjectValue." (№".$zno->Numbers." от ".$subject->DateGet.", пін: ".$zno->ZNOPin.")";
                                    }
                                }
                            } else {
                                    $res[$subject->idDocumentSubject] = $subject->subject->SubjectName.": ".$subject->SubjectValue." (№".$zno->Numbers." от ".$subject->DateGet.", пін: ".$zno->ZNOPin.")";
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
                            $res[$subject->idDocumentSubject] = $subject->subject->SubjectName.": ".$subject->SubjectValue." (№".$zno->Numbers." от ".$subject->DateGet.", пін: ".$zno->ZNOPin.")";
                            }
                        }
                    }
                }
            
            }
            if (count($res) == 2) unset($res[""]);
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
            if (!empty($this->DateGet) && $this->DateGet != "1970-01-01" ){
                $from=DateTime::createFromFormat('Y-m-d',$this->DateGet);
                $this->DateGet=$from->format('d.m.Y'); 
            } else {
                $this->DateGet = NULL;
            }
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
			array('DateGet, idDocuments, Series, Numbers, PersonDocumentsAwardsTypesID, isForeinghEntrantDocument, isNotCheckAttestat, PersonBaseSpecealityID, edboID', 'safe'),
                        
                        //array('DateGet', 'date', "format"=>'dd.MM.yyyy', 'allowEmpty'=>true ),
                    
                        array('DateGet, Series, Numbers, Issued', 'required', "except"=>"INN, HOSP, ZNO, FULLINPUT"),
                    
                        array('TypeID+Series+Numbers', 'ext.uniqueMultiColumnValidator', 'message'=>"Тип, серія та номер документу не є унікальними!",
                            'except'=>"INN, HOSP, ZNO, FULLINPUT"),
                        // INN
                        array('Numbers', 'required', "on"=>"INN"),
                        array('Numbers', 'numerical' , 'integerOnly'=>true, "on"=>"INN"),
                        array('Numbers', 'length', 'is'=>10, "on"=>"INN"),
                        // HOST
                        array('DateGet', 'required', "on"=>"HOSP"),
                        // ENTRANT 
                        array('AtestatValue', 'required', "on"=>"ENTRANT"),
                        array('isForeinghEntrantDocument, isNotCheckAttestat, PersonDocumentsAwardsTypesID', 'safe', "on"=>"ENTRANT"),
                        

                        /* ZNO SCENARIO */
                        array('Numbers, ZNOPin, DateGet', 'required', "on"=>"ZNO"),
                        array('Numbers', 'numerical', "on"=>"ZNO"),
                        array('Numbers', 'length', 'is'=>7, "on"=>"ZNO"),
                        array('ZNOPin', 'numerical', "on"=>"ZNO"),
                        array('ZNOPin', 'length', 'is'=>4, "on"=>"ZNO"),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idDocuments, PersonID, TypeID, Series, Numbers, DateGet, ZNOPin, AtestatValue, Issued, isCopy', 'safe', 'on'=>'search'),
                        
                    
                        array('idDocuments, PersonID, TypeID, Series, Numbers, DateGet, ZNOPin, AtestatValue, Issued, isCopy', 'safe', 'on'=>'FULLINPUT'),
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
			'TypeID' => 'Тип документа',
			'Series' => 'Серія ',
			'Numbers' => 'Номер',
			'DateGet' => 'Дата видачі',
			'ZNOPin' => 'ЗНО пін',
			'AtestatValue' => 'Середній бал',
			'Issued' => 'Ким виданий',
			'isCopy' => 'Копія',
                    'isForeinghEntrantDocument'=>"Зарубіжний д-т",
                    "isNotCheckAttestat"=>"Не перевіряти атестат",
                    'PersonDocumentsAwardsTypesID'=>"Відзнаки",
                    'PersonBaseSpecealityID'=>'Базовий напрям',
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
        
        public static function loadAndSave($personid, $objarr){
            foreach($objarr as $item){
                $val = (object)$item;
               
                if ($val->id_Type == 4){
                     $doc = new Documents();
                     $doc->scenario = "FULLINPUT";
                     $doc->PersonID = $personid;
                     $doc->TypeID = $val->id_Type;
                     $doc->edboID = $val->id_Document;
                     $doc->AtestatValue=$val->attestatValue;
                     $doc->Numbers=$val->number;
                     $doc->Series=$val->series;
                     $doc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month'],  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                     $doc->ZNOPin = $val->znoPin;
                     $doc->Issued = $val->issued;
                     if ($doc->save() && !empty($val->subjects)){
                         foreach($val->subjects as $valstr){
                          $item = (object)$valstr;
                          $subj = new Documentsubject();
                          $subj->DateGet = $doc->DateGet;
                          $subj->edboID = $item->id_DocumentSubject;
                          $subj->DocumentID = $doc->idDocuments;
                          $subj->SubjectID = $item->id_Subject;
                          $subj->SubjectValue = $item->subjectValue;
                          $subj->save();
                         }
                     }
                }
                        
           }
            
        }
        
}
