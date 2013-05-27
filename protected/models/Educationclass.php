<?php

/**
 * This is the model class for table "educationclass".
 *
 * The followings are the available columns in table 'educationclass':
 * @property integer $idEducationClass
 * @property string $EducationClassName
 *
 * The followings are the available model relations:
 * @property Educationtype[] $educationtypes
 */
class Educationclass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Educationclass the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public static function DropDown(){
           $res = array();
           foreach(Educationclass::model()->findAll()as $record) {
                $res[$record->idEducationClass] = $record->EducationClassName;
           }
           return $res;
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'educationclass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEducationClass, EducationClassName', 'required'),
			array('idEducationClass', 'numerical', 'integerOnly'=>true),
			array('EducationClassName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEducationClass, EducationClassName', 'safe', 'on'=>'search'),
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
			'educationtypes' => array(self::HAS_MANY, 'Educationtype', 'EducationTypeClassID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idEducationClass' => 'Id Education Class',
    'EducationClassName' => 'Education Class Name',
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

		$criteria->compare('idEducationClass',$this->idEducationClass);
		$criteria->compare('EducationClassName',$this->EducationClassName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}