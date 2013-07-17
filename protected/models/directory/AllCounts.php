<?php

/**
 * This is the model class for table "all_counts".
 *
 * The followings are the available columns in table 'all_counts':
 * @property integer $ID
 * @property string $Fakultet
 * @property string $Specialnost
 * @property string $dnevn
 * @property string $dnevn_budget
 * @property string $dnevn_contract
 * @property string $dnevn_pv
 * @property string $dnevn_pzk
 * @property string $dnevn_originals
 * @property string $dnevn_electro
 * @property string $zaoch
 * @property string $zaoch_budget
 * @property string $zaoch_contract
 * @property string $zaoch_pv
 * @property string $zaoch_pzk
 * @property string $zaoch_originals
 * @property string $zaoch_electro
 * @property string $medals
 */
class AllCounts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AllCounts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function primaryKey() {
            return "ID";
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'all_counts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID', 'required'),
			//array('ID', 'numerical', 'integerOnly'=>true),
			array('Fakultet', 'length', 'max'=>255),
			array('Specialnost', 'length', 'max'=>216),
			array('dnevn, dnevn_budget, dnevn_contract, dnevn_pv, dnevn_pzk, dnevn_originals, dnevn_electro, zaoch, zaoch_budget, zaoch_contract, zaoch_pv, zaoch_pzk, zaoch_originals, zaoch_electro, medals', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Fakultet, Specialnost, dnevn, dnevn_budget, dnevn_contract, dnevn_pv, dnevn_pzk, dnevn_originals, dnevn_electro, cnt_dnevn_budgetcount_view,
                            zaoch, zaoch_budget, zaoch_contract, zaoch_pv, zaoch_pzk, zaoch_originals, zaoch_electro, cnt_zaoch_budgetcount_view, medals', 'safe', 'on'=>'search'),
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
    'ID' => 'ID',
    'Fakultet' => 'Факультет',
    'Specialnost' => 'Спеціальність',
    'dnevn' => 'К-сть заявок на денну форму',
    'dnevn_budget' => 'К-сть заявок на бюджет (денна)',
    'dnevn_contract' => 'К-сть заявок на контракт (денна)',
    'dnevn_pv' => 'К-сть позачерг. заявок (денна)',
    'dnevn_pzk' => 'К-сть позаконкуср. заявок (денна)',
    'dnevn_originals' => 'К-сть заявок з наданням оригіналів (денна)',
    'dnevn_electro' => 'К-сть електр. заявок (денна)',
    'cnt_dnevn_budgetcount_view' => 'К-сть бюджетних місць (денна)',
    'cnt_dnevn_contractcount_view' => 'К-сть контрактних місць (денна)',
    'zaoch' => 'К-сть заявок на заочну форму',
    'zaoch_budget' => 'К-сть заявок на бюджет (заочна)',
    'zaoch_contract' => 'К-сть заявок на контракт (заочна)',
    'zaoch_pv' => 'К-сть позачерг. заявок (заочна)',
    'zaoch_pzk' => 'К-сть позаконкуср. заявок (заочна)',
    'zaoch_originals' => 'К-сть заявок з наданням оригіналів (заочна)',
    'zaoch_electro' => 'К-сть електр. заявок (заочна)',
    'cnt_zaoch_budgetcount_view' => 'К-сть бюджетних місць (заочна)',
    'cnt_zaoch_contractcount_view' => 'К-сть контрактних місць (заочна)',           
    'medals' => 'К-сть медалістів',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                
		//$criteria->compare('ID',$this->ID);
		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn);
		$criteria->compare('dnevn_budget',$this->dnevn_budget);
		$criteria->compare('dnevn_contract',$this->dnevn_contract);
		$criteria->compare('dnevn_pv',$this->dnevn_pv);
		$criteria->compare('dnevn_pzk',$this->dnevn_pzk);
		$criteria->compare('dnevn_originals',$this->dnevn_originals);
		$criteria->compare('dnevn_electro',$this->dnevn_electro);
		$criteria->compare('zaoch',$this->zaoch);
		$criteria->compare('zaoch_budget',$this->zaoch_budget);
		$criteria->compare('zaoch_contract',$this->zaoch_contract);
		$criteria->compare('zaoch_pv',$this->zaoch_pv);
		$criteria->compare('zaoch_pzk',$this->zaoch_pzk);
		$criteria->compare('zaoch_originals',$this->zaoch_originals);
		$criteria->compare('zaoch_electro',$this->zaoch_electro);
		$criteria->compare('medals',$this->medals);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
        
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchBachelors($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                
		//$criteria->compare('ID',$this->ID);
		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn);
		$criteria->compare('dnevn_budget',$this->dnevn_budget);
		$criteria->compare('dnevn_contract',$this->dnevn_contract);
		$criteria->compare('dnevn_pv',$this->dnevn_pv);
		$criteria->compare('dnevn_pzk',$this->dnevn_pzk);
		$criteria->compare('dnevn_originals',$this->dnevn_originals);
		$criteria->compare('dnevn_electro',$this->dnevn_electro);
		$criteria->compare('zaoch',$this->zaoch);
		$criteria->compare('zaoch_budget',$this->zaoch_budget);
		$criteria->compare('zaoch_contract',$this->zaoch_contract);
		$criteria->compare('zaoch_pv',$this->zaoch_pv);
		$criteria->compare('zaoch_pzk',$this->zaoch_pzk);
		$criteria->compare('zaoch_originals',$this->zaoch_originals);
		$criteria->compare('zaoch_electro',$this->zaoch_electro);
		$criteria->compare('medals',$this->medals);
                $criteria->addCondition("Specialnost LIKE '%6.%'");
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}

  	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchSpecialists($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                
		//$criteria->compare('ID',$this->ID);
		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn);
		$criteria->compare('dnevn_budget',$this->dnevn_budget);
		$criteria->compare('dnevn_contract',$this->dnevn_contract);
		$criteria->compare('dnevn_pv',$this->dnevn_pv);
		$criteria->compare('dnevn_pzk',$this->dnevn_pzk);
		$criteria->compare('dnevn_originals',$this->dnevn_originals);
		$criteria->compare('dnevn_electro',$this->dnevn_electro);
		$criteria->compare('zaoch',$this->zaoch);
		$criteria->compare('zaoch_budget',$this->zaoch_budget);
		$criteria->compare('zaoch_contract',$this->zaoch_contract);
		$criteria->compare('zaoch_pv',$this->zaoch_pv);
		$criteria->compare('zaoch_pzk',$this->zaoch_pzk);
		$criteria->compare('zaoch_originals',$this->zaoch_originals);
		$criteria->compare('zaoch_electro',$this->zaoch_electro);
                $criteria->addCondition("Specialnost LIKE '%7.%'");
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}
      
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchMagisters($Date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                
		//$criteria->compare('ID',$this->ID);
		$criteria->compare('Fakultet',$this->Fakultet,true);
		$criteria->compare('Specialnost',$this->Specialnost,true);
		$criteria->compare('dnevn',$this->dnevn);
		$criteria->compare('dnevn_budget',$this->dnevn_budget);
		$criteria->compare('dnevn_contract',$this->dnevn_contract);
		$criteria->compare('dnevn_pv',$this->dnevn_pv);
		$criteria->compare('dnevn_pzk',$this->dnevn_pzk);
		$criteria->compare('dnevn_originals',$this->dnevn_originals);
		$criteria->compare('dnevn_electro',$this->dnevn_electro);
		$criteria->compare('zaoch',$this->zaoch);
		$criteria->compare('zaoch_budget',$this->zaoch_budget);
		$criteria->compare('zaoch_contract',$this->zaoch_contract);
		$criteria->compare('zaoch_pv',$this->zaoch_pv);
		$criteria->compare('zaoch_pzk',$this->zaoch_pzk);
		$criteria->compare('zaoch_originals',$this->zaoch_originals);
		$criteria->compare('zaoch_electro',$this->zaoch_electro);
                $criteria->addCondition("Specialnost LIKE '%8.%'");
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>10000,
                        )
		));
	}


  }