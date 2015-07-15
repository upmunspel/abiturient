<?php

/**
 * This is the model class for table "languagesex".
 *
 * The followings are the available columns in table 'languagesex':
 * @property integer $idLanguageEx
 * @property string $LanguageExName
 *
 * The followings are the available model relations:
 * @property Personspeciality[] $personspecialities
 */
class Languagesex extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Languagesex the static model class
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
		return 'languagesex';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idLanguageEx', 'required'),
			array('idLanguageEx', 'numerical', 'integerOnly'=>true),
			array('LanguageExName', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('IdLanguageEx, LanguageExName', 'safe', 'on'=>'search'),
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
			'personspecialities' => array(self::HAS_MANY, 'Personspeciality', 'LanguageExID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idLanguageEx' => 'Id Language Ex',
    'LanguageExName' => 'Language Ex Name',
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

		$criteria->compare('idLanguageEx',$this->idLanguageEx);
		$criteria->compare('LanguageExName',$this->LanguageExName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}