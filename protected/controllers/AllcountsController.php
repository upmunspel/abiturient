<?php

class AllcountsController extends Controller
{
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
				'actions'=>array('index', 'View', 'ViewPrint'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('Public'),
				'users'=>array('*'),
			),
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
                $model=new AllCounts('search');
                $this->layout='//layouts/main_1';
		$this->render('view',array("model"=>$model));
	}
        public function actionViewPrint()
	{
                $model=new AllCounts('search');
                $this->layout='//layouts/clear';
		$this->render('view_print',array("model"=>$model));
	}        
        public function actionIndex()
	{
                $model=new AllCounts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AllCounts'])) {
			$model->attributes=$_GET['AllCounts'];
                }
		$this->render('index', array('model'=>$model));
	}
}