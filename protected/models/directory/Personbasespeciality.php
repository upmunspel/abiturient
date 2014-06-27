<?php

/**
 * This is the model class for table "personbasespeciality".
 *
 * The followings are the available columns in table 'personbasespeciality':
 * @property integer $idPersonBaseSpeciality
 * @property string $PersonBaseSpecialityName
 * @property string $PersonBaseSpecialityClasifierCode
 */
class Personbasespeciality extends CActiveRecord {

    public $speciality = array();

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Personbasespeciality the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function DropDown() {
        $res = array();
        foreach (Personbasespeciality::model()->findAll() as $record) {

            $res[$record->idPersonBaseSpeciality] = "({$record->PersonBaseSpecialityClasifierCode}) {$record->PersonBaseSpecialityName}";
        }
        return $res;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'personbasespeciality';
    }

    public function afterFind() {
        // Формируем массив 
        $this->speciality = array();
        $psb = BasespecialityRelation::model()->findAll("`PersonBaseSpecialityID` = {$this->idPersonBaseSpeciality}");
        foreach ($psb as $item) {

            $this->speciality[] = $item->SpecialityID;
        }
        return parent::afterFind();
    }

    public function afterSave() {

        $res = BasespecialityRelation::model()->deleteAll("PersonBaseSpecialityID = {$this->idPersonBaseSpeciality}");
       
        if (!empty($this->speciality) && is_array($this->speciality)) {
            foreach ($this->speciality as $val) {
                $item = new BasespecialityRelation();
                $item->SpecialityID = $val;
                $item->PersonBaseSpecialityID = $this->idPersonBaseSpeciality;
                $item->save();
            }
        }
//   
        return parent::afterSave();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('PersonBaseSpecialityName', 'length', 'max' => 150),
            array('PersonBaseSpecialityClasifierCode', 'length', 'max' => 15),
            array('speciality', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('idPersonBaseSpeciality, PersonBaseSpecialityName, PersonBaseSpecialityClasifierCode, Speciality', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idPersonBaseSpeciality' => 'Код',
            'PersonBaseSpecialityName' => 'Назва',
            'PersonBaseSpecialityClasifierCode' => 'Шифр',
            'speciality' => "Пов'язані спеціальності",
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idPersonBaseSpeciality', $this->idPersonBaseSpeciality);
        $criteria->compare('PersonBaseSpecialityName', $this->PersonBaseSpecialityName, true);
        $criteria->compare('PersonBaseSpecialityClasifierCode', $this->PersonBaseSpecialityClasifierCode, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
