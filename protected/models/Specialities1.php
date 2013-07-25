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
 */
class Specialities1 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Specialities the static model class
	 */
        public static function listData(){
            
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
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idSpeciality' => 'Номер спеціальності',
    'SpecialityName' => 'Назва спеціальності',
    'SpecialityKode' => 'Код спеціальності',
    'FacultetID' => 'Факультет',
    'SpecialityClasifierCode' => 'SpecialityClasifierCode',
    'SpecialityBudgetCount' => 'Граф особливого бюджету',
    'SpecialityContractCount' => 'Граф особливого договору',
    'isZaoch' => 'Is Zaoch',
    'isPublishIn' => 'Є публікації в',
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