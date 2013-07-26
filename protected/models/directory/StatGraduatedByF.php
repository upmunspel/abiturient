<?php

/**
 * This is the model class for table "stat_graduated_by_f".
 *
 * The followings are the available columns in table 'stat_graduated_by_f':
 * @property string $Fakultet
 * @property string $cnt_our
 * @property string $cnt_ano
 */
class StatGraduatedByF extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StatGraduatedByF the static model class
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
		return 'stat_graduated_by_f';
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
			array('cnt', 'cnt_our, cnt_ano', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cnt, Fakultet, cnt_our, cnt_ano', 'safe', 'on'=>'search'),
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
    'cnt_our' => 'К-сть абітурієнтів випускників ЗНУ',
    'cnt_ano' => 'К-сть абітурієнтів випускників інших ВНЗ',
    'cnt' => 'К-сть випускників ЗНУ',
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

		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('cnt_our',$this->cnt_our,true);
		$criteria->compare('cnt_ano',$this->cnt_ano,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
}