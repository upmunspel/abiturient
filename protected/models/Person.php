<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $idPerson
 * @property string $Birthday
 * @property string $BirthPlace
 * @property integer $PersonSexID
 * @property string $FirstName
 * @property string $MiddleName
 * @property string $LastName
 * @property integer $KOATUUCodeL1ID
 * @property integer $KOATUUCodeL2ID
 * @property integer $KOATUUCodeL3ID
 * @property integer $IsResident
 * @property integer $PersonEducationTypeID
 * @property integer $StreetTypeID
 * @property string $Address
 * @property string $HomeNumber
 * @property string $PostIndex
 * @property integer $SchoolID
 * @property string $FirstNameR
 * @property string $MiddleNameR
 * @property string $LastNameR
 * @property integer $LanguageID
 * @property integer $CountryID
 * @property string  $PhotoName
 * @property integer $isCampus
 * @property integer $SysUserID
 * @property integer $isSamaSchoolAddr
 * @property Documents $entrantdoc
 * @property Documents $persondoc
 * @property Documents $edboID
 * @property string $CreateDate
 */
class Person extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Person the static model class
	 */
       
        private $persondoc = NULL;
        private $entrantdoc = NULL;
        private $inndoc = NULL;
        private $hospdoc = NULL;
        private $homephone = NULL;
        private $mobphone = NULL;
        
        public function getFIO(){
            return $this->LastName." ".$this->FirstName." ".$this->MiddleName;
        } 
        public function getOperatorInfo(){
            if (!empty($this->SysUserID) ){
                $model = User::model()->findByPk($this->SysUserID);
                return $model->info;
            }
            return null;
        }   
       
        
        public function getHomephone(){
            if (!empty($this->homephone)) return $this->homephone;
            if (!$this->isNewRecord){
                $sql = "select * from `personcontacts` where ";
                $sql = $sql."`personcontacts`.`PersonID` = :PersonID and `personcontacts`.PersonContactTypeID = 1;"; 
                $this->homephone = PersonContacts::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->homephone))  $this->homephone = new PersonContacts();
            } else {
                $this->homephone = new PersonContacts();
            }
            $this->homephone->PersonContactTypeID = 1;
            return $this->homephone;
        }
        public function getMobphone(){
            if (!empty($this->mobphone)) return $this->mobphone;
            if (!$this->isNewRecord){
                $sql = "select * from `personcontacts` where ";
                $sql = $sql."`personcontacts`.`PersonID` = :PersonID and `personcontacts`.PersonContactTypeID = 2;"; 
                $this->mobphone = PersonContacts::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->mobphone))  $this->mobphone = new PersonContacts();
            } else {
                $this->mobphone = new PersonContacts();
            }
            $this->mobphone->PersonContactTypeID = 2; 
            return $this->mobphone;
        }
        public function getPersondoc(){
            if (!empty($this->persondoc)) return $this->persondoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`IsEntrantDocument` = 2 and `documents`.PersonID = :PersonID";
                $this->persondoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->persondoc))  $this->persondoc = new Documents();
            } else {
                $this->persondoc = new Documents();
            }
            
            return $this->persondoc;
        }
        public function getEntrantdoc(){
            if (!empty($this->entrantdoc)) return $this->entrantdoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`IsEntrantDocument` = 1 and `documents`.PersonID = :PersonID";
                $this->entrantdoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->entrantdoc))  $this->entrantdoc = new Documents();
            } else {
                $this->entrantdoc = new Documents();
            }
            $this->entrantdoc->scenario = "ENTRANT";
            return $this->entrantdoc;
        }
        public function getInndoc(){
            if (!empty($this->inndoc)) return $this->inndoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`idPersonDocumentTypes` = 5 and `documents`.PersonID = :PersonID";
                $this->inndoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->inndoc))  $this->inndoc = new Documents();
            } else {
                $this->inndoc = new Documents();
            }
            $this->inndoc->scenario = "INN";
            $this->inndoc->TypeID = 5;
            return $this->inndoc;
        }
        public function getHospdoc(){
            if (!empty($this->hospdoc)) return $this->hospdoc;
            if (!$this->isNewRecord){
                $sql = "select `documents`.* from `documents` left join  `persondocumenttypes`"; 
                $sql = $sql." on `documents`.`TypeID` = persondocumenttypes.`idPersonDocumentTypes`"; 
                $sql = $sql." where `persondocumenttypes`.`idPersonDocumentTypes` = 6 and `documents`.PersonID = :PersonID";
                $this->hospdoc = Documents::model()->findBySql($sql, array(":PersonID"=>$this->idPerson));
                if (empty($this->hospdoc))  $this->hospdoc = new Documents();
            } else {
                $this->hospdoc = new Documents();
            }
            $this->hospdoc->scenario = "HOSP";
            $this->hospdoc->TypeID = 6;
            return $this->hospdoc;
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
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HomeNumber, PostIndex, Address,
                                FirstName, LastName, FirstNameR, 
                                LastNameR, LanguageID', 'required'),
			array('PersonSexID, KOATUUCodeL1ID, KOATUUCodeL2ID, 
                                KOATUUCodeL3ID, IsResident, PersonEducationTypeID, StreetTypeID, SchoolID, LanguageID, CountryID', 'numerical', 'integerOnly'=>true),
			array('FirstName, MiddleName, LastName, FirstNameR, MiddleNameR, LastNameR, codeU', 'length', 'max'=>100),
			
                        array('codeU, edboID', "unique", "allowEmpty"=>'true' ),
                
                        array('Address, PhotoName', 'length', 'max'=>250),
			array('HomeNumber, PostIndex', 'length', 'max'=>10),
			array('Birthday, BirthPlace, isCampus, isSamaSchoolAddrk, CreateDate, isSamaSchoolAddr', 'safe'),
                    
                        //array('Birthday', 'date', "format"=>'dd.MM.yyyy', 'allowEmpty'=>true ),
                        //
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPerson, Birthday, PersonSexID, FirstName, MiddleName,
                            LastName, KOATUUCodeL1ID, KOATUUCodeL2ID, KOATUUCodeL3ID, 
                            IsResident, PersonEducationTypeID, StreetTypeID, Address, HomeNumber, 
                            PostIndex, SchoolID, FirstNameR, MiddleNameR, LastNameR,  
                            CountryID, PersonDocumentID, EntrantDocumentID', 'safe', 'on'=>'search'),
                    
                       array('PhotoName', 'file', 'types'=>'jpg, gif, png', 'maxSize' => 5048576,'on'=>'PHOTO'),
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
                    'benefits' => array(self::HAS_MANY, 'Personbenefits', 'PersonID'),
                    'znos'=>array(self::HAS_MANY, 'Documents', 'PersonID', 'on'=>'znos.TypeID=4'),
                    'specs'=>array(self::HAS_MANY, 'Personspeciality', 'PersonID'),
                    'docs'=>array(self::HAS_MANY, 'Documents', 'PersonID'),
		);
	}
       
        
        protected function beforeSave() {
            unset($this->CreateDate);
            if ($this->KOATUUCodeL1ID == "0") $this->KOATUUCodeL1ID = NULL;
            if ($this->KOATUUCodeL2ID == "0") $this->KOATUUCodeL2ID = NULL;
            if ($this->KOATUUCodeL3ID == "0") $this->KOATUUCodeL3ID = NULL;
            if ($this->SchoolID == "0") $this->SchoolID = NULL;
            
           // $from=DateTime::createFromFormat('d.m.Y',$this->Birthday);
            $this->Birthday=date('Y-m-d', strtotime($this->Birthday));  
        
         
            parent::beforeSave();
            return true;
        }
        protected function afterFind() {
            //if (empty($this->KOATUUCodeL1ID)) $this->KOATUUCodeL1ID = 105572;
            //if (empty($this->KOATUUCodeL2ID)) $this->KOATUUCodeL2ID = 105574;
            //if (empty($this->KOATUUCodeL3ID)) $this->KOATUUCodeL3ID = 105576;
            
            if ($this->Birthday=="0000-00-00"){
                $this->Birthday="01.01.1995";     
            } else {
                $this->Birthday = date("d.m.Y", strtotime($this->Birthday));
            }
         
            $this->CreateDate = date("d.m.Y", strtotime($this->CreateDate));
            parent::afterFind();
            return true;
        }
        
        protected function afterConstruct() {
            if (empty($this->PhotoName))      $this->PhotoName = Yii::app()->params['defaultPersonPhoto'];
            //if (empty($this->KOATUUCodeL1ID)) $this->KOATUUCodeL1ID = 105572;
            //if (empty($this->KOATUUCodeL2ID)) $this->KOATUUCodeL2ID = 105574;
            //if (empty($this->KOATUUCodeL3ID)) $this->KOATUUCodeL3ID = 105576;
            $this->IsResident = 1;
            $this->CountryID = 804;
            parent::afterConstruct();
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'idPerson' => 'Код',
			'Birthday' => 'Дата народження',
			'PersonSexID' => 'Стать',
			'FirstName' => "Ім'я",
			'MiddleName' => 'По батькові',
			'LastName' => "Прізвище",
                        'FirstNameR' => "Ім'я (родовий)",
			'MiddleNameR' => 'По батькові (родовий)',
			'LastNameR' => "Прізвище (родовий)",
			'IsResident' => 'Громадянин України',
			'KOATUUCode' => 'Koatuucode',
			'PersonEducationTypeID' => 'Person Education Type',
			'StreetTypeID' => "Тип вулиці",
			'Address' => "Назва вулиці",
			'HomeNumber' => '№ будинку, кв.',
			'PostIndex' => 'Індекс',
			'idKOATUU' => 'Id Koatuu',
                        'LanguageID' => 'Іноземна мова',
			'CountryID' => 'Країна громадянства',
                        "PersonEducationTypeID"=>"Попередня освіта",
                        "PhotoName"=>"Фото абітурієнта",
                        "SchoolID"=>"Назва школи",
                        "isCampus"=>"Гуртожиток",
                        "codeU"=>"GUID Код",
                        "edboID"=>"Ідентифікатор ЄДБО",
                        'BirthPlace'=>'Місце народження',
                        'CreateDate'=>'Дата додання',
                        "FIO"=>"ФИО",
                        "operatorInfo"=>"Оператор",
                    
		);
	}
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                $user = Yii::app()->user->getUserModel();
                
		$criteria=new CDbCriteria;

                if (!empty($user)){
                   // $criteria->with = 
                    
                }
		$criteria->compare('idPerson',$this->idPerson);
		$criteria->compare('Birthday',$this->Birthday,true);
		$criteria->compare('PersonSexID',$this->PersonSexID);
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('MiddleName',$this->MiddleName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('KOATUUCodeL1ID',$this->KOATUUCodeL1ID);
		$criteria->compare('KOATUUCodeL2ID',$this->KOATUUCodeL2ID);
		$criteria->compare('KOATUUCodeL3ID',$this->KOATUUCodeL3ID);
		$criteria->compare('IsResident',$this->IsResident);
		$criteria->compare('PersonEducationTypeID',$this->PersonEducationTypeID);
		$criteria->compare('StreetTypeID',$this->StreetTypeID);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('HomeNumber',$this->HomeNumber,true);
		$criteria->compare('PostIndex',$this->PostIndex,true);
		$criteria->compare('SchoolID',$this->SchoolID);
		$criteria->compare('FirstNameR',$this->FirstNameR,true);
		$criteria->compare('MiddleNameR',$this->MiddleNameR,true);
		$criteria->compare('LastNameR',$this->LastNameR,true);
		$criteria->compare('LanguageID',$this->LanguageID);
		$criteria->compare('CountryID',$this->CountryID);
                if (!empty($this->CreateDate)){
                    $criteria->addBetweenCondition('CreateDate', date('Y-m-d', strtotime($this->CreateDate)), date('Y-m-d', strtotime($this->CreateDate))." 23:59:59");
                }
                
                //$criteria->compare('CreateDate',$this->CreateDate);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function PhotoSearch(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                $user = Yii::app()->user->getUserModel();
                
		$criteria=new CDbCriteria;

                if (!empty($user)){
                   // $criteria->with = 
                    
                }
                
                $criteria->compare('PhotoName',Yii::app()->params['defaultPersonPhoto']); 
		$criteria->compare('idPerson',$this->idPerson);
		$criteria->compare('Birthday',$this->Birthday,true);
		$criteria->compare('PersonSexID',$this->PersonSexID);
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('MiddleName',$this->MiddleName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('KOATUUCodeL1ID',$this->KOATUUCodeL1ID);
		$criteria->compare('KOATUUCodeL2ID',$this->KOATUUCodeL2ID);
		$criteria->compare('KOATUUCodeL3ID',$this->KOATUUCodeL3ID);
		$criteria->compare('IsResident',$this->IsResident);
		$criteria->compare('PersonEducationTypeID',$this->PersonEducationTypeID);
		$criteria->compare('StreetTypeID',$this->StreetTypeID);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('HomeNumber',$this->HomeNumber,true);
		$criteria->compare('PostIndex',$this->PostIndex,true);
		$criteria->compare('SchoolID',$this->SchoolID);
		$criteria->compare('FirstNameR',$this->FirstNameR,true);
		$criteria->compare('MiddleNameR',$this->MiddleNameR,true);
		$criteria->compare('LastNameR',$this->LastNameR,true);
		$criteria->compare('LanguageID',$this->LanguageID);
		$criteria->compare('CountryID',$this->CountryID);
                if (!empty($this->CreateDate)){
                    $criteria->addBetweenCondition('CreateDate', date('Y-m-d', strtotime($this->CreateDate)), date('Y-m-d', strtotime($this->CreateDate))." 23:59:59");
                }
                
                //$criteria->compare('CreateDate',$this->CreateDate);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         *  Возвращает массив найденых в edbo персон
         *  Сохраняет результат в сесии с именем "edboResult"
         */
        public static function JsonDataAsArray($json_string){
            $result = array();
            Yii::app()->session["edboResult"] = $json_string; 
            $objarr = CJSON::decode($json_string);
            if ( trim($json_string) != "0" && !empty($json_string) && count($objarr) > 0) {
                foreach($objarr as $item){
                    $obj = (object)$item;
                    if (!empty($obj->id_Person ) && ($obj->id_Person >0) ){
                       $model = new Person();
                       $model->codeU = $obj->personCodeU;
                       $model->LastName = $obj->lastName ;
                       $model->FirstName = $obj->firstName ;
                       $model->MiddleName = $obj->middleName ;
                       $model->PersonSexID = $obj->id_PersonSex ;
                       $model->Birthday = date("d.m.Y",mktime(0, 0, 0, $obj->birthday['month']+1,  $obj->birthday['dayOfMonth'],  $obj->birthday['year']));

                    } 
                    $result[] = $model;  
                }
           
            } else {
                    Yii::app()->user->setFlash("message",'<h3 style="color: red;">Увага! Результат відсутній спробуйте інший критерій пошуку!</h3>');
            }
            return $result;
        }
                  
        /**
         * loadByUCode - загружает модели используя codeu и переменную сессии edboResult
         * @param type $codeu
         * @return boolean
         */
        public function loadByUCode($codeu){
          
            if (!empty($codeu)) {
               $json_string = Yii::app()->session["edboResult"];  
               $objarr = CJSON::decode($json_string);
               $obj = null;
               if (count($objarr) > 0) {
                    foreach($objarr as $item){
                        $itemobj = (object)$item; 
                        if (trim($itemobj->personCodeU) == trim($codeu)) {
                            $obj = $itemobj;
                        }
                    }
                    if (!empty($obj)){
                       $model = $this;
                       $model->codeU = $obj->personCodeU;
                       $model->edboID = $obj->id_Person;
                       $model->LastName = $obj->lastName ;
                       $model->FirstName = $obj->firstName ;
                       $model->MiddleName = $obj->middleName ;
                       $model->LastNameR = $obj->lastName ;
                       $model->FirstNameR = $obj->firstName ;
                       $model->MiddleNameR = $obj->middleName ;
                       $model->PersonSexID = $obj->id_PersonSex ;
                       $model->Birthday = date("d.m.Y",mktime(0, 0, 0, $obj->birthday['month']+1,  $obj->birthday['dayOfMonth'],  $obj->birthday['year']));
                       $model->IsResident = $obj->resident;
                       $model->KOATUUCodeL1ID = $obj->id_KoatuuCodeL1 ;
                       $model->KOATUUCodeL2ID = $obj->id_KoatuuCodeL2 ;
                       $model->KOATUUCodeL3ID = $obj->id_KoatuuCodeL3;
                       $model->StreetTypeID = $obj->id_StreetType ;
                       $model->Address = $obj->address ;
                       $model->PostIndex = $obj->postIndex ;
                       $model->HomeNumber = $obj->homeNumber;
                       return true;
                  }
               }
            }
            return false;
         }
        
         /**
          * loadDocumentsFromJSON - загружает документы персоны из результата поиска в edbo по codeu персоны
          * @param type $json_string
          * @return type
          */
        public function loadDocumentsFromJSON($json_string){
            //$json_string = preg_replace("/[+-]?\d+\.\d+/", '"\0"', $json_string ); 
            
            $objarr = CJSON::decode($json_string);
         
            if (!empty($this->codeU)){
               Yii::app()->session[$this->codeU."-documents"] = serialize($objarr); 
            }
            
            if ( trim($json_string) == "0" && empty($json_string) && count($objarr) == 0) return;
            
            foreach($objarr as $item){
                 $val = (object)$item;
                 $model = $this;
//2	Атестат про повну загальну середню освіту	1
//3	Паспорт	2
//4	Сертифікат ЗНО	0
//5	Індивідуальний податковий номер	0
//6	Медична довідка	0
//7	Cвідоцтво про базову середню освіту	1
//8	Cвідоцтво кваліфікованого робітника	1
//9	Диплом кваліфікованого робітника	1
//10	Диплом молодшого спеціаліста	1
//11	Диплом бакалавра	1
//12	Диплом спеціаліста	1
//13	Диплом магістра	1
//14	Академічна довідка	1
//15	Витяг із заліково-екзаменаційних відомостей	1
//16	Студентський квиток	0
//17	Посвідка на постійне проживання в Україні
                 if ($val->id_Type == 7)   {
                        $model->entrantdoc = new Documents();
                        $model->entrantdoc->TypeID = $val->id_Type;
                        $model->entrantdoc->edboID = $val->id_Document;
                        $model->entrantdoc->AtestatValue=$val->attestatValue;
                        $model->entrantdoc->Numbers=$val->number;
                        $model->entrantdoc->Series=$val->series;
                        $model->entrantdoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                        $model->entrantdoc->ZNOPin = $val->znoPin;
                        $model->entrantdoc->Issued = $val->issued;
                 }
                 if ($val->id_Type == 2)   {
                        $model->entrantdoc = new Documents();
                        $model->entrantdoc->TypeID = $val->id_Type;
                        $model->entrantdoc->edboID = $val->id_Document;
                        $model->entrantdoc->AtestatValue=$val->attestatValue;
                        $model->entrantdoc->Numbers=$val->number;
                        $model->entrantdoc->Series=$val->series;
                        $model->entrantdoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                        $model->entrantdoc->ZNOPin = $val->znoPin;
                        $model->entrantdoc->Issued = $val->issued;
                 }
                 if ($val->id_Type == 11)   {
                        $model->entrantdoc = new Documents();
                        $model->entrantdoc->TypeID = $val->id_Type;
                        $model->entrantdoc->edboID = $val->id_Document;
                        $model->entrantdoc->AtestatValue=$val->attestatValue;
                        $model->entrantdoc->Numbers=$val->number;
                        $model->entrantdoc->Series=$val->series;
                        $model->entrantdoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                        $model->entrantdoc->ZNOPin = $val->znoPin;
                        $model->entrantdoc->Issued = $val->issued;
                         
                         
                 }
                  if ($val->id_Type == 12)   {
                        $model->entrantdoc = new Documents();
                        $model->entrantdoc->TypeID = $val->id_Type;
                        $model->entrantdoc->edboID = $val->id_Document;
                        $model->entrantdoc->AtestatValue=$val->attestatValue;
                        $model->entrantdoc->Numbers=$val->number;
                        $model->entrantdoc->Series=$val->series;
                        $model->entrantdoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                        $model->entrantdoc->ZNOPin = $val->znoPin;
                        $model->entrantdoc->Issued = $val->issued;
                        
                 }
               
                 
                 if ($val->id_Type == 1)   {

                        $model->persondoc = new Documents();
                        $model->persondoc->TypeID = $val->id_Type;
                        $model->persondoc->edboID = $val->id_Document;
                        $model->persondoc->AtestatValue=$val->attestatValue;
                        $model->persondoc->Numbers=$val->number;
                        $model->persondoc->Series=$val->series;
                        $model->persondoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                        $model->persondoc->ZNOPin = $val->znoPin;
                        $model->persondoc->Issued = $val->issued;

                 }
                 if ($val->id_Type == 3 )   {
                        $model->persondoc = new Documents();
                        $model->persondoc->TypeID = $val->id_Type;
                        $model->persondoc->edboID = $val->id_Document;
                        $model->persondoc->AtestatValue=$val->attestatValue;
                        $model->persondoc->Numbers=$val->number;
                        $model->persondoc->Series=$val->series;
                        $model->persondoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                        $model->persondoc->ZNOPin = $val->znoPin;
                        $model->persondoc->Issued = $val->issued;
                 }
                 if ($val->id_Type == 5)   {
                        $model->inndoc = new Documents();
                        
                        $model->inndoc->TypeID = $val->id_Type;
                        $model->inndoc->Numbers=$val->number;
                        $model->inndoc->edboID = $val->id_Document;
                  
                 }
                 if ($val->id_Type == 6 )   {
                        $model->hospdoc = new Documents();
                        $model->hospdoc->TypeID = $val->id_Type;
                        $model->hospdoc->edboID = $val->id_Document;
                        $model->hospdoc->DateGet=date("d.m.Y",mktime(0, 0, 0, $val->dateGet['month']+1,  $val->dateGet['dayOfMonth'],  $val->dateGet['year']));
                        
                 }
                 
            }
        }
        
        /**
         * loadContactsFromJSON - загружает контакты персоны из результата поиска в edbo по codeu персоны
         * @param type $json_string
         * @return type
         */
        public function loadContactsFromJSON($json_string){
             
            $objarr = CJSON::decode($json_string);
            
            if ( trim($json_string) == "0" && empty($json_string) && count($objarr) == 0) return;
            
            foreach($objarr as $item){
                 $val = (object)$item;
                 $model = $this;
                 if ($val->id_ContactType == 1)   {
                     $model->homephone = new PersonContacts();
                     $model->homephone->PersonContactTypeID = $val->id_ContactType;
                     $model->homephone->PersonID = $model->idPerson;
                     $model->homephone->Value = $val->value ;
                 }
                 if ($val->id_ContactType == 2)   {
                     $model->mobphone = new PersonContacts();
                     $model->mobphone->PersonContactTypeID = $val->id_ContactType;
                     $model->mobphone->PersonID = $model->idPerson;
                     $model->mobphone->Value =$val->value;
                 }  
                 
            }
        }

         /**
          * SendEdboRequest - отправляет запрос на добавление персоны в Edbo 
          * 
          * @return boolean - сигнализирует о возможности сохранения персоны в локальной базе
          * Если false - рекомендуется откатить транзакцию или удалить созданную персону
          */
         public function SendEdboRequest(){
             
            
            $params = array(
                "personIdMySql"=>$this->idPerson,
                "entrantDocumentIdMySql"=>$this->getEntrantdoc()->idDocuments,
                "personalDocumentIdMySql"=>$this->getPersondoc()->idDocuments
            );
//            debug($this->idPerson);
//            debug($this->entrantdoc->idDocuments);
            try {
                $client = new EHttpClient(Yii::app()->user->getEdboSearchUrl().Yii::app()->params["personAddURL"], array('maxredirects' => 30, 'timeout'=> 30,));
                $client->setParameterPost($params);
                $response = $client->request(EHttpClient::POST);

                if($response->isSuccessful()){
                      debug($response->getBody());
                      $obj = (object)CJSON::decode($response->getBody());
                      if ($obj->backTransaction){
                         Yii::app()->user->setFlash("message",'<h3 style="color: red;">'.$obj->message.'</h3>'); 
                         debug($obj->message);
                         return false;
                      } else {
//                         $this->edboID = $obj->id;
//                         $this->codeU = $obj->id;
                         Yii::app()->user->setFlash("message",'<h3 style="color: red;">'.$obj->message.'</h3>');  
                         //debug("Cинхронизаниция выполнена");
                      }
                 } else {
                      Yii::app()->user->setFlash("message",'<h3 style="color: red;">Помилка! Спробуйте пізніще!</h3>');  
                    debug($response->getRawBody());
                }
            } catch(Exception $e) {
                Yii::app()->user->setFlash("message",'<h3 style="color: red;">Помилка! Спробуйте пізніще!</h3>');  
                debug($e->getMessage());
            }
            
            return true;
        }
 }
