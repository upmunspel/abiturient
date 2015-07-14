<?php

/**
 * This is the model class for table "specialityquotes".
 *
 * The followings are the available columns in table 'specialityquotes':
 * @property integer $idSpecialityQuotes
 * @property integer $QuotaID
 * @property integer $SpecialityID
 * @property integer $BudgetPlaces
 * @property Specialities $spec
 * @property Quota $quota
 */
class Specialityquotes extends CActiveRecord{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Specialityquotes the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'specialityquotes';
	}
  
	/**
	 * @return array Primary key of the table
	 */
  public function primaryKey(){
    return array('QuotaID', 'SpecialityID');
  }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('QuotaID, SpecialityID, BudgetPlaces', 'required'),
			array('idSpecialityQuotes, QuotaID, SpecialityID, BudgetPlaces', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idSpecialityQuotes, QuotaID, SpecialityID, BudgetPlaces', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
      'spec' => array(self::BELONGS_TO, 'Specialities', 'SpecialityID'),
      'quota' => array(self::BELONGS_TO, 'Quota', 'QuotaID'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
    'idSpecialityQuotes' => 'ID',
    'QuotaID' => 'Назва квоти',
    'SpecialityID' => 'Напрям/Спеціалізація',
    'BudgetPlaces' => 'Кількість',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
    $spec_sql = "concat_ws(' ',"
      . "spec.SpecialityClasifierCode,"
      . "(case substr(spec.SpecialityClasifierCode,1,1) when '6' then "
      . "spec.SpecialityDirectionName else spec.SpecialityName end),"
      . "(case spec.SpecialitySpecializationName when '' then '' "
      . " else concat('(',spec.SpecialitySpecializationName,')') end)"
      . ",concat('(',MID(eduform.PersonEducationFormName,1,1),')'))";
		$criteria=new CDbCriteria;
    $criteria->with = array('spec' , 'quota' , 'spec.eduform');
    
		$criteria->compare('idSpecialityQuotes',$this->idSpecialityQuotes);
		$criteria->compare('quota.QuotaName',$this->QuotaID,true);
		$criteria->compare($spec_sql,$this->SpecialityID,true);
		$criteria->compare('BudgetPlaces',$this->BudgetPlaces);
    $criteria->together = true;
    $criteria->group = 'idSpecialityQuotes';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
      'sort' => array(
        'defaultOrder' => array(
            'idSpecialityQuotes' => CSort::SORT_DESC,
        ),
        'attributes' => array(
          'idSpecialityQuotes' => array(
            'asc' => 'idSpecialityQuotes ASC',
            'desc' => 'idSpecialityQuotes DESC',
          ),
          'SpecialityID' => array(
            'asc' => 'spec.SpecialityName ASC,spec.SpecialityDirectionName ASC,spec.SpecialityClasifierCode ASC, '
             . 'eduform.PersonEducationFormName ASC',
            'desc' => 'spec.SpecialityName DESC,spec.SpecialityDirectionName DESC,spec.SpecialityClasifierCode DESC, '
             . 'eduform.PersonEducationFormName DESC',
          ),
          'QuotaID' => array(
            'asc' => 'quota.QuotaName ASC',
            'desc' => 'quota.QuotaName DESC',
          ),
          'BudgetPlaces' => array(
            'asc' => 'BudgetPlaces ASC',
            'desc' => 'BudgetPlaces DESC',
          ),
        ),
      )
		));
	}
}