<?php

class PersonbenefitsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'ajaxOnly + Create, Update, Delete, Refresh, Edboupdate',
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
				'actions'=>array(),//'index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create, Refresh, Edboupdate'),//,'update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        /**
         * actionEdboupdate - запрос на синхронизацию документов
         * @param type $personid
         */
        public function actionEdboupdate($personid){
            try {
                $link = Yii::app()->user->getEdboSearchUrl().":8080/PersonSearch/personbenefitsaddedbo.jsp";
                
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
                
                echo CJSON::encode(array("result"=>"success","data" =>""));
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($personid)
	{
		$model=new Personbenefits;
                $model->PersonID = intval($personid);
                $valid = true;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personbenefits']))
		{
			
                        
                        $model->attributes = $_POST["Personbenefits"];
                        $valid  = $model->validate() && $valid;
                        if ($valid && $model->save()){
                            $person = Person::model()->findByPk($model->PersonID);
                            echo CJSON::encode(array("result"=>"success","data" =>
                            $this->render("//person/tabs/_benefits", array('models'=>$person->benefits,"personid"=>$model->PersonID), true)
                            ));
                        } else {
                            echo CJSON::encode(array("result"=>"error","data" =>
                            $this->render('_form', array('model'=>$model),true)));

                        }
                        Yii::app()->end();
		}

		$this->renderPartial('_Modal',array(
                            'model'=>$model,
                             true,true
                ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personbenefits']))
		{
			$model->attributes=$_POST['Personbenefits'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idPersonBenefits));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            
              try
                {
                    $model=$this->loadModel($id); 
                    $model->delete();
                    $person = Person::model()->findByPk($model->PersonID);
                    echo CJSON::encode(array("result"=>"success","data" =>
                            $this->render("//person/tabs/_benefits", array('models'=>$person->benefits,"personid"=>$model->PersonID), true)
                            ));
                } catch (CHttpException $e) {
                     echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                }  
                catch (Exception $e) {
                     echo CJSON::encode(array("result"=>"error","data" =>"Дія заборонена!"));
                } 
                
//		if(Yii::app()->request->isPostRequest)
//		{
//			// we only allow deletion via POST request
//			$this->loadModel($id)->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionRefresh($id)
	{
		 $person = Person::model()->findByPk($id);
                 $this->renderPartial("//person/tabs/_benefits", array('models'=>$person->benefits,"personid"=>$id));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personbenefits('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personbenefits']))
			$model->attributes=$_GET['Personbenefits'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Personbenefits::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personbenefits-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
