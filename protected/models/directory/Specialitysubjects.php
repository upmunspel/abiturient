<?php

/**
 * This is the model class for table "specialitysubjects".
 *
 * The followings are the available columns in table 'specialitysubjects':
 * @property integer $id
 * @property integer $SpecialityID
 * @property integer $SubjectID
 * @property integer $LevelID
 *
 * The followings are the available model relations:
 * @property Specialities $speciality
 * @property Subjects $subject
 * @property Znolevels $level
 */
class Specialitysubjects extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Specialitysubjects the static model class
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
		return 'specialitysubjects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SpecialityID, LevelID, isProfile', 'numerical', 'integerOnly'=>true),
                        array('SpecialityID, LevelID, SubjectID, isProfile', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, SpecialityID, SubjectID, LevelID, isProfile', 'safe', 'on'=>'search'),
                        //array('SubjectID','type','type'=>'array','allowEmpty'=>false)
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
			'speciality' => array(self::BELONGS_TO, 'Specialities', 'SpecialityID'),
			'subject' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
			'level' => array(self::BELONGS_TO, 'Znolevels', 'LevelID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'id' => 'ID',
    'SpecialityID' => 'спеціальність',
    'SubjectID' => 'предмет',
    'LevelID' => 'Рівень (№ предмета)',
    'isProfile' => 'Чи є профільним'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('SpecialityID',$this->SpecialityID);
		$criteria->compare('SubjectID',$this->SubjectID);
		$criteria->compare('LevelID',$this->LevelID);
                $criteria->compare('isProfile',$this->isProfile);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}