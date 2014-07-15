<?php

/**
 * This is the model class for table "personspecialitybenefits".
 *
 * The followings are the available columns in table 'personspecialitybenefits':
 * @property integer $PersonSpecialityID
 * @property integer $PersonBenefitID
 */
class Personspecialitybenefits extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Personspecialitybenefits the static model class
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
    return 'personspecialitybenefits';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('PersonSpecialityID, PersonBenefitID', 'required'),
      array('PersonSpecialityID, PersonBenefitID', 'numerical', 'integerOnly'=>true),
      // The following rule is used by search().
      // Please remove those attributes that should not be searched.
      array('PersonSpecialityID, PersonBenefitID', 'safe', 'on'=>'search'),
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
      'psbenefit' => array(self::BELONGS_TO, 'Personbenefits', 'PersonBenefitID'),
    );
  }
        

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
    'PersonSpecialityID' => 'Person Speciality',
    'PersonBenefitID' => 'Person Benefit',
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

    $criteria->compare('PersonSpecialityID',$this->PersonSpecialityID);
    $criteria->compare('PersonBenefitID',$this->PersonBenefitID);

    return new CActiveDataProvider($this, array(
      'criteria'=>$criteria,
    ));
  }
}