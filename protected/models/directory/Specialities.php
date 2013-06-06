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
 *
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
        public static function DropDownMask($FacultetID = 0){
            $user = Yii::app()->user->getUserModel();
            $records = array();
            $res = array();
            if (!empty($user->syspk) &&  !empty($user->syspk->SpecMask)){
                if ($FacultetID == 0){
                    $records = Specialities::model()->findAll("SpecialityClasifierCode like '{$user->syspk->SpecMask}%'");
            
                } else {
                    $records = Specialities::model()->findAll("FacultetID = :FacultetID and SpecialityClasifierCode like '{$user->syspk->SpecMask}%'", array(":FacultetID"=>$FacultetID));
            
                }
            } else {
                if ($FacultetID == 0){
                    $records = Specialities::model()->findAll(); 
                } else {
                    $records = Specialities::model()->findAll("FacultetID = :FacultetID", array(":FacultetID"=>$FacultetID)); 
                }
            }
            
            
            foreach($records as $record) {
                   $res[$record->idSpeciality] = $record->SpecialityDirectionName.(!empty($record->SpecialitySpecializationName) ? ": ".$record->SpecialitySpecializationName." ":"")."(".$record->SpecialityClasifierCode.")";
            }
          return $res;
	}
        public static function DropDown($FacultetID = 0){
              $res = array();
              if ($FacultetID == 0){
                foreach(Specialities::model()->findAll() as $record) {
                       $res[$record->idSpeciality] =  $res[$record->idSpeciality] = $record->SpecialityDirectionName.(!empty($record->SpecialitySpecializationName) ? ": ".$record->SpecialitySpecializationName." ":"")."(".$record->SpecialityClasifierCode.")";
                }
              } else {
                foreach(Specialities::model()->findAll("FacultetID = :FacultetID", array(":FacultetID"=>$FacultetID)) as $record) {
                       $res[$record->idSpeciality] =  $res[$record->idSpeciality] = $record->SpecialityDirectionName.(!empty($record->SpecialitySpecializationName) ? ": ".$record->SpecialitySpecializationName." ":"")."(".$record->SpecialityClasifierCode.")";
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
			array('idSpeciality, FacultetID, SpecialityBudgetCount, SpecialityContractCount, isZaoch, isPublishIn', 'numerical', 'integerOnly'=>true),
			array('SpecialityName', 'length', 'max'=>100),
			array('SpecialityKode', 'length', 'max'=>40),
			array('SpecialityClasifierCode', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idSpeciality, SpecialityName, SpecialityKode, FacultetID, SpecialityClasifierCode, SpecialityBudgetCount, SpecialityContractCount, isZaoch, isPublishIn', 'safe', 'on'=>'search'),
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
    'SpecialityName' => 'Speciality Name',
    'SpecialityKode' => 'Speciality Kode',
    'FacultetID' => 'Facultet',
    'SpecialityClasifierCode' => 'Speciality Clasifier Code',
    'SpecialityBudgetCount' => 'Speciality Budget Count',
    'SpecialityContractCount' => 'Speciality Contract Count',
    'isZaoch' => 'Is Zaoch',
    'isPublishIn' => 'Is Publish In',
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
}