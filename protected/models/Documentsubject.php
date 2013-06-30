<?php

/**
 * This is the model class for table "documentsubject".
 *
 * The followings are the available columns in table 'documentsubject':
 * @property integer $idDocumentSubject
 * @property integer $DocumentID
 * @property integer $SubjectID
 * @property double $SubjectValue
 * @property string $DateGet
 *
 * The followings are the available model relations:
 * @property Documents $document
 * @property Subjects $subject
 * @property Personsepciality[] $personsepcialities
 * @property Personsepciality[] $personsepcialities1
 * @property Personsepciality[] $personsepcialities2
 */
class Documentsubject extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documentsubject the static model class
	 */
        public $deleted = 0;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        protected function afterFind() {
//            $from=DateTime::createFromFormat('Y-m-d',$this->DateGet);
//            $this->DateGet=$from->format('d.m.Y');   
            parent::afterFind();
            return true;
            
        }
        

       
       
        protected function beforeSave() {
//            $this->DateGet=date('Y-m-d',  strtotime($this->DateGet));      
            return parent::beforeSave();
          
        }
        

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documentsubject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DateGet', 'safe'),
			array('DocumentID, SubjectID, deleted, idDocumentSubject', 'numerical', 'integerOnly'=>true),
			array('SubjectValue', 'numerical', 'max'=>200, 'min'=>100, 'integerOnly'=>false),
                        array('SubjectValue', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idDocumentSubject, DocumentID, SubjectID, SubjectValue, DateGet', 'safe', 'on'=>'search'),
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
			'document' => array(self::BELONGS_TO, 'Documents', 'DocumentID'),
			'subject' => array(self::BELONGS_TO, 'Subjects', 'SubjectID'),
			'personsepcialities' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject2'),
			'personsepcialities1' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject3'),
			'personsepcialities2' => array(self::HAS_MANY, 'Personsepciality', 'DocumentSubject1'),
		);
	}
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
    'idDocumentSubject' => 'Id Document Subject',
    'DocumentID' => 'Document',
    'SubjectID' => 'Предмет',
    'SubjectValue' => 'Бал',
    'DateGet' => 'Дата складання',
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

		$criteria->compare('idDocumentSubject',$this->idDocumentSubject);
		$criteria->compare('DocumentID',$this->DocumentID);
		$criteria->compare('SubjectID',$this->SubjectID);
		$criteria->compare('SubjectValue',$this->SubjectValue);
		$criteria->compare('DateGet',$this->DateGet,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}