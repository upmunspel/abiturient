<?php

class SpecialitysubjectsController extends Controller
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
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','delete','create','update','view','index'),
				'roles'=>array('Root',"Admins"),
			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete','update'),
//				'roles'=>array('Root',"Admins"),
//			),
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
		$models=array();
                $spec=0;
                $valid = true;
                for($i=1; $i<=3; $i++) {
                    $model = new Specialitysubjects();
                    $model->LevelID = $i;
                    $models[] = $model;
                }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Specialitysubjects']))
		{
//                    echo '<br>'; echo '<br>'; echo '<br>';
//                    echo '<pre>';
//                    var_dump($_POST);
//                    echo '</pre>';
                    $spec = $_POST['SpecialityID'];
                    foreach($models as $i=>$model) {
                       $model->attributes=$_POST['Specialitysubjects'][$i];
                       $model->SpecialityID = $spec;
                       $valid = $model->validate() && $valid;
                    }
                    if ($valid){
                        foreach($models as $i=>$model) {
                            if (empty( $model->SubjectID)) continue;
                            $subj = $model->SubjectID;
                            foreach ($model->SubjectID as $sub){
                                $tm = new Specialitysubjects();
                                $tm->SpecialityID = $spec;
                                $tm->SubjectID = $sub;
                               
                                $tm->LevelID = $model->LevelID;
                                $tm->save();
                            }
                        }
                        $this->redirect(array('admin'));
                    }
//			$model->attributes=$_POST['Specialitysubjects'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'models'=>$models,'SpecialityID'=>$spec,
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

		if(isset($_POST['Specialitysubjects']))
		{
			$model->attributes=$_POST['Specialitysubjects'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Specialitysubjects');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Specialitysubjects('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Specialitysubjects']))
			$model->attributes=$_GET['Specialitysubjects'];

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
		$model=Specialitysubjects::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='specialitysubjects-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
