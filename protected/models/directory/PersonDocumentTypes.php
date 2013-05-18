<?php

/**
 * This is the model class for table "persondocumenttypes".
 *
 * The followings are the available columns in table 'persondocumenttypes':
 * @property integer $idPersonDocumentTypes
 * @property string $PersonDocumentTypesName
 * @property integer $IsEntrantDocument
 */
class PersonDocumentTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonDocumentTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function DropDown($IsEntrantDocument = 0 ){
           $res = array();
           foreach(PersonDocumentTypes::model()->findAll("IsEntrantDocument = :IsEntrantDocument", array(":IsEntrantDocument"=>$IsEntrantDocument))as $record) {
                $res[$record->idPersonDocumentTypes] = $record->PersonDocumentTypesName;
           }
           return $res;
        }


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'persondocumenttypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPersonDocumentTypes', 'required'),
			array('idPersonDocumentTypes, IsEntrantDocument', 'numerical', 'integerOnly'=>true),
			array('PersonDocumentTypesName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPersonDocumentTypes, PersonDocumentTypesName, IsEntrantDocument', 'safe', 'on'=>'search'),
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
			'idPersonDocumentTypes' => 'Код типу документа особи',
			'PersonDocumentTypesName' => 'Назва типу документа особи',
			'IsEntrantDocument' => '/1/ документ вступу, /2/ док. посв. особу',
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

		$criteria->compare('idPersonDocumentTypes',$this->idPersonDocumentTypes);
		$criteria->compare('PersonDocumentTypesName',$this->PersonDocumentTypesName,true);
		$criteria->compare('IsEntrantDocument',$this->IsEntrantDocument);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
