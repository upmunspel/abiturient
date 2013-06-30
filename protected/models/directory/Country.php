<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $idCountry
 * @property string $CountryName
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
	 */
         
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function DropDown(){
           $res = array();
           foreach(Country::model()->findAll("visible = :visible", array(":visible"=>1))as $record) {
                
                $res[$record->idCountry] = $record->CountryName;
           }
           return $res;
        }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('CountryName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CountryID, CountryName', 'safe', 'on'=>'search'),
		);*/
            	return array(
			array('CountryName, Visible, idCountry', 'required'),
			array('Visible', 'numerical', 'integerOnly'=>true),
			array('CountryName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idCountry, CountryName, Visible', 'safe', 'on'=>'search'),
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
		/*return array(
			'CountryID' => 'Country',
			'CountryName' => 'Country Name',
		);*/
            return array(
            'idCountry' => 'Код країни',
            'CountryName' => 'Назва країни',
            'Visible' => 'Відображати при виборі',
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

		/*$criteria=new CDbCriteria;

		$criteria->compare('CountryID',$this->CountryID);
		$criteria->compare('CountryName',$this->CountryName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
            	$criteria=new CDbCriteria;

		$criteria->compare('idCountry',$this->idCountry);
		$criteria->compare('CountryName',$this->CountryName,true);
		$criteria->compare('Visible',$this->Visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}