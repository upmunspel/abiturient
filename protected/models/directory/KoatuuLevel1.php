<?php

/**
 * This is the model class for table "koatuulevel1".
 *
 * The followings are the available columns in table 'koatuulevel1':
 * @property integer $idKOATUULevel1
 * @property string $KOATUULevel1Code
 * @property string $KOATUULevel1FullName
 * @property string $KOATUULevel1Name
 */
class KoatuuLevel1 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return KoatuuLevel1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function DropDown(){
           $res = array();
           foreach(KoatuuLevel1::model()->findAll()as $record) {
                $res[$record->idKOATUULevel1] = $record->KOATUULevel1FullName;
           }
           return $res;
        }
        public static function getKoatuuLevelID($KOATUUCode){
             $val = substr($KOATUUCode,0,2)."00000000";
             $res = KoatuuLevel1::model()->find("KOATUULevel1Code = :KOATUULevel1Code", array(":KOATUULevel1Code"=>$val));
             if (!empty($res) ) return  $res->idKOATUULevel1;
             return 0;
        }
        
        public static function getKoatuuLevelCode($idKOATUULevel1){
             $res = KoatuuLevel1::model()->find("idKOATUULevel1 = :idKOATUULevel1", array(":idKOATUULevel1"=>$idKOATUULevel1));
             if (!empty($res) ) return  $res->KOATUULevel1Code;
             return "0000000000";
        }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'koatuulevel1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idKOATUULevel1', 'required'),
			array('idKOATUULevel1', 'numerical', 'integerOnly'=>true),
			array('KOATUULevel1Code', 'length', 'max'=>12),
			array('KOATUULevel1FullName, KOATUULevel1Name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idKOATUULevel1, KOATUULevel1Code, KOATUULevel1FullName, KOATUULevel1Name', 'safe', 'on'=>'search'),
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
			'idKOATUULevel1' => 'Id Koatuulevel1',
			'KOATUULevel1Code' => 'Koatuulevel1 Code',
			'KOATUULevel1FullName' => 'Koatuulevel1 Full Name',
			'KOATUULevel1Name' => 'Koatuulevel1 Name',
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

		$criteria->compare('idKOATUULevel1',$this->idKOATUULevel1);
		$criteria->compare('KOATUULevel1Code',$this->KOATUULevel1Code,true);
		$criteria->compare('KOATUULevel1FullName',$this->KOATUULevel1FullName,true);
		$criteria->compare('KOATUULevel1Name',$this->KOATUULevel1Name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}