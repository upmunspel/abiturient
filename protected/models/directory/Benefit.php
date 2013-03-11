<?php

/**
 * This is the model class for table "benefit".
 *
 * The followings are the available columns in table 'benefit':
 * @property integer $idBenefit
 * @property string $BenefitName
 * @property string $BenefitKey
 * @property integer $BenefitGroupID
 * @property integer $Visible
 */
class Benefit extends CActiveRecord
{
    
    
        public function getBenefitGroup (){
            $obj = Benefitsgroups::model()->findByPk($this->BenefitGroupID); 
            $res = "";
            if (!empty($obj)){
                $res = $obj->BenefitsGroupsName;
            }
            return $res;
        }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Benefit the static model class
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
		return 'benefit';
	}
        public static function DropDown($groupid = 0){
           $res = array();
           if ($groupid == 0){
                foreach(Benefit::model()->findAll("visible = :visible", array(":visible"=>1))as $record) {

                     $res[$record->idBenefit] = $record->BenefitName;
                }
           } else {
               foreach(Benefit::model()->findAll("visible = :visible and BenefitGroupID = $groupid", array(":visible"=>1,))as $record) {

                     $res[$record->idBenefit] = $record->BenefitName;
               }
           }
           return $res;
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idBenefit, Visible', 'required'),
			array('idBenefit, BenefitGroupID, Visible', 'numerical', 'integerOnly'=>true),
			array('BenefitName', 'length', 'max'=>250),
			array('BenefitKey', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idBenefit, BenefitName, BenefitKey, BenefitGroupID, Visible', 'safe', 'on'=>'search'),
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
                    'idBenefit' => 'Код пільги',
                    'BenefitName' => 'Назва пільги',
                    'BenefitKey' => 'Ключ пільги',
                    'BenefitGroupID' => 'Група пільги',
                    'BenefitGroup'=>'Група пільги',
                    'Visible' => 'Відображати при виборі',
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

		$criteria->compare('idBenefit',$this->idBenefit);
		$criteria->compare('BenefitName',$this->BenefitName,true);
		$criteria->compare('BenefitKey',$this->BenefitKey,true);
		$criteria->compare('BenefitGroupID',$this->BenefitGroupID);
		$criteria->compare('Visible',$this->Visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}