<?php

/**
 * This is the model class for table "resident_list".
 *
 * The followings are the available columns in table 'resident_list':
 * @property string $surname
 * @property string $name
 * @property string $fartherName
 * @property integer $edbo
 * @property string $country
 * @property string $edu
 * @property string $statusname
 * @property string $spec
 */
class ResidentList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResidentList the static model class
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
		return 'resident_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('edbo', 'numerical', 'integerOnly'=>true),
			array('surname, name, fartherName', 'length', 'max'=>100),
			array('country', 'length', 'max'=>255),
			array('edu, statusname', 'length', 'max'=>45),
			array('spec', 'length', 'max'=>315),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('surname, name, fartherName, edbo, country, edu, statusname, spec', 'safe', 'on'=>'search'),
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
    'surname' => 'Прізвище',
    'name' => 'Ім\'я',
    'fartherName' => 'По батькові',
    'edbo' => 'Edbo',
    'country' => 'Держава',
    'edu' => 'Форма',
    'statusname' => 'Статус заявки',
    'spec' => 'Спеціальність',
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

		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('fartherName',$this->fartherName,true);
		$criteria->compare('edbo',$this->edbo);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('edu',$this->edu,true);
		$criteria->compare('statusname',$this->statusname,true);
		$criteria->compare('spec',$this->spec,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
                        'pageSize'=>10000,
                    )
		));
	}
}