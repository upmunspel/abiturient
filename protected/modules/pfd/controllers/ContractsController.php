<?php

class ContractsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column1';
        public $defaultAction='index';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
            
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions' => array('index', 'view', 'admin', 'delete', 'create', 'update', "ajaxcreate", "ajaxupdate","Specialitys","Editprice"),
                            'roles' => array("Root", "Admin","PriceOperator"),
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
	{   $this->layout='/layouts/column2_1';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($specid)
	{
                $model = Contracts::model()->find("PersonSpecialityID = $specid");
                if (!empty($model)) $this->redirect (Yii::app()->createUrl ("pfd/contracts/update",array("id"=>$model->idContract )));
            
                $model=new Contracts;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $this->layout='/layouts/column2_1';
		if(isset($_POST['Contracts']))
		{
			$model->attributes=$_POST['Contracts'];
			if($model->save())
				$this->redirect(Yii::app()->createUrl('pfd/contracts/view',array('id'=>$model->idContract)));

		}
		$this->render('create',array('model'=>$model,'specid'=>$specid));
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
                $this->layout='/layouts/column2_1';
		if(isset($_POST['Contracts']))
		{
			$model->attributes=$_POST['Contracts'];
			if($model->save())
				$this->redirect(Yii::app()->createUrl('pfd/contracts/view',array('id'=>$model->idContract)));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $model=new PersonSpecialityView('search');
	    $model->unsetAttributes();  // clear any default values
	    if(isset($_GET['PersonSpecialityView'])) {
                $model->attributes=$_GET['PersonSpecialityView'];
            } 
            $this->render('_personlist',array("model"=>$model));
            
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout='/layouts/column2_1';
		$model=new Contracts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contracts']))
			$model->attributes=$_GET['Contracts'];

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
		$model=Contracts::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contracts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
