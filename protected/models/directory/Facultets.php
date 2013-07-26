<?php

/**
 * This is the model class for table "facultets".
 *
 * The followings are the available columns in table 'facultets':
 * @property integer $idFacultet
 * @property string $FacultetFullName
 * @property string $FacultetShortName
 * @property string $FacultetKode
 * @property string $FacultetTypeName
 *
 * The followings are the available model relations:
 * @property Specialities[] $specialities
 */
class Facultets extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Facultets the static model class
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
		return 'facultets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idFacultet', 'safe'),
			array('idFacultet', 'numerical', 'integerOnly'=>true),
			array('FacultetFullName', 'length', 'max'=>255),
			array('FacultetShortName, FacultetTypeName', 'length', 'max'=>45),
			array('FacultetKode', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idFacultet, FacultetFullName, FacultetShortName, FacultetKode, FacultetTypeName', 'safe', 'on'=>'search'),
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
			'specialities' => array(self::HAS_MANY, 'Specialities', 'FacultetID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'idFacultet' => 'Код',
                    'FacultetFullName' => 'Повна назва',
                    'FacultetShortName' => 'Скорочена назва',
                    'FacultetKode' => 'UCODE',
                    'FacultetTypeName' => 'Тип',
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

		$criteria->compare('idFacultet',$this->idFacultet);
		$criteria->compare('FacultetFullName',$this->FacultetFullName,true);
		$criteria->compare('FacultetShortName',$this->FacultetShortName,true);
		$criteria->compare('FacultetKode',$this->FacultetKode,true);
		$criteria->compare('FacultetTypeName',$this->FacultetTypeName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>10000,
                         ),
		));
	}
}
