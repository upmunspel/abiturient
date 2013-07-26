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
			array('PersonSpecialityID, ContractDate, CustomerName, CustomerDoc, CustomerAddress, CustomerPaymentDetails, Comment', 'required'),
			array('PersonSpecialityID', 'numerical', 'integerOnly'=>true),
			array('ContractNumber', 'length', 'max'=>100),
			array('PaymentDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idContract, PersonSpecialityID, ContractNumber, ContractDate, CustomerName, CustomerDoc, CustomerAddress, CustomerPaymentDetails, PaymentDate, Comment', 'safe', 'on'=>'search'),
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
    'idContract' => 'Id Contract',
    'PersonSpecialityID' => 'Person Speciality',
    'ContractNumber' => 'Contract Number',
    'ContractDate' => 'Contract Date',
    'CustomerName' => 'Customer Name',
    'CustomerDoc' => 'Customer Doc',
    'CustomerAddress' => 'Customer Address',
    'CustomerPaymentDetails' => 'Customer Payment Details',
    'PaymentDate' => 'Payment Date',
    'Comment' => 'Comment',
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

		$criteria->compare('idContract',$this->idContract);
		$criteria->compare('PersonSpecialityID',$this->PersonSpecialityID);
		$criteria->compare('ContractNumber',$this->ContractNumber,true);
		$criteria->compare('ContractDate',$this->ContractDate,true);
		$criteria->compare('CustomerName',$this->CustomerName,true);
		$criteria->compare('CustomerDoc',$this->CustomerDoc,true);
		$criteria->compare('CustomerAddress',$this->CustomerAddress,true);
		$criteria->compare('CustomerPaymentDetails',$this->CustomerPaymentDetails,true);
		$criteria->compare('PaymentDate',$this->PaymentDate,true);
		$criteria->compare('Comment',$this->Comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}