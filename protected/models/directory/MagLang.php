<?php

/**
 * This is the model class for table "mag_languages".
 *
 * The followings are the available columns in table 'mag_languages':
 * @property integer $idFuc
 * @property string $spec
 * @property string $surname
 * @property string $name
 * @property string $farthername
 * @property string $langName
 */
class MagLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MagLang the static model class
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
		return 'mag_languages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idFuc', 'numerical', 'integerOnly'=>true),
			array('spec', 'length', 'max'=>315),
			array('surname, name, farthername', 'length', 'max'=>100),
			array('langName', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idFuc, spec, surname, name, farthername, langName', 'safe', 'on'=>'search'),
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
    'idFuc' => 'ID',
    'spec' => 'Спеціальність',
    'surname' => 'Прізвище',
    'name' => "Ім'я",
    'farthername' => 'По батькові',
    'langName' => 'Іноземна мова',
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

		$criteria->compare('idFuc',$this->idFuc);
		$criteria->compare('spec',$this->spec,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('farthername',$this->farthername,true);
		$criteria->compare('langName',$this->langName,true);
		$criteria->order="spec,surname";
                //$criteria->distinct = true;
		foreach ($params as $key => $param){
			switch ($key){
				case 'FacultetID':
					$criteria->addCondition("idFuc = ".$param);
					break;
			}
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>100000,
                        )
		));
	}
}