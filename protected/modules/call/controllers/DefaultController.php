<?php

class DefaultController extends Controller
{
  /**
   * @var string the default layout for the views. Defaults to '//layouts/main', meaning
   * using main layout. See 'protected/views/layouts/main.php'.
   */
  public $layout='//layouts/main';
  public $defaultAction='index';

  /**
   * Filters.
   * @return array action filters
   */
  public function filters(){
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
  public function accessRules(){
    return array(
      array('allow', // allow users with admin privileges to perform all CRUD actions
        'actions' => array('view', 'create', 'update', 'admin', 'delete', 
           'datauploader', 'upload', 'deletecsv', 'index'),
        'users' => array('@'),
      ),
      array('deny', // deny all users
        'users' => array('*'),
      ),
    );
  }
  
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $model=new PersonContactsView('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PersonContactsView']))
			$model->attributes=$_GET['PersonContactsView'];
                //$this->layout='//layouts/main_empty';
		$this->render('index',array(
			'model'=>$model,
		));
	}
  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
   /* $reqEdboData = Yii::app()->request->getPost('EdboData',null);
    $model = new EdboData;
    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(is_array($reqEdboData)){
      $model->attributes = $reqEdboData;
      if ($model->save()){
        $this->redirect(array('view','id' => $model->ID));
      }
    }

    $this->render('create',array(
      'model' => $model,
    ));*/
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id){
    /*$reqEdboData = Yii::app()->request->getPost('EdboData',null);
    $model=$this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(is_array($reqEdboData)){
      $model->attributes = $reqEdboData;
      if($model->save()){
        $this->redirect(array('view','id'=>$model->ID));
      }
    }

    $this->render('update',array(
      'model'=>$model,
    ));*/
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id){
   /* $this->loadModel($id)->delete();

    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    if(!isset($_GET['ajax'])){
      $this->redirect( isset($_POST['returnUrl']) ? 
        $_POST['returnUrl'] : array('admin') );
    }*/
  }

  /**
   * Manages all models.
   */
  public function actionAdmin(){
    /*$reqEdboData = Yii::app()->request->getParam('EdboData');
    $model = new EdboData('search');
    $model->unsetAttributes();  // clear any default values
    if(is_array($reqEdboData)){
      $model->attributes = $reqEdboData;
    }
    $this->render('admin',array(
      'model'=>$model,
    ));*/
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id){
   /* $model = EdboData::model()->findByPk($id);
    if ($model === null){
      throw new CHttpException(404,'Помилка. Екземпляр класу EdboData з ID '.$id.' не інсує.');
    }
    return $model;*/
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model){
    $reqAjax = Yii::app()->request->getPost('ajax',null);
    if($reqAjax === 'edbo-data-form'){
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
  
  
  
  

}
