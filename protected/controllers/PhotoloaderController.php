<?php

class PhotoloaderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
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
			array('allow',  // allow all users to perform  actions
				'actions'=>array('index', 'update'),
				'roles'=>array('Root', 'PhotoOperator'),
			),
                        /*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('contact'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','logout'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),*/
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
		$model=new Personsextypes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PersonSexTypes']))
		{
			$model->attributes=$_POST['PersonSexTypes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idPersonSexTypes));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{      try {
                $model=$this->loadModel($id);
                $model->scenario = "PHOTO";
		if(isset($_POST['Person']))
		{       $oldPhoto = $model->PhotoName;
                        $model->PhotoName = $_POST['Person']['PhotoName'];
                       
                        if ($model->validate()){
                            $file = CUploadedFile::getInstance($model,'PhotoName');
                            $path = Yii::app()->basePath."/..".Yii::app()->params['photosPath'];
                            $bigpath = Yii::app()->basePath."/..".Yii::app()->params['photosBigPath'];
                            $img = EWideImage::loadFromFile($file->getTempName());
                            if ( $img->getWidth() < $img->getHeight() ) {       
                                $img ->resize(120,null)->crop("center", "middle", 120, 150)->saveToFile($path."person_$id.jpg");
                                $img ->resize(180,null)->crop("center", "middle", 180, 225)->saveToFile($bigpath."person_$id.jpg");
                            } else {
                                $img ->resize(null,150)->crop("center", "middle", 120, 150)->saveToFile($path."person_$id.jpg");
                                $img ->resize(null,225)->crop("center", "middle", 180, 225)->saveToFile($bigpath."person_$id.jpg");
                            }
                            //unlink($file->getTempName());
                            $model->PhotoName = "person_$id.jpg";
                            if ($model->save()){
                                $this->redirect(array('update','id'=>$model->idPerson,'r'=>md5(time())));
                            }
                        } else {
                            $model->PhotoName = $oldPhoto;
                        }
		}
                $this->render('update',array(
			'model'=>$model,
		));
                Yii::app()->end();
             } catch (Exception $e) {
                Yii::app()->user->setFlash("message","Абітуріент із кодом '$id' відсутній у системі!");
                $this->redirect(Yii::app()->createUrl("photoloader"));
	     } 
         
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
		$model=new Person('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Person']))
			$model->attributes=$_GET['Person'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personsextypes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PersonSexTypes']))
			$model->attributes=$_GET['PersonSexTypes'];

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
		if(isset($_POST['ajax']) && $_POST['ajax']==='person-sex-types-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
