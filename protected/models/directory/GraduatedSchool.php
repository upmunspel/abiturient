<?php

/**
 * This is the model class for table "graduated_school".
 *
 * The followings are the available columns in table 'graduated_school':
 * @property integer $ID_person
 * @property string $PIB
 * @property string $doc_type
 * @property string $Issued
 * @property string $IssuedYear
 * @property string $edu_type
 */
class GraduatedSchool extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GraduatedSchool the static model class
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
		return 'graduated_school';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_person', 'numerical', 'integerOnly'=>true),
			array('PIB', 'length', 'max'=>302),
			array('doc_type', 'length', 'max'=>100),
			array('Issued', 'length', 'max'=>250),
			array('IssuedYear', 'length', 'max'=>4),
			array('edu_type', 'length', 'max'=>37),
                        array('spec', 'length', 'max'=>200),
                        array('edu_form', 'length', 'max'=>37),
                        array('status', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_person, PIB, doc_type, Issued, IssuedYear, edu_type, spec, edu_form, status', 'safe', 'on'=>'search'),
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
    'ID_person' => 'ID абітурієнта',
    'PIB' => 'ПІБ',
    'doc_type' => 'Тип документу про освіту',
    'Issued' => 'Ким виданий документ про освіту',
    'IssuedYear' => 'Коли виданий документ про освіту',
    'edu_type' => 'Тип закладу',
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

		$criteria->compare('ID_person',$this->ID_person);
		$criteria->compare('PIB',$this->PIB,true);
		$criteria->compare('doc_type',$this->doc_type,true);
		$criteria->compare('Issued',$this->Issued,true);
		$criteria->compare('IssuedYear',$this->IssuedYear,true);
		$criteria->compare('edu_type',$this->edu_type,true);
                $criteria->compare('spec',$this->spec,true);
                $criteria->compare('edu_form',$this->edu_form,true);
                $criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>800,
                        )
		));
	}
}