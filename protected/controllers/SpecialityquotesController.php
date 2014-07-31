<?php

class SpecialityquotesController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
  public $defaultAction='admin';

	/**
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
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
            'actions' => array('index', 'update', 'create', 
              'delete', 'view', 'admin', 'xedit'),
            'roles' => array('Root', 'Admin'),
        ),
        array('deny', // deny all users
            'users' => array('*'),
        ),
    );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
  public function actionRefresh($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
		$model=new Specialityquotes;
		if(isset($_POST['Specialityquotes'])){
			$model->attributes=$_POST['Specialityquotes'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->idSpecialityQuotes));
      }
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
	public function actionUpdate($id){ 
    $model=$this->loadModel($id);
		if(isset($_POST['Specialityquotes'])){
			$model->attributes=$_POST['Specialityquotes'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->idSpecialityQuotes));
      }
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
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex(){
		$dataProvider=new CActiveDataProvider('Specialityquotes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin(){
		$model=new Specialityquotes('search');
    $model->unsetAttributes();
		if(isset($_GET['Specialityquotes'])){
			$model->attributes=$_GET['Specialityquotes'];
    }
    if (isset($_POST['SpecialityQuotesCreate'])){
      $cres = Specialityquotes::model()->count('SpecialityID='.$_POST['Specialityquotes']['SpecialityID']
        .' AND QuotaID='.$_POST['Specialityquotes']['QuotaID']);
      if (!$cres){
        $cmodel = new Specialityquotes();
        $cmodel->attributes=$_POST['Specialityquotes'];
        if (!$cmodel->save()){
          $model->addErrors($cmodel->errors);
        }
      } else {
        $model->addError('SpecialityID', 'Повторення даних: квота і спеціальність. Це заборонено.');
        $model->addError('QuotaID', 'Повторення даних: квота і спеціальність. Це заборонено.');
      }
    }
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id){
		$model=Specialityquotes::model()->findByPk($id);
		if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
    }
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='specialityquotes-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
  
  /**
   * Updates a particular record by EditableColumn's saver.
   */
  public function actionXedit(){
    Yii::import('bootstrap.widgets.TbEditableSaver');
//    $reqField = Yii::app()->request->getParam('field',null);
//    $reqValue = Yii::app()->request->getParam('value',null);
//    $reqId = Yii::app()->request->getParam('pk',null);
    $es = new TbEditableSaver('Specialityquotes'); 
    $es->update();
  }
}
