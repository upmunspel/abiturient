<?php

class PricesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='/layouts/column2_1';
    public $defaultAction='admin';

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
    public function actionSpeciality($idPrices, $idEducationForm)
        {
            echo CHtml::tag('option', array('value'=>""), "", true);
            $data = Specialities::DropDownMask($idFacultet, $idEducationForm);
             echo CHtml::tag('option', array('value'=>""), "", true);
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
            }
        }
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            /* array('allow',  // allow all users to perform 'index' and 'view' actions
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
              ), */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('stat','index', 'view', 'admin', 'delete', 'create', 'update', "ajaxcreate", "ajaxupdate","Specialitys","Specialitys_stat","Editprice"),
                'roles' => array("Root", "Admin","PriceOperator"),
            ),
            array('deny',  // deny all users
				'users'=>array('*'),
			),
                );
                
    }
//
//    /**
//     * Displays a particular model.
//     * @param integer $id the ID of the model to be displayed
//     */
//    public function actionView($id)
//    {
//        $this->render('view',array(
//            'model'=>$this->loadModel($id),
//        ));
//    }
//
//    /**
//     * Creates a new model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     */
//    public function actionCreate()
//    {
//        $model=new Prices;
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if(isset($_POST['Prices']))
//        {
//            $model->attributes=$_POST['Prices'];
//            if($model->save())
//                $this->redirect(array('view','id'=>$model->idPrice));
//        }
//
//        $this->render('create',array(
//            'model'=>$model,
//        ));
//    }
//
//    /**
//     * Updates a particular model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id the ID of the model to be updated
//     */
//    public function actionUpdate($id)
//    {
//        $model=$this->loadModel($id);
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//        if(isset($_POST['Prices']))
//        {
//            $model->attributes=$_POST['Prices'];
//            if($model->save())
//                $this->redirect(array('view','id'=>$model->idPrice));
//        }
//
//        $this->render('update',array(
//            'model'=>$model,
//        ));
//    }
//
//    /**
//     * Deletes a particular model.
//     * If deletion is successful, the browser will be redirected to the 'admin' page.
//     * @param integer $id the ID of the model to be deleted
//     */
//    public function actionDelete($id)
//    {
//        $this->loadModel($id)->delete();
//
//        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if(!isset($_GET['ajax']))
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//    }
//
//    /**
//     * Lists all models.
//     */
//    public function actionIndex()
//    {
//		$model=new PersonSpecialityView('search');
//		$model->unsetAttributes();  // clear any default values
//		if(isset($_GET['PersonSpecialityView']))
//		$model->attributes=$_GET['PersonSpecialityView'];
//
//		$this->render('index',array('model'=>$model));
//    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Facultets('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Facultets']))
            $model->attributes=$_GET['Facultets'];
        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    public function actionStat()
    {
        $model=new Facultets('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Facultets']))
            $model->attributes=$_GET['Facultets'];
        $this->render('stat',array(
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
        $model=Prices::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    public function actionPricesubjects($personid){
    $model=new Prices;
    if(isset($_POST['Prices'])){
        $model->attributes = $_POST['Prices'];
        $model->AcademicSemesterID = intval($personid);
    }
    $this->renderPartial("_subjects_holder", array('model'=>$model, 'specialityid'=>$model->AcademicSemesterID));
    }
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='prices-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    
    public function actionSpecialitys($id){
	
        
        	$model=new Specialities('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Specialities']))
		$model->attributes=$_GET['Specialities'];
                $this->renderPartial('_relational',  array('model'=>$model,'id'=>$id), false, true);
    }
   public function actionSpecialitys_stat($id){
	
        
        	$model=new Specialities('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Specialities']))
		$model->attributes=$_GET['Specialities'];
                $this->renderPartial('_relational_stat',  array('model'=>$model,'id'=>$id), false, true);
    }
    public function actionEditprice(){
        
        if (isset($_POST["pk"])){
            $model = Specialities::model()->findByPk($_POST["pk"]);
            if (!empty($model)){
               $model->{$_POST["name"]} = $_POST["value"];
               if (!$model->save()) {
                   //echo $model->getError($_POST["name"]);
                   throw new CHttpException(404, $model->getError($_POST["name"]));
               }
            }
        }
        
    }
    
    
}