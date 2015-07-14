<?php

/**
 * This is the model class for table "convert_attestat".
 *
 * The followings are the available columns in table 'convert_attestat':
 * @property double $twelve_p
 * @property double $two_hundred_p
 */
class ConvertAttestat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConvertAttestat the static model class
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
		return 'convert_attestat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('twelve_p, two_hundred_p', 'required'),
			array('twelve_p, two_hundred_p', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('twelve_p, two_hundred_p', 'safe', 'on'=>'search'),
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
    'twelve_p' => 'Twelve P',
    'two_hundred_p' => 'Two Hundred P',
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

		$criteria->compare('twelve_p',$this->twelve_p);
		$criteria->compare('two_hundred_p',$this->two_hundred_p);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}