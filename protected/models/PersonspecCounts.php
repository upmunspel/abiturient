<?php

/**
 * This is the model class for table "personspec_counts".
 *
 * The followings are the available columns in table 'personspec_counts':
 * @property string $_date_
 * @property string $_count_
 * @property integer $idPersonSpeciality
 */
class PersonspecCounts extends CActiveRecord
{
    public function primaryKey() {
        return "idPersonSpeciality";
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonspecCounts the static model class
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
		return 'personspec_counts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonSpeciality', 'numerical', 'integerOnly'=>true),
			array('_date_', 'length', 'max'=>10),
			array('_count_', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_date_, _count_, idPersonSpeciality', 'safe', 'on'=>'search'),
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
    '_date_' => 'Дата',
    '_count_' => 'Кількість',
    'idPersonSpeciality' => 'ID',
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

		$criteria->compare('_date_',$this->_date_,true);
		$criteria->compare('_count_',$this->_count_,true);
		$criteria->compare('idPersonSpeciality', $this->idPersonSpeciality);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
                        'pageSize'=>10000,
                    )
		));
	}
}