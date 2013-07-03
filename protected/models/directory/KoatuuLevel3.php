<?php

/**
 * This is the model class for table "koatuulevel3".
 *
 * The followings are the available columns in table 'koatuulevel3':
 * @property integer $idKOATUULevel3
 * @property string $KOATUULevel3Code
 * @property string $KOATUULevel3FullName
 * @property string $KOATUULevel3Name
 * @property string $KOATUULevel3Type
 * @property integer $KOATUULevel2ID
 */
class KoatuuLevel3 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return KoatuuLevel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
       public static function DropDown($KOATUULevel2ID = 0){
           $res = array("");
           $l2 = KoatuuLevel2::model()->findByPk($KOATUULevel2ID);
           //debug($l2->KOATUULevel2Type);
           //if (!empty($l2) && $l2->KOATUULevel2Type !="М"){
                foreach(KoatuuLevel3::model()->findAll("KOATUULevel2ID = :KOATUULevel2ID", array(":KOATUULevel2ID"=>$KOATUULevel2ID))as $record) {
                      $res[$record->idKOATUULevel3] = $record->KOATUULevel3Name;
                }
           //}
           return $res;
        }
        public static function getKoatuuLevelID($KOATUUCode){
            
             $res = KoatuuLevel3::model()->find("KOATUULevel3Code = :KOATUULevel3Code and KOATUULevel3Type <> :KOATUULevel3Type", array(":KOATUULevel3Code"=>$KOATUUCode, ":KOATUULevel3Type"=>"Р"));
             if (!empty($res) ) return  $res->idKOATUULevel3;
             return 0;
             
        }
        public static function getKoatuuLevelCode($idKOATUULevel3){
             $res = KoatuuLevel3::model()->find("idKOATUULevel3 = :idKOATUULevel3", array(":idKOATUULevel3"=>$idKOATUULevel3));
             if (!empty($res) ) return  $res->KOATUULevel3Code;
             return "0000000000";
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'koatuulevel3';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idKOATUULevel3', 'required'),
			array('idKOATUULevel3, KOATUULevel2ID', 'numerical', 'integerOnly'=>true),
			array('KOATUULevel3Code', 'length', 'max'=>10),
			array('KOATUULevel3FullName', 'length', 'max'=>150),
			array('KOATUULevel3Name', 'length', 'max'=>50),
			array('KOATUULevel3Type', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idKOATUULevel3, KOATUULevel3Code, KOATUULevel3FullName, KOATUULevel3Name, KOATUULevel3Type, KOATUULevel2ID', 'safe', 'on'=>'search'),
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
			'idKOATUULevel3' => 'Id Koatuulevel3',
			'KOATUULevel3Code' => 'Koatuulevel3 Code',
			'KOATUULevel3FullName' => 'Koatuulevel3 Full Name',
			'KOATUULevel3Name' => 'Koatuulevel3 Name',
			'KOATUULevel3Type' => 'Koatuulevel3 Type',
			'KOATUULevel2ID' => 'Koatuulevel2',
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

		$criteria->compare('idKOATUULevel3',$this->idKOATUULevel3);
		$criteria->compare('KOATUULevel3Code',$this->KOATUULevel3Code,true);
		$criteria->compare('KOATUULevel3FullName',$this->KOATUULevel3FullName,true);
		$criteria->compare('KOATUULevel3Name',$this->KOATUULevel3Name,true);
		$criteria->compare('KOATUULevel3Type',$this->KOATUULevel3Type,true);
		$criteria->compare('KOATUULevel2ID',$this->KOATUULevel2ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}