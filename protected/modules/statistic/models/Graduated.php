<?php

/**
 * This is the model class for table "edbo_data".
 *
 * The followings are the available columns in table 'edbo_data':
 * @property integer $idGraduated
 * @property string $Speciality
 * @property integer $Year
 * @property string $Number
 * 
 * @property Specialities $spec
 */
class Graduated extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return EdboData the static model class
   */
  
  public static function model($className=__CLASS__){
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName(){
    return 'graduated';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules(){
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('Speciality, Year, Number', 'required'),
      array('idGraduated, Year, Number', 'numerical', 'integerOnly'=>true),
      array('Speciality', 'length', 'max'=>192),
      // The following rule is used by search().
      // Please remove those attributes that should not be searched.
      array('idGraduated, Speciality, Year, Number', 'safe', 'on'=>'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations(){
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(

    );
  }
        

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels(){
    return array(
        'idGraduated' => 'ID',
        'Speciality' => 'Спеціальність',
        'Year' => 'Рік',
        'Number' => 'Кількість',
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

    $criteria->compare('idGraduated',$this->idGraduated);
    $criteria->compare('Speciality',$this->Speciality);
    $criteria->compare('Year',$this->Year);
    $criteria->compare('Number',$this->Number);

    return new CActiveDataProvider($this, array(
      'criteria'=>$criteria,
    ));
  }
}