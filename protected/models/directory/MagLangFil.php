<?php

/**
 * This is the model class for table "mag_languages_foreign_filology".
 *
 * The followings are the available columns in table 'mag_languages_foreign_filology':
 * @property string $FacultetFullName
 * @property string $spec
 * @property string $ForeignLang
 * @property string $surname
 * @property string $name
 * @property string $farthername
 * @property string $fah
 */
class MagLangFil extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MagLangFil the static model class
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
		return 'mag_languages_foreign_filology';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FacultetFullName', 'length', 'max'=>255),
			array('spec', 'length', 'max'=>315),
			array('ForeignLang', 'length', 'max'=>50),
			array('surname, name, farthername', 'length', 'max'=>100),
			array('fah', 'length', 'max'=>20),
                        array('eduform', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FacultetFullName, spec, ForeignLang, surname, name, farthername, fah, eduform', 'safe', 'on'=>'search'),
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
    'FacultetFullName' => 'Факультет',
    'spec' => 'Спеціальність',
    'ForeignLang' => 'Іноземна мова',
    'surname' => 'Прізвище',
    'name' => "Ім'я",
    'farthername' => 'По батькові',
    'fah' => 'Фаховий іспит',
    'eduform' => 'Форма'
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

		$criteria->compare('FacultetFullName',$this->FacultetFullName,true);
		$criteria->compare('spec',$this->spec,true);
		$criteria->compare('ForeignLang',$this->ForeignLang,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('farthername',$this->farthername,true);
		$criteria->compare('fah',$this->fah,true);
                $criteria->compare('eduform',$this->eduform,true);
		$criteria->order="spec,surname";
		foreach ($params as $key => $param){
			switch ($key){
				case 'eduform':
                                        $form = "денна";
                                        switch ($param){
                                            case 1: $form = "денна"; break;
                                            case 2: $form = "заочна"; break;
                                        }
					$criteria->addCondition("eduform LIKE '".$form."'");
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