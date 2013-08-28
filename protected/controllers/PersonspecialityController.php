<?php

class PersonspecialityController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $defaultAction='admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
//		return array(
//			//'accessControl', // perform access control for CRUD operations
//			//'postOnly', // we only allow deletion via POST request
//		);
                return array(
			'accessControl', // perform access control for CRUD operations
                        'ajaxOnly + Refresh, Edboupdate, Studupdate',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(   'Znosubjects',
                                                    'Speciality',
                                                    'Specialitys',
                                                    'View',
                                                    'Create',
                                                    'Update',
                                                    "Delete", 
                                                    "Index", 
                                                    "Refresh", 
                                                    'admin',"Edboupdate",
                                                    'Studupdate',
                                                    "Create_electron",
                                                ),
				'users'=>array('@'),
			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionEdboupdate($id){
            $model  = Personspeciality::model()->findByPk($id);
            try {
                $link = Yii::app()->user->getEdboSearchUrl().":8080/PersonSearch/request.jsp";
                
                $client = new EHttpClient($link, array('maxredirects' => 30, 'timeout' => 30,));
               
                $client->setParameterPost(array("personIdMySql"=>$model->PersonID, "personSpeciality"=>$id));
                $response = $client->request(EHttpClient::POST);

                if($response->isSuccessful()){
                         $obj= (object)CJSON::decode($response->getBody());
                         if ($obj->error){
                            Yii::app()->user->setFlash("message",$obj->message);
                         }
                         
                } else {
                    Yii::app()->user->setFlash("message","Синхронізація не виконана! Спробуйте пізніше.");
                }
                } catch(Exception $e) {
                    Yii::app()->user->setFlash("message","Синхронізація не виконана! Спробуйте пізніше.");
                }
                
                echo CJSON::encode(array("result"=>"success","data" =>""));
        }
        
        
        public function actionZnosubjects($personid){
            $model=new Personspeciality;
            if(isset($_POST['Personspeciality'])){
                $model->attributes = $_POST['Personspeciality'];
                $model->PersonID = intval($personid);
            }
            $this->renderPartial("_subjects_holder", array('model'=>$model, 'specialityid'=>$model->SepcialityID));
        }
        
        public function actionSpeciality($idFacultet, $idEducationForm)
        {
//            $data = Specialities::model()->findAll('FacultetID=:FacultetID',
//                          array(':FacultetID'=>(int) $idFacultet));
//
//            $data=CHtml::listData($data,'idSpeciality','SpecialityName');
//            echo CHtml::tag('option', array('value'=>""), "", true);
            $data = Specialities::DropDownMask($idFacultet, $idEducationForm);
             echo CHtml::tag('option', array('value'=>""), "", true);
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
            }
        }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        /*
         * @param $model Personspeciality 
         */
        protected function _setDefaults($model){
            //$model = new Personspeciality();
            $user = User::model()->findByPk(Yii::app()->user->id);
            //debug(print_r($user->syspk, true));
            if (!empty($user->syspk)){
                $pk =  $user->syspk;
                //$pk=new SysPk();
                $model->CourseID = $pk->CourseID;
                $model->QualificationID = $pk->QualificationID; 
                $model->isBudget = $pk->isBudget;
                $model->isContract = $pk->isContract;
                $model->EducationFormID = $pk->EducationFormID;
            }
        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($personid)
	{
		$model=new Personspeciality;
                $model->PersonID = (int)$personid;
                $this->_setDefaults($model);
                $valid = true;
                
		if(isset($_GET['Personspeciality']))
		{       $renderForm = "_form";
			//if (isset($_GET['Personspeciality']['GraduatedUniversitieID'])){
                        if (!empty($_GET['Personspeciality']['QualificationID']) && $_GET['Personspeciality']['QualificationID'] > 1 && ($_GET['Personspeciality']['SepcialityID']!=70686 && $_GET['Personspeciality']['SepcialityID']!=90661)){
                            $model->scenario ="SHORTFORM";
                            $renderForm = "_formShort";
                            $model->CausalityID = 100;
                        }
                        $model->attributes=$_GET['Personspeciality'];
                        
                        if (intval($model->EntranceTypeID) == 1){
                            
                            $model->Exam1ID = null; $model->Exam1Ball = null;
                            $model->Exam2ID = null; $model->Exam2Ball = null;
                            $model->Exam3ID = null; $model->Exam3Ball = null;
                            $model->CausalityID = null;
                        } elseif (intval($model->EntranceTypeID) == 2){
                            $model->DocumentSubject1 = null;
                            $model->DocumentSubject2 = null;
                            $model->DocumentSubject3 = null;
                        } 
                        
                        $valid  = $model->validate() && $valid;
                        if (!$valid){
                            //debug ($model->PersonID);
                            echo CJSON::encode(array("result"=>"error","data" =>
                            $this->renderPartial($renderForm, array('model'=>$model),true)));
                             Yii::app()->end();
                        } else {
			if($model->save())
                            //debug ($model->PersonID);
                            $person = Person::model()->findByPk($model->PersonID);
                            echo CJSON::encode(array("result"=>"success","data" =>
                                 $this->renderPartial("//person/tabs/_spec", array('models'=>$person->specs,'personid'=>$model->PersonID), true)
                            ));
                            Yii::app()->end();
                        }
		}

		$this->renderPartial('_Modal', array('model'=>$model,'personid'=>$model->PersonID));
        }
        
   	public function actionCreate_electron($personid,$spec)
	{
		$model=new Personspeciality;
                $model->PersonID = (int)$personid;
                $this->_setDefaults($model);
                $valid = true;
                
		if(isset($_GET['Personspeciality']))
		{       $renderForm = "_form";
			//if (isset($_GET['Personspeciality']['GraduatedUniversitieID'])){
 
                        $model->attributes=$_GET['Personspeciality'];
                        
                        if (intval($model->EntranceTypeID) == 1){
                            
                            $model->Exam1ID = null; $model->Exam1Ball = null;
                            $model->Exam2ID = null; $model->Exam2Ball = null;
                            $model->Exam3ID = null; $model->Exam3Ball = null;
                            $model->CausalityID = null;
                        } elseif (intval($model->EntranceTypeID) == 2){
                            $model->DocumentSubject1 = null;
                            $model->DocumentSubject2 = null;
                            $model->DocumentSubject3 = null;
                        } 
                        
                        $valid  = $model->validate() && $valid;
                        if (!$valid){
                            //debug ($model->PersonID);
                            echo CJSON::encode(array("result"=>"error","data" =>
                            $this->renderPartial($renderForm, array('model'=>$model),true)));
                             Yii::app()->end();
                        } else {
			if($model->save())
                            //debug ($model->PersonID);
                            $person = Person::model()->findByPk($model->PersonID);
                            echo CJSON::encode(array("result"=>"success","data" =>
                                 $this->renderPartial("//person/tabs/_spec", array('models'=>$person->specs,'personid'=>$model->PersonID), true)
                            ));
                            Yii::app()->end();
                        }
		}                   
                            //$link = Yii::app()->user->getEdboSearchUrl().Yii::app()->params["documentSearchURL"];
                            //debug($link);
                            //print "<script type=\"text/javascript\">prompt('Введдіть ЄДБО Кодi!');</script>";
                            //$client = new EHttpClient($link, array('maxredirects' => 30, 'timeout'=> 30,));
                            //$client->setParameterPost($_GET);
                            //$response = $client->request(EHttpClient::POST);
                $searchRes = array();            
                $searchRes = $model->loadOnlineStatementFromJSON($spec);
                $user = Yii::app()->user->getUserModel();
                if($user->syspk->SpecMask == "1"){
                $this->renderPartial('_Modal_electron', array('model'=>$model,'spec'=>$spec));
                }
                else{
		$this->renderPartial('_Modal_electron_error', array('model'=>$model));
                } 
        }
        
        public function actionRefresh($id){
            $this->renderPartial("//person/tabs/_spec",array('personid'=>$id));
        }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
       
	public function actionUpdate($id)
	{
             
		$model=$this->loadModel($id);
              
                $valid = true;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_GET['Personspeciality'])) {   
                    
                        $renderForm = "_form";
			//if (isset($_GET['Personspeciality']['GraduatedUniversitieID'])){
                        //debug($model->SepcialityID);
                        if (!empty($_GET['Personspeciality']['QualificationID']) && $_GET['Personspeciality']['QualificationID'] > 1 && $model->SepcialityID != 70686 && $model->SepcialityID != 90661){
                            $model->scenario ="SHORTFORM";
                            $renderForm = "_formShort";
                            $model->CausalityID = 100;
                        }
			$model->attributes=$_GET['Personspeciality'];
                       
                        if (intval($model->EntranceTypeID) == 1){
                            $model->Exam1ID = null; $model->Exam1Ball = null;
                            $model->Exam2ID = null; $model->Exam2Ball = null;
                            $model->Exam3ID = null; $model->Exam3Ball = null;
                            $model->CausalityID = null;
                           
                        } elseif (intval($model->EntranceTypeID) == 2){
                            $model->DocumentSubject1 = null;
                            $model->DocumentSubject2 = null;
                            $model->DocumentSubject3 = null;
                        } 
                        $valid  = $model->validate() && $valid;
                       try { 
                            if (!$valid){
                                echo CJSON::encode(array("result"=>"error","data" =>
                                $this->renderPartial($renderForm, array('model'=>$model),true)));
                                Yii::app()->end();
                            } else {
                                if($model->save())
                                    $person = Person::model()->findByPk($model->PersonID);
                                    echo CJSON::encode(array("result"=>"success","data" =>
                                         $this->renderPartial("//person/tabs/_spec", array('models'=>$person->specs,'personid'=>$model->PersonID), true)
                                    ));
                                Yii::app()->end();
                            }
                       } catch (Exception $e) {
                            echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                            Yii::app()->end();
                       }
		}

		$this->renderPartial('_Modal', array('model'=>$model,'personid'=>$model->PersonID));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{       
                try{
                    $model = $this->loadModel($id);
                    $personid = $model->PersonID;
                    if (empty($model->edboID)) {
                          if ($model->QualificationID > 1 && $model->SepcialityID != 70686 && $model->SepcialityID != 90661){
                                $model->scenario ="SHORTFORM";
                                $model->CausalityID = 100;
                          }
                          $model->StatusID = 10;
                          if (!$model->save()) {
                              debug(print_r($model->getErrors(),true));
                          }
                       
                    } else {
                        Yii::app()->user->setFlash("message","Заборонено видаляти заявку!");
                    }
                    $person = Person::model()->findByPk($personid);
                    echo CJSON::encode(array("result"=>"success","data" =>$this->renderPartial("//person/tabs/_spec", array('models'=>$person->specs,'personid'=>$personid),true)));
                } catch (CHttpException $e) {
                     echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                } catch (Exception $e) {
                    echo CJSON::encode(array("result"=>"error","data" =>"Дія заборонена!"));
                } 
                
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Personspeciality');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personspeciality('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personspeciality']))
			$model->attributes=$_GET['Personspeciality'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        /**
         * Обновление цены за обучение
         * @param type $id
         */
        public function actionStudupdate($id)
	{       
            $model=$this->loadModel($id);
            $valid = true;
        if (isset($_POST['Personspeciality'])) {
                    $model->attributes = $_POST['Personspeciality'];
                    $valid = $model->validate() && $valid;
                    
            try {
                if ($model->save())
                $model=new PersonSpecialityView('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PersonSpecialityView']))
		$model->attributes=$_GET['PersonSpecialityView'];
                //$person = PersonSpecialityView::model()->findByPk($model->idPersonSpeciality);
                echo CJSON::encode(array("result" => "success", "data" =>
                    $this->renderPartial("//prices/tabs/_studprice", array('model' =>$model),true)
                ));
                Yii::app()->end();
            } catch (Exception $e) {
                echo CJSON::encode(array("result" => "error", "data" => $e->getMessage()));
                Yii::app()->end();
            }
        }
            $this->renderPartial('_studpriceModal', array('model' => $model, 'personid' => $model->idPersonSpeciality));   
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Personspeciality::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        public function actionSpecialitys($idFacultet, $idEducationForm,$QualificationID)
        {
//            $data = Specialities::model()->findAll('FacultetID=:FacultetID',
//                          array(':FacultetID'=>(int) $idFacultet));
//
//            $data=CHtml::listData($data,'idSpeciality','SpecialityName');
//            echo CHtml::tag('option', array('value'=>""), "", true);
            $data = Specialities::DropDownMask1($idFacultet, $idEducationForm,$QualificationID);
             echo CHtml::tag('option', array('value'=>""), "", true);
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
            }
        }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personspeciality-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
