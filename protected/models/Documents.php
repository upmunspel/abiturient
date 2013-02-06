<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property integer $idDocuments
 * @property integer $PersonID
 * @property integer $TypeID
 * @property string $Series
 * @property string $Numbers
 * @property string $DateGet
 * @property integer $ZNOPin
 * @property string $AtestatValue
 * @property string $Issued
 * @property integer $isCopy
 */
class Documents extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getTypeGroup(){
            $rerult = PersonDocumentTypes::model()->findByPk($this->TypeID);
            return $rerult->IsEntrantDocument;
        }
        protected function afterFind() {
            $from=DateTime::createFromFormat('Y-m-d',$this->DateGet);
            $this->DateGet=$from->format('d.m.Y');   
            parent::afterFind();
            return true;
            
        }
        protected function beforeSave() {
         
            $this->DateGet=date('Y-m-d',  strtotime($this->DateGet));      
            
      
            parent::beforeSave();
            return true;
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PersonID, TypeID, ZNOPin, isCopy', 'numerical', 'integerOnly'=>true),
			array('Series, AtestatValue', 'length', 'max'=>10),
			array('Numbers', 'length', 'max'=>15),
			array('Issued', 'length', 'max'=>250),
			array('DateGet,idDocuments', 'safe'),
                        array('Series, Numbers, DateGet', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idDocuments, PersonID, TypeID, Series, Numbers, DateGet, ZNOPin, AtestatValue, Issued, isCopy', 'safe', 'on'=>'search'),
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
			'idDocuments' => 'Id Documents',
			'PersonID' => 'Person',
			'TypeID' => 'Тип документу',
			'Series' => 'Серія ',
			'Numbers' => 'Номер',
			'DateGet' => 'Дата видачі',
			'ZNOPin' => 'ЗНО Пин',
			'AtestatValue' => 'Серадній бал',
			'Issued' => 'Ким виданий',
			'isCopy' => 'Копія',
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

		$criteria->compare('idDocuments',$this->idDocuments);
		$criteria->compare('PersonID',$this->PersonID);
		$criteria->compare('TypeID',$this->TypeID);
		$criteria->compare('Series',$this->Series,true);
		$criteria->compare('Numbers',$this->Numbers,true);
		$criteria->compare('DateGet',$this->DateGet,true);
		$criteria->compare('ZNOPin',$this->ZNOPin);
		$criteria->compare('AtestatValue',$this->AtestatValue,true);
		$criteria->compare('Issued',$this->Issued,true);
		$criteria->compare('isCopy',$this->isCopy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}