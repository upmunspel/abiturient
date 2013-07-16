<?php

/**
 * This is the model class for table "all_counts_per_dates".
 *
 * The followings are the available columns in table 'all_counts_per_dates':
 * @property string $Fakultet
 * @property string $Specialnost
 * @property string $dnevn
 * @property string $zaoch
 */
class AllCountsPerDates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AllCountsPerDates the static model class
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
		return 'all_counts_per_dates';
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
			array('Specialnost', 'length', 'max'=>472),
			array('dnevn, zaoch', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Fakultet, Specialnost, dnevn, zaoch', 'safe', 'on'=>'search'),
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
    'dnevn' => 'К-сть заявок (денна)',
    'zaoch' => 'К-сть заявок (заочна)',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn,true);
		$criteria->compare('zaoch',$this->zaoch,true);
                $criteria->addCondition('1 AND Specialnost LIKE \'%'.$Date.'%\'');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
        
        
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchBachelors($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn,true);
		$criteria->compare('zaoch',$this->zaoch,true);
                $criteria->addCondition('Specialnost LIKE \'%6.%\' AND Specialnost LIKE \'%'.$Date.'%\'');
                //$criteria->addCondition("Specialnost LIKE '%6.%'");
                //$criteria->addCondition("Specialnost LIKE '%".$Date."%'");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
        
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchSpecialists($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn,true);
		$criteria->compare('zaoch',$this->zaoch,true);
                $criteria->addCondition('Specialnost LIKE \'%7.%\' AND Specialnost LIKE \'%'.$Date.'%\'');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
        
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchMagisters($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn,true);
		$criteria->compare('zaoch',$this->zaoch,true);
                $criteria->addCondition('Specialnost LIKE \'%8.%\' AND Specialnost LIKE \'%'.$Date.'%\'');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
}