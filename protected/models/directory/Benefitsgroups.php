<?php

/**
 * This is the model class for table "benefitsgroups".
 *
 * The followings are the available columns in table 'benefitsgroups':
 * @property integer $idBenefitsGroups
 * @property string $BenefitsGroupsName
 *
 * The followings are the available model relations:
 * @property Benefit[] $benefits
 */
class Benefitsgroups extends CActiveRecord
{
            
        public static function DropDowns(){
            $data=Benefitsgroups::model()->findAll();
            $result = array(); 
            if (!empty($data)) {
                foreach($data as $obj)
                {
                  $result[$obj->idBenefitsGroups] = $obj->BenefitsGroupsName;  
                }
            }
            return $result;
        }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Benefitsgroups the static model class
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
		return 'benefitsgroups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('idBenefitsGroups', 'required'),
			array('idBenefitsGroups', 'numerical', 'integerOnly'=>true),
			array('BenefitsGroupsName', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idBenefitsGroups, BenefitsGroupsName', 'safe', 'on'=>'search'),
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
			'benefits' => array(self::HAS_MANY, 'Benefit', 'BenefitGroupID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'idBenefitsGroups' => 'Код',
                    'BenefitsGroupsName' => 'Назва групи',
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

		$criteria->compare('idBenefitsGroups',$this->idBenefitsGroups);
		$criteria->compare('BenefitsGroupsName',$this->BenefitsGroupsName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}