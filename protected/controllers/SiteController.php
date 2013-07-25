<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        //public $layout='//layouts/column2_1';
   	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
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
			array('allow',  // allow all users to perform  actions
				'actions'=>array('login', 'error', 'captcha', 'index','contact',"logout"),
				'users'=>array('*'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('Reports'),
				'users'=>array('@'),
			),
			 /*array('allow', // allow authenticated user to perform 'create' and 'update' actions
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
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            //debug(Yii::app()->user->checkAccess('photoLoad'));
                if (Yii::app()->user->checkAccess('photoLoad')){
                    $this->redirect(Yii::app()->createUrl("photoloader"));
                } 
                if (Yii::app()->user->checkAccess('asOperatorStart')){
                    $this->redirect(Yii::app()->createUrl("personview"));
                } 
                if (Yii::app()->user->checkAccess('StatisticView')){
                    $this->redirect(Yii::app()->createUrl("statistic"));
                } 
                if (Yii::app()->user->checkAccess('asPfd')){
                    $this->redirect(Yii::app()->createUrl("pfd/prices"));
                } 
                
                $this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
           
            if($error=Yii::app()->errorHandler->error)
		{
                    if(Yii::app()->request->isAjaxRequest){
//                            $result = array();
//                            $result['result']="error";
//                            $result['data']= $error['message'];
//                            echo CJSON::encode($result);
                            echo $error['message'];
                    } else {
                            $this->render('error', $error);
                    }
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

        public function actionReports()
	{
            $this->render('reports');
        
        }
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
                $this->layout="//layouts/main";
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form*/
               
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
          
	}
}