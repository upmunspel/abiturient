<?php

/**
 * This is the model class for table "personspec_all".
 *
 * The followings are the available columns in table 'personspec_all':
 * @property string $FIO
 * @property string $FacultetFullName
 * @property string $QualificationName
 * @property string $Specialnost
 * @property string $Forma
 * @property integer $isContract
 * @property integer $isBudget
 * @property integer $isCopyEntrantDoc
 * @property integer $RequestFromEB
 * @property string $Pilga
 * @property integer $PozaKonkursom
 * @property integer $Pozacherg
 * @property string $Date
 * @property integer $edboID
 * @property string $Nomer_lichnogo_dela
 * @property integer $N_dela
 * @property integer $StatusID
 */
class PersonspecAll extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonspecAll the static model class
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
		return 'personspec_all';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isBudget, RequestFromEB, N_dela', 'required'),
			array('isContract, isBudget, isCopyEntrantDoc, 
                            RequestFromEB, PozaKonkursom, Pozacherg, edboID, N_dela, StatusID', 'numerical', 'integerOnly'=>true),
			array('FIO', 'length', 'max'=>302),
			array('FacultetFullName', 'length', 'max'=>255),
			array('QualificationName, Forma', 'length', 'max'=>45),
			array('Specialnost', 'length', 'max'=>216),
			array('Pilga', 'length', 'max'=>250),
			array('Date', 'length', 'max'=>10),
			array('Nomer_lichnogo_dela', 'length', 'max'=>29),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FIO, FacultetFullName, QualificationName, Specialnost, 
                            Forma, isContract, isBudget, isCopyEntrantDoc, 
                            RequestFromEB, Pilga, PozaKonkursom, Pozacherg, 
                            Date, edboID, Nomer_lichnogo_dela, N_dela, 
                            StatusID', 'safe', 'on'=>'search'),
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
    'FIO' => 'ФІО',
    'FacultetFullName' => 'Факультет',
    'QualificationName' => 'ОКР',
    'Specialnost' => 'Спеціальність',
    'Forma' => 'Форма',
    'isContract' => 'Заявка на контракт',
    'isBudget' => 'Заявка на бюджет',
    'isCopyEntrantDoc' => 'Копія',
    'RequestFromEB' => 'Електронна заявка',
    'Pilga' => 'Пільга',
    'PozaKonkursom' => 'Позаконкурсний вступ',
    'Pozacherg' => 'Першочерговий вступ',
    'Date' => 'Дата подання заявки',
    'edboID' => 'Код ЄДЕБО',
    'Nomer_lichnogo_dela' => 'Номер особової справи',
    'N_dela' => 'Номер справи',
    'StatusID' => 'Статус заявки',
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

		$criteria->compare('FIO',$this->FIO,true);
		$criteria->compare('FacultetFullName',$this->FacultetFullName,true);
		$criteria->compare('QualificationName',$this->QualificationName,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('Forma',$this->Forma,true);
		$criteria->compare('isContract',$this->isContract);
		$criteria->compare('isBudget',$this->isBudget);
		$criteria->compare('isCopyEntrantDoc',$this->isCopyEntrantDoc);
		$criteria->compare('RequestFromEB',$this->RequestFromEB);
		$criteria->compare('Pilga',$this->Pilga,true);
		$criteria->compare('PozaKonkursom',$this->PozaKonkursom);
		$criteria->compare('Pozacherg',$this->Pozacherg);
		$criteria->compare('Date',$this->Date,true);
		$criteria->compare('edboID',$this->edboID);
		$criteria->compare('Nomer_lichnogo_dela',$this->Nomer_lichnogo_dela,true);
		$criteria->compare('N_dela',$this->N_dela);
		$criteria->compare('StatusID',$this->StatusID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>1000,
                        ),
		));
	}
}