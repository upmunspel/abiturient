<?php

/**
 * This is the model class for table "vypuskniki_statx".
 *
 * The followings are the available columns in table 'vypuskniki_statx':
 * @property string $Fakultet
 * @property string $Specialnost
 * @property string $vypusknik
 * @property string $kem_vydan_diplom
 */
class GraduatedAbiStat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GraduatedAbiStat the static model class
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
		return 'vypuskniki_statx';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Fakultet', 'length', 'max'=>255),
			array('Specialnost', 'length', 'max'=>216),
			array('vypusknik', 'length', 'max'=>302),
			array('kem_vydan_diplom', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Fakultet, Specialnost, vypusknik, kem_vydan_diplom', 'safe', 'on'=>'search'),
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
    'Fakultet' => 'Факультет',
    'Specialnost' => 'Спеціальність',
    'vypusknik' => 'Абітурієнт-випускник',
    'kem_vydan_diplom' => 'Ким виданий диплом',
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

		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('vypusknik',$this->vypusknik,true);
		$criteria->compare('kem_vydan_diplom',$this->kem_vydan_diplom,true);
                $criteria->addCondition("kem_vydan_diplom NOT LIKE '%Запорізький національний університет%'");
                $criteria->order = "vypusknik, Fakultet, Specialnost";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination' => array(
                          'pageSize' => 1000
                        )
		));
	}
}