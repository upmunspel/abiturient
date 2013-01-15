<?php

/**
 * This is the model class for table "koatuulevel2".
 *
 * The followings are the available columns in table 'koatuulevel2':
 * @property integer $idKOATUULevel2
 * @property string $KOATUULevel2Code
 * @property string $KOATUULevel2FullName
 * @property string $KOATUULevel2Name
 * @property string $KOATUULevel2Type
 * @property integer $KOATUULevel1ID
 */
class KoatuuLevel2 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return KoatuuLevel2 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function DropDown($KOATUULevel1ID = 0){
           $res = array();
           foreach(KoatuuLevel2::model()->findAll("KOATUULevel1ID = :KOATUULevel1ID", array(":KOATUULevel1ID"=>$KOATUULevel1ID))as $record) {
                $res[$record->idKOATUULevel2] = $record->KOATUULevel2Name;
           }
           return $res;
        }
  
        public static function getKoatuuLevelID($KOATUUCode){
             $val = substr($KOATUUCode,0,5)."00000";
             $res = KoatuuLevel2::model()->find("KOATUULevel2Code = :KOATUULevel2Code", array(":KOATUULevel2Code"=>$val));
             if (!empty($res) ) return  $res->idKOATUULevel2;
             return 0;
        }
        
        public static function getKoatuuLevel2Code($idKOATUULevel2){
            //echo "<br>strart";
             $res = KoatuuLevel2::model()->find("idKOATUULevel2 = :idKOATUULevel2", array(":idKOATUULevel2"=>$idKOATUULevel2));
             //var_dump($res);
             if (!empty($res) ) return  $res->KOATUULevel2Code;
             return "0000000000";
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'koatuulevel2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idKOATUULevel2', 'required'),
			array('idKOATUULevel2, KOATUULevel1ID', 'numerical', 'integerOnly'=>true),
			array('KOATUULevel2Code', 'length', 'max'=>12),
			array('KOATUULevel2FullName, KOATUULevel2Name', 'length', 'max'=>75),
			array('KOATUULevel2Type', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idKOATUULevel2, KOATUULevel2Code, KOATUULevel2FullName, KOATUULevel2Name, KOATUULevel2Type, KOATUULevel1ID', 'safe', 'on'=>'search'),
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
			'idKOATUULevel2' => 'Id Koatuulevel2',
			'KOATUULevel2Code' => 'Koatuulevel2 Code',
			'KOATUULevel2FullName' => 'Koatuulevel2 Full Name',
			'KOATUULevel2Name' => 'Koatuulevel2 Name',
			'KOATUULevel2Type' => 'Koatuulevel2 Type',
			'KOATUULevel1ID' => 'Koatuulevel1',
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

		$criteria->compare('idKOATUULevel2',$this->idKOATUULevel2);
		$criteria->compare('KOATUULevel2Code',$this->KOATUULevel2Code,true);
		$criteria->compare('KOATUULevel2FullName',$this->KOATUULevel2FullName,true);
		$criteria->compare('KOATUULevel2Name',$this->KOATUULevel2Name,true);
		$criteria->compare('KOATUULevel2Type',$this->KOATUULevel2Type,true);
		$criteria->compare('KOATUULevel1ID',$this->KOATUULevel1ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}