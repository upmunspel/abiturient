<?php

/**
 * This is the model class for table "sys_report".
 *
 * The followings are the available columns in table 'sys_report':
 * @property integer $id
 * @property string $compar_type
 * @property string $name
 * @property string $db_rels
 * @property string $db_attrname
 * @property string $db_alterattr
 * @property string $db_attr
 * @property integer $db_group_concat
 * @property string $view_value
 */
class SysReport extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return SysReport the static model class
   */
  public static function model($className=__CLASS__){
    return parent::model($className);
  }
  
  /**
   * @return string the associated database table name
   */
  public function tableName(){
    return 'sys_report';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('name, db_attrname, view_value', 'required'),
      array('db_group_concat', 'numerical', 'integerOnly'=>true),
      array('compar_type', 'length', 'max'=>12),
      array('name, db_attrname, db_alterattr', 'length', 'max'=>128),
      array('db_rels, db_attr', 'safe'),
      // The following rule is used by search().
      // Please remove those attributes that should not be searched.
      array('id, compar_type, name, db_rels, db_attrname, db_alterattr, db_attr, db_group_concat, view_value', 'safe', 'on'=>'search'),
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
    'id' => 'ID',
    'compar_type' => 'Тип умови',
    'name' => 'Назва (заголовок)',
    'db_rels' => 'Відношення в БД',
    'db_attrname' => 'Атрибут в БД',
    'db_alterattr' => 'Атрибут-2 в БД',
    'db_attr' => 'Значення атрибуту або SQL',
    'db_group_concat' => 'Груп. конкатенація',
    'view_value' => 'Представлення (PHP-expr)',
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search(){
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria=new CDbCriteria;

    $criteria->compare('id',$this->id);
    $criteria->compare('compar_type',$this->compar_type,true);
    $criteria->compare('name',$this->name,true);
    $criteria->compare('db_rels',$this->db_rels,true);
    $criteria->compare('db_attrname',$this->db_attrname,true);
    $criteria->compare('db_alterattr',$this->db_alterattr,true);
    $criteria->compare('db_attr',$this->db_attr,true);
    $criteria->compare('db_group_concat',$this->db_group_concat);
    $criteria->compare('view_value',$this->view_value,true);

    return new CActiveDataProvider($this, array(
      'criteria'=>$criteria,
    ));
  }
}