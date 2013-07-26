<?php

/**
 * This is the model class for table "stat_graduated".
 *
 * The followings are the available columns in table 'stat_graduated':
 * @property string $F
 * @property string $S
 * @property string $zajavi_ot_nas
 * @property string $ludi_ot_nas
 * @property string $zajavi_ne_ot_nas
 * @property string $ludi_ne_ot_nas
 */
class StatGraduated extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StatGraduated the static model class
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
		return 'stat_graduated';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('F', 'length', 'max'=>255),
			array('S', 'length', 'max'=>216),
			array('zajavi_ot_nas, ludi_ot_nas, zajavi_ne_ot_nas, ludi_ne_ot_nas', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('F, S, zajavi_ot_nas, ludi_ot_nas, zajavi_ne_ot_nas, ludi_ne_ot_nas', 'safe', 'on'=>'search'),
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
    'F' => 'Факультет',
    'S' => 'Спеціальність',
    'zajavi_ot_nas' => 'К-сть заяв від випускників ЗНУ',
    'ludi_ot_nas' => 'К-сть абітурієнтів випускників ЗНУ',
    'zajavi_ne_ot_nas' => 'К-сть заяв випускників інших ВНЗ',
    'ludi_ne_ot_nas' => 'К-сть абітурієнтів випускників інших ВНЗ',
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

		$criteria->compare('F',$this->F,true);
		$criteria->compare('S',$this->S,true);
		$criteria->compare('zajavi_ot_nas',$this->zajavi_ot_nas,true);
		$criteria->compare('ludi_ot_nas',$this->ludi_ot_nas,true);
		$criteria->compare('zajavi_ne_ot_nas',$this->zajavi_ne_ot_nas,true);
		$criteria->compare('ludi_ne_ot_nas',$this->ludi_ne_ot_nas,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
}