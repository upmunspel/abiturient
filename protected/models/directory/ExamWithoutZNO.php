<?php

/**
 * This is the model class for table "examinations_without_zno".
 *
 * The followings are the available columns in table 'examinations_without_zno':
 * @property integer $idPersonMySql
 * @property integer $idPersonEdbo
 * @property string $FIO
 * @property string $Speciality
 * @property string $Examination1
 * @property string $Examination2
 * @property string $Examination3
 * @property string $educationFormName
 * @property integer $idEducationForm
 */
class ExamWithoutZNO extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamWithoutZNO the static model class
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
		return 'examinations_without_zno';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonMySql, idPersonEdbo, idEducationForm', 'numerical', 'integerOnly'=>true),
			array('FIO', 'length', 'max'=>302),
			array('Speciality', 'length', 'max'=>316),
			array('Examination1, Examination2, Examination3', 'length', 'max'=>50),
			array('educationFormName', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonMySql, idPersonEdbo, FIO, Speciality, Examination1, Examination2, Examination3, educationFormName, idEducationForm', 'safe', 'on'=>'search'),
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
    'idPersonMySql' => 'ID',
    'idPersonEdbo' => 'EDBO-ID',
    'FIO' => 'ПІБ',
    'Speciality' => 'Спеціальність',
    'Examination1' => 'Екзамен №1',
    'Examination2' => 'Екзамен №2',
    'Examination3' => 'Екзамен №3',
    'educationFormName' => 'Форма',
    'idEducationForm' => 'IdEduForm',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($params)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idPersonMySql',$this->idPersonMySql);
		$criteria->compare('idPersonEdbo',$this->idPersonEdbo);
		$criteria->compare('FIO',$this->FIO,true);
		$criteria->compare('Speciality',$this->Speciality,true);
		$criteria->compare('Examination1',$this->Examination1,true);
		$criteria->compare('Examination2',$this->Examination2,true);
		$criteria->compare('Examination3',$this->Examination3,true);
		$criteria->compare('educationFormName',$this->educationFormName,true);
		$criteria->compare('idEducationForm',$this->idEducationForm);
                foreach ($params as $key => $param){
                    switch ($key){
                        case 'form':
                            $criteria->addCondition("idEducationForm = ".$param);
                    }
                }
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize' => 10000
                        )
		));
	}
}