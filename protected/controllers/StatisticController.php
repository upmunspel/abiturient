<?php

class StatisticController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
        public $defaultAction='index';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + ', // we only allow deletion via POST request
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'View', 'Print', "Sverka"),
				'users'=>array('@'),
			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('@'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('index','view','admin','create'),
//				'roles'=>array('Admins'),
//			),*/
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('index','view','admin'),
//				'roles'=>array("Root","Admins","Operators"),
//			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        public function actionView()
	{
                $this->layout='//layouts/clear';
		$this->render('statistic');
	}
        public function actionIndex()
	{
		$this->render('index');
	}
        public function actionPrint()
	{
		$this->layout='//layouts/clear';
		$this->render('print');
	}
        
        public function actionSverka()
	{
            $model=new PersonSpecialityView('search');
	    $model->unsetAttributes();  // clear any default values
	    if(isset($_GET['PersonSpecialityView'])) {
                $model->attributes=$_GET['PersonSpecialityView'];
                $this->layout='//layouts/main_1';
                $this->render('sverka',array("model"=>$model));
            } else if(isset($_POST['PersonSpecialityView'])) {
                $model->attributes=$_POST['PersonSpecialityView'];
                $this->layout='//layouts/main_1';
                $this->render('sverka_print',array("model"=>$model));
            } else {
                $this->layout='//layouts/main_1';
                $this->render('sverka',array("model"=>$model));
            }
	}
 
}
