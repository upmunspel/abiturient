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
 * @property integer $isZaoch
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
class Specialities extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Specialities the static model class
	 */
        public static function DropDownMask($FacultetID = 0, $EducationFormID = 0){
            $user = Yii::app()->user->getUserModel();
            $records = array();
            $res = array();
            
            
            if ($EducationFormID == 0){
                    if (!empty($user->syspk) &&  !empty($user->syspk->SpecMask)){
                        if ($FacultetID == 0){
                            if ($user->syspk->SpecMask == "7" || $user->syspk->SpecMask == "8") {
                                $records = Specialities::model()->findAll("SpecialityClasifierCode like '7%' or SpecialityClasifierCode like '8%'");
                            } else {
                                $records = Specialities::model()->findAll("SpecialityClasifierCode like '{$user->syspk->SpecMask}%'");
                            }

                        } else {
                            if ($user->syspk->SpecMask == "7" || $user->syspk->SpecMask == "8") {
                                $records = Specialities::model()->findAll("FacultetID = :FacultetID and (SpecialityClasifierCode like '7%' or SpecialityClasifierCode like '8%')", array(":FacultetID"=>$FacultetID));
                            } else {
                                $records = Specialities::model()->findAll("FacultetID = :FacultetID and SpecialityClasifierCode like '{$user->syspk->SpecMask}%'", array(":FacultetID"=>$FacultetID));
                            }
                        }
                    } else {
                        if ($FacultetID == 0){
                            $records = Specialities::model()->findAll(); 
                        } else {
                            $records = Specialities::model()->findAll("FacultetID = :FacultetID", array(":FacultetID"=>$FacultetID)); 
                        }
                    }


                    foreach($records as $record) {
                           $res[$record->idSpeciality] =(!empty($record->SpecialityName)? $record->SpecialityName." " :"" ).$record->SpecialityDirectionName.(!empty($record->SpecialitySpecializationName) ? ": ".$record->SpecialitySpecializationName." ":"")."(".$record->SpecialityClasifierCode.")";
                    }
            } else {
                
                if (!empty($user->syspk) &&  !empty($user->syspk->SpecMask)){
                        if ($FacultetID == 0){
                            if ($user->syspk->SpecMask == "7" || $user->syspk->SpecMask == "8") {
                                $records = Specialities::model()->findAll("SpecialityClasifierCode like '7%' or SpecialityClasifierCode like '8%' ");
                            } else {
                                 $records = Specialities::model()->findAll("SpecialityClasifierCode like '{$user->syspk->SpecMask}%'");
                            }

                        } else {
                             if ($user->syspk->SpecMask == "7" || $user->syspk->SpecMask == "8") {
                                $records = Specialities::model()->findAll("FacultetID = :FacultetID and PersonEducationFormID = :EducationFormID and (SpecialityClasifierCode like '7%' or SpecialityClasifierCode like '8%')", array(":FacultetID"=>$FacultetID,":EducationFormID"=>$EducationFormID));
                            } else {
                                $records = Specialities::model()->findAll("FacultetID = :FacultetID and PersonEducationFormID = :EducationFormID and SpecialityClasifierCode like '{$user->syspk->SpecMask}%'", array(":FacultetID"=>$FacultetID, ":EducationFormID"=>$EducationFormID));
                            }
                        }
                    } else {
                        if ($FacultetID == 0){
                            $records = Specialities::model()->findAll(); 
                        } else {
                            $records = Specialities::model()->findAll("PersonEducationFormID = :EducationFormID and FacultetID = :FacultetID", array(":FacultetID"=>$FacultetID, ":EducationFormID"=>$EducationFormID)); 
                        }
                    }


                    foreach($records as $record) {
                           $res[$record->idSpeciality] =(!empty($record->SpecialityName)? $record->SpecialityName." " :"" ).$record->SpecialityDirectionName.(!empty($record->SpecialitySpecializationName) ? ": ".$record->SpecialitySpecializationName." ":"")."(".$record->SpecialityClasifierCode.")";
                    }
                
            }
          return $res;
	}
        
        public static function DropDown($FacultetID = 0){
              $res = array();
              $c = new CDbCriteria();
              $c->order = 'SpecialityDirectionName';
              if ($FacultetID != 0){
                  $c->compare('FacultetID', $FacultetID);
              }
             
                foreach(Specialities::model()->findAll($c) as $record) {
                       $res[$record->idSpeciality] =  ($res[$record->idSpeciality] = (!empty($record->SpecialityName)? $record->SpecialityName." " :"" ).$record->SpecialityDirectionName.(!empty($record->SpecialitySpecializationName) ? ": ".$record->SpecialitySpecializationName." ":"")."(".$record->SpecialityClasifierCode.")");
                      if (!empty($record->PersonEducationFormID) &&  $record->PersonEducationFormID == 1) {
                          $res[$record->idSpeciality].="(Д)";
                      } else {
                          $res[$record->idSpeciality].="(З)";
                      }
                }
             
          return $res;
	}
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
      
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'specialities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idSpeciality', 'required'),
			array('idSpeciality, FacultetID, SpecialityBudgetCount, 
                              SpecialityContractCount, isZaoch, isPublishIn', 'numerical', 'integerOnly'=>true),
			array('SpecialityName', 'length', 'max'=>100),
			array('SpecialityKode', 'length', 'max'=>40),
			array('SpecialityClasifierCode', 'length', 'max'=>12),
                        array("WordPrice, StudyPeriodID","safe"),
                        array("YearPrice, SemPrice", 'numerical', 'integerOnly'=>false),
                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idSpeciality, SpecialityName, SpecialityKode, 
                            FacultetID, SpecialityClasifierCode, SpecialityBudgetCount, SpecialityContractCount, isZaoch, isPublishIn, 
                            WordPrice, YearPrice', 'safe', 'on'=>'search'),
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
			'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'SepcialityID'),
			'facultet' => array(self::BELONGS_TO, 'Facultets', 'FacultetID'),
                       
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'idSpeciality' => 'Id Speciality',
                    'SpecialityName' => 'Спеціальність',
                    'SpecialityKode' => 'Speciality Kode',
                    'FacultetID' => 'Facultet',
                    'SpecialityClasifierCode' => 'Speciality Clasifier Code',
                    'SpecialityBudgetCount' => 'Speciality Budget Count',
                    'SpecialityContractCount' => 'Speciality Contract Count',
                    'isZaoch' => 'Is Zaoch',
                    'isPublishIn' => 'Is Publish In',
                    'WordPrice'=>"Загальна вартість прописом",
                    'YearPrice'=>"Загальна вартість",
                    'SemPrice'=>"Ціна за семестр",
                    "PersonEducationFormID"=>"Форма освіти",
                    "StudyPeriodID"=>"Період"
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

		$criteria->compare('idSpeciality',$this->idSpeciality);
		$criteria->compare('SpecialityName',$this->SpecialityName,true);
		$criteria->compare('SpecialityKode',$this->SpecialityKode,true);
		$criteria->compare('FacultetID',$this->FacultetID);
		$criteria->compare('SpecialityClasifierCode',$this->SpecialityClasifierCode,true);
		$criteria->compare('SpecialityBudgetCount',$this->SpecialityBudgetCount);
		$criteria->compare('SpecialityContractCount',$this->SpecialityContractCount);
		$criteria->compare('isZaoch',$this->isZaoch);
		$criteria->compare('isPublishIn',$this->isPublishIn);
               
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchSpec($idFacultet)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                
		$criteria->compare('idSpeciality',$this->idSpeciality);
		$criteria->compare('SpecialityName',$this->SpecialityName,true);
		$criteria->compare('SpecialityKode',$this->SpecialityKode,true);
		$criteria->compare('FacultetID',$this->FacultetID);
		$criteria->compare('SpecialityClasifierCode',$this->SpecialityClasifierCode,true);
		$criteria->compare('SpecialityBudgetCount',$this->SpecialityBudgetCount);
		$criteria->compare('SpecialityContractCount',$this->SpecialityContractCount);
		$criteria->compare('isZaoch',$this->isZaoch);
		$criteria->compare('isPublishIn',$this->isPublishIn);
                $criteria->compare('YearPrice',$this->YearPrice);
                $criteria->compare('WordPrice',$this->WordPrice);
                $criteria->compare('FacultetID',$idFacultet);
                
                return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                         ),
                      'sort' =>array(
                            'attributes' =>array("",

                           ),
                       ),
                    
		));
	}
        public function getSpecialityFullNames(){
            $Data = $this->findAll();

            $data = array();
            for ($i = 0; $i < count($Data); $i++){
                $specID = $Data[$i]->getAttribute('idSpeciality');
                $BachelorSpecNm = $Data[$i]->getAttribute('SpecialityDirectionName');
                $Specialization = $Data[$i]->getAttribute('SpecialitySpecializationName');
                $FormID = $Data[$i]->getAttribute('PersonEducationFormID');
                $Form = "Денна";
                switch($FormID){
                    case 2: $Form = "Заочна"; break;
                    case 3: $Form = "Екстернат"; break;
                }
                if (!empty($BachelorSpecNm)){
                    $data[$i]['spec'] = $BachelorSpecNm." ".$Specialization." (".$Form.")";
                    $data[$i]['id'] = $specID;
                }
            }

            sort($data);
            for ($i = 0; $i < count($data); $i++){
                $d[$data[$i]['id']] = $data[$i]['spec'];
            }
            unset($data);
            return $d;
        }
}