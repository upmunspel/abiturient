<?php

class DocumentsController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'ajaxOnly + newZno, newZnoSubject, appendZno, delZno, delZnoSubject,
                                    editZno, Create, Update, Delete, Edboupdate, Refresh, Refreshzno',
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
				'actions'=>array(   'newZno',
                                                    'newZnoSubject', 
                                                    'appendZno',
                                                    'delZno',
                                                    'delZnoSubject',
                                                    'editZno',
                                                    'Create',
                                    'Update',"Delete, Edboupdate, Refresh, Refreshzno"
                                                ),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Documents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        /**
         * actionEdboupdate - запрос на синхронизацию документов
         * @param type $personid
         */
        public function actionEdboupdate(){
          
          if (isset($_GET['personid'])){
                try {
                    $personid = $_GET['personid'];

                    $link = Yii::app()->user->getEdboSearchUrl().":8080/PersonSearch/persondocumentsaddedbo.jsp";

                    $client = new EHttpClient($link, array('maxredirects' => 30, 'timeout' => 30,));

                    $client->setParameterPost(array("personIdMySql"=>$personid));
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
            } else if (isset($_GET['docid'])){
                
                try {
                    $id = $_GET['docid'];

                    $link = Yii::app()->user->getEdboSearchUrl().":8080/PersonSearch/editdocumentedbo.jsp";

                    $client = new EHttpClient($link, array('maxredirects' => 30, 'timeout' => 30,));

                    $client->setParameterPost(array("documentIdMySql"=>$id));
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
                
            }
                
            echo CJSON::encode(array("result"=>"success","data" =>""));
        }
        public function actionCreate($personid)  {   
                $model = new Documents("FULLINPUT");
                $model->PersonID = $personid;
                $valid = true;
              
                if (isset($_POST["Documents"])){
                    $model->attributes = $_POST["Documents"];
                    $valid  = $model->validate() && $valid;
                    if ($valid && $model->save()){
                        //$person = Person::model()->findByPk($model->PersonID);
                        echo CJSON::encode(array("result"=>"success","data" =>
                        $this->render("//person/tabs/_doc", array('personid'=>$model->PersonID), true)
                        ));
                    } else {
                        echo CJSON::encode(array("result"=>"error","data" =>
                        $this->render('_formfull', array('model'=>$model),true)));
                        
                    }
                    Yii::app()->end();
                }
                
                $this->renderPartial('_docModal',array(
                            'model'=>$model,
                             true,true
                ));
            }
       /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
        public function actionRefresh($id)
	{  
		
		$this->renderPartial('//person/tabs/_doc',array('personid'=>$id ));
              
	} 
        public function actionRefreshzno($id)
	{  
		$model = Person::model()->findByPk($id);
		$this->renderPartial("//person/tabs/_zno",array("models"=>$model->znos, 'personid'=>$model->idPerson));
              
	} 
	public function actionUpdate($id)
	{  
		$model=$this->loadModel($id);
                $valid = true;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $model->scenario = "FULLINPUT";
		if(isset($_POST['Documents']))
		{
			$model->attributes=$_POST['Documents'];
                        
                        $valid  = $model->validate() && $valid;
			try {
                        if ($valid && $model->save()){
                            $person = Person::model()->findByPk($model->PersonID);
                            $str = $this->renderPartial("//person/tabs/_doc", array('models'=>$person->znos,'personid'=>$model->PersonID), true);
                            //$str = $this->renderPartial("//person/tabs/_zno", array("model"=>$model "personid"=>$model->PersonID),true);
                            //echo CJSON::encode($str);
                            echo CJSON::encode(array("result"=>"success","data" =>$str));
                        } else {
                            echo CJSON::encode(array("result"=>"error","data" =>
                            $this->renderPartial('_formfull', array('model'=>$model),true)));

                        }
                        } catch (Exception $e) {
                             echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                        }
                        //Yii::app()->end();
		} else {

		$this->renderPartial('_docModal',array(
                            'model'=>$model,
                             true,true
                ));
                }
	} 
        
         public function actionDelete($id)  {   
            
                try
                {
                    $model=$this->loadModel($id); 
                    $model->delete();
                    echo CJSON::encode(array("result"=>"success","data" =>
                    $this->renderPartial("//person/tabs/_doc", array('personid'=>$model->PersonID), true)));
                } catch (CHttpException $e) {
                     echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                }  
                catch (Exception $e) {
                     echo CJSON::encode(array("result"=>"error","data" =>"Дія заборонена!"));
                } 
            }     
            
        public function actionNewZno($personid)  {   
                $model = new Documents('ZNO');
                $model->PersonID = $personid;
                $subjects=array();
                $this->renderPartial('_znoModal',array(
                            'model'=>$model,
                            'subjects'=>$subjects,true,true
                ));
            }
            
        public function actionNewZnoSubject()  {   
                $model = new Documents('ZNO');
                $subjects = array();
                $valid = true;
                $subjectCount = 0;
                if (isset($_GET["Documents"])){
                    $model->attributes = $_GET["Documents"];
                    $model->validate();
                }
                $dateget = "";
                if (isset($_GET["Documentsubject"])){
                       
//                         foreach ($_GET["Documentsubject"] as $i=>$obj){
//                             if ($obj['deleted']!=0) $subjectCount++;
//                         }
                        
                        foreach ($_GET["Documentsubject"] as $obj){
                          
                            $subjectid = $obj["idDocumentSubject"];
                            if (!empty($subjectid) && $subjectid > 0){
                               $item = $this->loadSubjects($subjectid);
                            } else {
                               $item = new Documentsubject();  
                                
                            }
                            $item->attributes = $obj;
                            if ($item->deleted == 0){
                                $valid = $item->validate() && $valid ;
                                $subjectCount++;
                            }  
                            $subjects[] = $item;
                            $dateget = $item->DateGet;
                            
                        }
                }
                //debug( $subjectCount);
                if ($valid &&  $subjectCount < 5) {
                    
                    $tm = new Documentsubject();
                    $tm->DateGet = $dateget;
                    $subjects[] = $tm;
                }
                
                $this->renderPartial('_form',array(
                            'model'=>$model,
                            'subjects'=>$subjects, 
                ));
            } 
       
        public function actionDelZnoSubject($num)  {   
                $model = new Documents('ZNO');
                $subjects = array();
                $valid = true;
                if (isset($_GET["Documents"])){
                    $model->attributes = $_GET["Documents"];
                    $model->validate();
                }
                
                if (isset($_GET["Documentsubject"])){
                        unset($_GET["Documentsubject"][$num]); 
                        foreach ($_GET["Documentsubject"] as $i=>$obj){
                            $item = new Documentsubject();
                            $item->attributes = $obj;
                            if ($i==$num){
                                $item->deleted = 1;
                            }
                            if ($item->deleted == 0){
                                $valid = $item->validate() && $valid ;
                            }
                            $subjects[] = $item;
                            
                        }
                } 
                
                $this->renderPartial('_form',array(
                            'model'=>$model,
                            'subjects'=>$subjects, 
                ));
            }     
        
        protected function loadDocuments($documentid){
                $model = Documents::model()->findByPk($documentid);
                if (empty($model)){
                    throw new Exception("Документ (id = $documentid) не знайдено!");
                }
                $model->scenario = "ZNO";
                return $model;
        }
        protected function loadSubjects($subjectid){
                $model = Documentsubject::model()->findByPk($subjectid);
                if (empty($model)){
                    throw new Exception("Предмет (id = $subjectid) не знайдено!");
                }
                return $model;
        }
        public function actionAppendZno(){
            
            $model = new Documents('ZNO');
            $model->TypeID = 4;
            $subjects = array();
            $valid = true;
            if (isset($_GET["Documents"])){
                $documentid = $_GET["Documents"]['idDocuments'];
                unset($_GET["Documents"]['idDocuments']);
                if (!empty($documentid)) {
                    $model=$this->loadDocuments($documentid);
                }
                $model->attributes = $_GET["Documents"];
                $valid  = $model->validate() && $valid;
            }
            // Удаление предметов
            try {
                if (isset($_GET["Documentsubject"])){
                        foreach ($_GET["Documentsubject"] as $i=>$obj){
                            $subjectid = $obj["idDocumentSubject"];
                            unset($obj["idDocumentSubject"]);
                            if (!empty($subjectid) && $subjectid > 0){
                               $item = $this->loadSubjects($subjectid);
                            } else {
                               $item = new Documentsubject();  
                            }
                            $item->attributes = $obj;
                            if ($item->deleted == 0){
                                $valid = $item->validate() && $valid ;
                                $subjects[] = $item;
                            } else {
                                if (!$item->isNewRecord) $item->delete();
                            }

                        }
                } 
            } catch (CHttpException $e) {
                  echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                  Yii::app()->end();
            } catch (Exception $e) {
                  echo CJSON::encode(array("result"=>"error","data" =>"Дія заборонена!"));
                  Yii::app()->end();
            }
            
            // Сохранение предметов 
            
            if (!$valid){
                echo CJSON::encode(array("result"=>"error","data" =>
                $this->renderPartial('_form', array('model'=>$model,'subjects'=>$subjects),true)));
            } else {
                /* save all new records */
                $flag = $transaction = Yii::app()->db->getCurrentTransaction();
                if ($transaction === null)
                {
                    $transaction = Yii::app()->db->beginTransaction();
                }
                try
                {
                   if ($model->save()){
                       foreach ($subjects as $subject){
                           $subject->DocumentID = $model->idDocuments;
                           if ($subject->deleted == 0){
                                if (!$subject->save()){
                                    throw new Exception("Помилка збереження даних!");
                                }
                            } else {
                                if (!$subject->delete()){
                                    throw new Exception("Помилка видалення даних!");
                                }
                            }
                       }
                   }
                   $transaction->commit();
                   $person = Person::model()->findByPk($model->PersonID);
                   echo CJSON::encode(array("result"=>"success","data" =>
                        $this->renderPartial("//person/tabs/_zno", array('models'=>$person->znos,'personid'=>$model->PersonID), true)
                        ));
                } catch (Exception $e) {
                    if ($flag !== null)
                    {
                        $transaction->rollback();
                       
                    }
                    echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                   
                }
               
                
            };
            
        } 
        
        public function actionDelZno($documentid){   
            $flag = $transaction = Yii::app()->db->getCurrentTransaction();
            if ($transaction === null){
                $transaction = Yii::app()->db->beginTransaction();
            }
            
            try
            {
                $document = Documents::model()->findByPk($documentid);
                
                if (!empty($document)){
                    $document->delete();
                } else {
                    throw new CHttpException(404,"Документ (documentID = $documentid) не знайдено!");
                }
                $personid = $document->PersonID;
                $transaction->commit();
                $person = Person::model()->findByPk($personid);
                echo CJSON::encode(array("result"=>"success","data" => $this->renderPartial("//person/tabs/_zno", array('models'=>$person->znos,'personid'=>$personid),true)));
            } catch (CHttpException $e) {
                if ($flag !== null) {
                        $transaction->rollback();
                 }
                 echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                 
            } catch (Exception $e) {
                    if ($flag !== null) {
                        $transaction->rollback();
                    }
                    echo CJSON::encode(array("result"=>"error","data" =>"Дія заборонена!"));
            } 
	}
        
        public function actionEditZno($documentid)  {   
                $model = Documents::model()->findByPk($documentid);
                if (empty($model)) throw new Exception("Документ (id = $documentid) не знайдено!");
                $model->scenario = "ZNO";
                $personid = $model->PersonID;
                
                $this->renderPartial('_znoModal',array(
                            'model'=>$model,
                            'subjects'=>$model->subjects,
                            'personid'=>$personid,true,true
                ));
            }
        
}
