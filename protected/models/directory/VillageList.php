<?php

/**
 * This is the model class for table "village_list".
 *
 * The followings are the available columns in table 'village_list':
 * @property string $surname
 * @property string $name
 * @property string $fartherName
 * @property integer $edbo
 * @property string $place
 * @property string $region
 * @property string $city
 * @property string $cityVillage
 */
class VillageList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VillageList the static model class
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
		return 'village_list';
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
			array('surname, name, fartherName, spec', 'length', 'max'=>100),
			array('place', 'length', 'max'=>2),
			array('region, edu_form, status', 'length', 'max'=>50),
			array('city, cityVillage', 'length', 'max'=>75),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('surname, name, fartherName, edbo, place, region, city, cityVillage, spec, edu_form, status', 'safe', 'on'=>'search'),
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
    'place' => 'ТИП',
    'region' => 'Регіон',
    'city' => 'Насел. Пункт',
    'cityVillage' => 'Район',
    'spec' => 'Спеціальність',
    'edu_form' => 'Форма навчання',
    'status' => 'Статус заявки',
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
		$criteria->compare('place',$this->place,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('cityVillage',$this->cityVillage,true);
                $criteria->compare('spec',$this->spec,true);
                $criteria->compare('edu_form',$this->edu_form,true);
                $criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array(
                        'pageSize'=>10000,
                    )
		));
	}
}