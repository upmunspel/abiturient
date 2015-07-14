<?php

/**
 * This is the model class for table "statementpersons".
 *
 * The followings are the available columns in table 'statementpersons':
 * @property integer $PersonID
 * @property integer $StatementID
 * @property string $Subject1Val
 * @property string $Subject2Val
 * @property string $Subject3Val
 * @property string $Seria
 * @property string $Number
 */
class Statementpersons extends CActiveRecord {

    public function primaryKey() {
        return array('PersonID', 'StatementID');
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Statementpersons the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getFio() {

        return $this->person->LastName." ".$this->person->FirstName . " " . $this->person->MiddleName . " " ;
    }
    public function getHash() {

        return substr(md5($this->PersonID.$this->StatementID),0,5);
    }
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'statementpersons';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('PersonID, StatementID', 'required'),
            array('PersonID, StatementID', 'numerical', 'integerOnly' => true),
            array('Subject1Val, Subject2Val, Subject3Val', 'length', 'max' => 10),
            array('Seria, Number', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('PersonID, StatementID, Subject1Val, Subject2Val, Subject3Val, Seria, Number', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'person' => array(self::BELONGS_TO, 'Person', array('PersonID' => 'idPerson')),
            'statem' => array(self::BELONGS_TO, 'Statements', array('StatementID' => 'idStatement')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'PersonID' => 'Person',
            'StatementID' => 'Statement',
            'Subject1Val' => 'Бал з предмету 1',
            'Subject2Val' => 'Бал з предмету 2',
            'Subject3Val' => 'Бал з предмету 3',
            'Seria' => 'Seria',
            'Number' => 'Number',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

       /* $criteria = new CDbCriteria;
        $criteria->

        $criteria->compare('CDbCriteria', $this->PersonID);
        $criteria->compare('StatementID', $this->StatementID);
        

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));*/
    }

}
