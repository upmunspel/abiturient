<?php

/**
 * This is the model class for table "olympiadsawards".
 *
 * The followings are the available columns in table 'olympiadsawards':
 * @property integer $idOlimpiad
 * @property string $OlimpiadName
 * @property integer $OlympiadAwardID
 * @property string $OlympiadAwardName
 * @property double $OlympiadAwardBonus
 */
class Olympiadsawards extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Olympiadsawards the static model class
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
		return 'olympiadsawards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idOlimpiad, OlimpiadName, OlympiadAwardID, OlympiadAwardName, OlympiadAwardBonus', 'required'),
			array('idOlimpiad, OlympiadAwardID', 'numerical', 'integerOnly'=>true),
			array('OlympiadAwardBonus', 'numerical'),
			array('OlimpiadName, OlympiadAwardName', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idOlimpiad, OlimpiadName, OlympiadAwardID, OlympiadAwardName, OlympiadAwardBonus', 'safe', 'on'=>'search'),
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
        public static function DropDown(){
            $model = Olympiadsawards::model()->findAll();
            $res = array();
            foreach ($model as $obj) {
                $res[$obj->OlympiadAwardID] = $obj->OlympiadAwardName."(".$obj->OlympiadAwardBonus.")";
            }
            return $res;
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idOlimpiad' => 'Id Olimpiad',
    'OlimpiadName' => 'Olimpiad Name',
    'OlympiadAwardID' => 'Olympiad Award',
    'OlympiadAwardName' => 'Olympiad Award Name',
    'OlympiadAwardBonus' => 'Olympiad Award Bonus',
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

		$criteria->compare('idOlimpiad',$this->idOlimpiad);
		$criteria->compare('OlimpiadName',$this->OlimpiadName,true);
		$criteria->compare('OlympiadAwardID',$this->OlympiadAwardID);
		$criteria->compare('OlympiadAwardName',$this->OlympiadAwardName,true);
		$criteria->compare('OlympiadAwardBonus',$this->OlympiadAwardBonus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}