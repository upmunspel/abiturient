<?php

class PersonController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','admin','create'),
				'roles'=>array('Admins'),
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','admin','delete','create','update', "ajaxcreate","ajaxupdate"),
				'roles'=>array("Root","Admin"),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
        public function actionCreate()
	{
            
		$model=new Person;
               
                $model->Birthday= date("d.m.Y",mktime(0, 0, 0, 1, 1, date('Y')-18));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Person'])){
                        $model->attributes=$_POST['Person'];
                        if(isset($_POST['Documents']['persondoc'])){
                            $model->persondoc->attributes=$_POST['Documents']['persondoc'];
                        }
                        if(isset($_POST['Documents']['entrantdoc'])){
                            $model->entrantdoc->attributes=$_POST['Documents']['entrantdoc'];
                        }
                        if(isset($_POST['Documents']['inndoc'])){
                            $model->inndoc->attributes=$_POST['Documents']['inndoc'];
                        }
                        if(isset($_POST['Documents']['hospdoc'])){
                            $model->hospdoc->attributes=$_POST['Documents']['hospdoc'];
                        }
                        if(isset($_POST['PersonContacts']['homephone'])){
                            $model->homephone->attributes=$_POST['PersonContacts']['homephone'];
                        }
                        if(isset($_POST['PersonContacts']['mobphone'])){
                            $model->mobphone->attributes=$_POST['PersonContacts']['mobphone'];
                        }
                        
			if($model->save()
                                && $model->persondoc->validate() 
                                && $model->entrantdoc->validate()
                                && $model->inndoc->validate() 
                                && $model->hospdoc->validate()
                                && $model->homephone->validate() 
                                && $model->mobphone->validate()){
                            $model->persondoc->PersonID = $model->idPerson;
                            $model->entrantdoc->PersonID = $model->idPerson;
                            $model->inndoc->PersonID = $model->idPerson;
                            $model->hospdoc->PersonID = $model->idPerson;
                            $model->homephone->PersonID = $model->idPerson;
                            $model->mobphone->PersonID = $model->idPerson;
                            
                            $model->persondoc->save();
                            $model->entrantdoc->save();
                            $model->inndoc->save();
                            $model->hospdoc->save();
                            $model->homephone->save();
                            $model->mobphone->save();
                              
                            $this->redirect(array('view','id'=>$model->idPerson));
                             
                        }
		}
              
                $this->render('create',array('model'=>$model,));
	}

	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
               
                //var_dump($_POST);
                //var_dump($model);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Person'])){
			$model->attributes=$_POST['Person'];
                        if(isset($_POST['Documents']['persondoc'])){
                            $model->persondoc->attributes=$_POST['Documents']['persondoc'];
                            $model->persondoc->PersonID = $model->idPerson;
                        }
                        if(isset($_POST['Documents']['entrantdoc'])){
                            $model->entrantdoc->attributes=$_POST['Documents']['entrantdoc'];
                            $model->entrantdoc->PersonID = $model->idPerson;
                        }
                         if(isset($_POST['Documents']['inndoc'])){
                            $model->inndoc->attributes=$_POST['Documents']['inndoc'];
                            $model->inndoc->PersonID = $model->idPerson;
                        }
                         if(isset($_POST['Documents']['hospdoc'])){
                            $model->hospdoc->attributes=$_POST['Documents']['hospdoc'];
                            $model->hospdoc->PersonID = $model->idPerson;
                        }
                        if(isset($_POST['PersonContacts']['homephone'])){
                            $model->homephone->attributes=$_POST['PersonContacts']['homephone'];
                            $model->homephone->PersonID = $model->idPerson;
                        }
                        if(isset($_POST['PersonContacts']['mobphone'])){
                            $model->mobphone->attributes=$_POST['PersonContacts']['mobphone'];
                            $model->mobphone->PersonID = $model->idPerson;
                        }
                        
                        if ($model->validate()
                                && $model->persondoc->validate() 
                                && $model->entrantdoc->validate()
                                && $model->inndoc->validate() 
                                && $model->hospdoc->validate()
                                && $model->homephone->validate() 
                                && $model->mobphone->validate()){
                            
                           if ($model->save()){
                               
                                    $model->persondoc->save();
                                    $model->entrantdoc->save();
                                    $model->inndoc->save();
                                    $model->hospdoc->save();
                                    $model->homephone->save();
                                    $model->mobphone->save();
                            }
                               
                            $this->redirect(array('view','id'=>$model->idPerson));
                                
                        }
                        
		}
                
                $this->render('update',array('model'=>$model,));
                
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Person');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
            $model=new Person('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Person']))
			$model->attributes=$_GET['Person'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Person('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Person']))
			$model->attributes=$_GET['Person'];

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
		$model=Person::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='person-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
