<?php

/**
 * This is the model class for table "contracts".
 *
 * The followings are the available columns in table 'contracts':
 * @property integer $idContract
 * @property integer $PersonSpecialityID
 * @property string $ContractNumber
 * @property string $ContractDate
 * @property string $CustomerName
 * @property string $CustomerDoc
 * @property string $CustomerAddress
 * @property string $CustomerPaymentDetails
 * @property string $PaymentDate
 * @property string $Comment
 */
class Contracts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contracts the static model class
	 */
        public $educationFormID;
        
        public function getFIO(){
            if (!empty($this->speciality)) {
                return $this->speciality->FIO;
            }
            return "";
        }
        public function getEducationFormID(){
            if (!empty($this->speciality)) {
                return $this->speciality->EducationFormID;
            }
            return "";
        }
        public function setEducationFormID($val){
            $this->educationFormID = $val;
        }
        
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contracts';
	}
       
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PersonSpecialityID, ContractDate', 'required'),
			array('PersonSpecialityID', 'numerical', 'integerOnly'=>true),
			array('ContractNumber', 'length', 'max'=>100),
	                array('PaymentDate', "date", 'format'=>"dd-MM-yyyy","allowEmpty"=>true ),
                        array('ContractDate', "date", 'format'=>"dd-MM-yyyy","allowEmpty"=>false ),
                        array('Comment,CustomerPaymentDetails,CustomerName, CustomerDoc,CustomerAddress', "safe"),
                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idContract, PersonSpecialityID, ContractNumber, ContractDate, CustomerName, CustomerDoc, CustomerAddress, CustomerPaymentDetails, PaymentDate, Comment, speciality, educationFormID', 'safe', 'on'=>'search'),
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
                      'speciality' => array(self::BELONGS_TO, "PersonContractSpecialityView", 'PersonSpecialityID')
		);
	}
         protected function beforeSave() {
            if (!empty( $this->PaymentDate)) $this->PaymentDate=date('Y-m-d', strtotime($this->PaymentDate));  
             if (!empty( $this->ContractDate)) $this->ContractDate=date('Y-m-d', strtotime($this->ContractDate)); 
            
            return parent::beforeSave();
           
        }
        public function afterFind() {
            if ($this->PaymentDate=="0000-00-00"){
                $this->PaymentDate="";     
            } else {
                $this->PaymentDate = date("d-m-Y", strtotime($this->PaymentDate));
            }
          
            if ($this->ContractDate=="0000-00-00"){
                $this->ContractDate="";     
            } else {
                $this->ContractDate = date("d-m-Y", strtotime($this->ContractDate));
            }
            
            parent::afterFind();
            return true;
        }

        /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'idContract' => 'Код контракту',
                    'PersonSpecialityID' => 'Код спеціальності',
                    'ContractNumber' => 'Номер контракту',
                    'ContractDate' => 'Дата укладання',
                    'CustomerName' => 'Замовник',
                    'CustomerDoc' => 'Документи замовника',
                    'CustomerAddress' => 'Адреса',
                    'CustomerPaymentDetails' => 'Платіжні реквізити',
                    'PaymentDate' => 'Дата оплати',
                    'Comment' => 'Коментарій',
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
            
//            $dataProvider=new CActiveDataProvider( "Personspeciality", array('criteria'=>array(
//    'condition'=>$cond,
//    //'order'=>'RequestNumber DESC',
//    'with'=>array('sepciality',"educationForm"),
//    ),
//    'sort' =>array(
//            'attributes' =>array( "",
////                    'sepciality'=>array(
////                                    'asc'=>'sepciality.SpecialityDirectionName',
////                                    'desc'=>'sepciality.SpecialityDirectionName DESC',
////                            ),
////                    '*',
//            ),
//        ),
//    'pagination'=>array(
//        'pageSize'=>50,
//    )
//));

		$criteria=new CDbCriteria;
                //$criteria->with = array('speciality');
		$criteria->compare('idContract',$this->idContract);
		$criteria->compare('speciality.SpecCodeName',$this->PersonSpecialityID, true);
                $criteria->compare('speciality.EducationFormID',$this->educationFormID);
		$criteria->compare('ContractNumber',$this->ContractNumber,true);
		$criteria->compare('ContractDate',$this->ContractDate,true);
		$criteria->compare('CustomerName',$this->CustomerName,true);
		$criteria->compare('CustomerDoc',$this->CustomerDoc,true);
		$criteria->compare('CustomerAddress',$this->CustomerAddress,true);
		$criteria->compare('CustomerPaymentDetails',$this->CustomerPaymentDetails,true);
                if (!empty($this->PaymentDate) && ($this->PaymentDate == 0 || trim($this->PaymentDate)=="empty" || trim($this->PaymentDate)=="null") ) {
                   $criteria->compare('PaymentDate',"0000-00-00",true); 
                } else {
                   $criteria->compare('PaymentDate',$this->PaymentDate,true);
                }
		$criteria->compare('Comment',$this->Comment,true);
                $criteria->with = array('speciality');
                $criteria->compare('speciality.FIO',$this->speciality,true);
		return new CActiveDataProvider($this, array(
                            'criteria'=>$criteria,
//                            'sort' => array(
//                                'attributes' =>array(
//                                        'speciality'=>array(
//                                                        'asc'=>'speciality.FIO',
//                                                        'desc'=>'speciality.FIO DESC',
//                                                ),
//                                        'educationFormID'=>array(
//                                                        'asc'=>'speciality.FIO',
//                                                        'desc'=>'speciality.FIO DESC',
//                                                ),
//                                        '*',
//                                 ),
//                            )
                            )
                        );
	}
}