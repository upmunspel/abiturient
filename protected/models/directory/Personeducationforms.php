<?php

/**
 * This is the model class for table "personeducationforms".
 *
 * The followings are the available columns in table 'personeducationforms':
 * @property integer $idPersonEducationForm
 * @property string $PersonEducationFormName
 *
 * The followings are the available model relations:
 * @property Personsepciality[] $personsepcialities
 */
class Personeducationforms extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personeducationforms the static model class
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
		return 'personeducationforms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonEducationForm', 'required'),
			array('idPersonEducationForm', 'numerical', 'integerOnly'=>true),
			array('PersonEducationFormName', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonEducationForm, PersonEducationFormName', 'safe', 'on'=>'search'),
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
			'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'EducationFormID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idPersonEducationForm' => 'Id Person Education Form',
    'PersonEducationFormName' => 'Person Education Form Name',
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

		$criteria->compare('idPersonEducationForm',$this->idPersonEducationForm);
		$criteria->compare('PersonEducationFormName',$this->PersonEducationFormName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}