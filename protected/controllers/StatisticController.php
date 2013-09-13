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
				'actions'=>array('util','index', 'View', 'Print', "Sverka","ViewEx", "ViewY", "Originals","ViewBC", "Statisticallname", "Stateb", "Statebperson",
                                    "Fromvillage","Residentlist", "Viewall", "Viewallprint", "Verify", "Viewgraduated", "Viewgraduatedbyf", "Foreigngrad","Examwithoutzno",
						"Maglang","Maglangfil","Personspecmag","Personspecspecialists","Acts","CreateActs","GraduatedSchool"),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('Public'),
				'users'=>array('*'),
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('Util'),
				'roles'=>array('Root'),
			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//                        */
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
        public function actionPublic()
	{
            $model=new PersonSpecialityView('search');
	    $model->unsetAttributes();  // clear any default values
	    if(isset($_GET['PersonSpecialityView'])) {
                $model->attributes=$_GET['PersonSpecialityView'];
            }
            $this->layout='//layouts/main_1';
            $this->render('sverka',array("model"=>$model));
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
                $this->layout='//layouts/main_empty';
                $this->render('sverka_print',array("model"=>$model));
            } else {
                $this->layout='//layouts/main_1';
                $this->render('sverka',array("model"=>$model));
            }
	}
        public function actionViewEx()
	{
                $this->layout='//layouts/main_1';
		$this->render('statisticx');
	}
 
        public function actionViewY()
	{
                $this->layout='//layouts/clear';
		$this->render('statisticy');
	}
        
        public function actionOriginals()
	{
                $this->layout='//layouts/clear';
		$this->render('originals');
	}
        
        public function actionViewBC()
	{
                $this->layout='//layouts/clear';
		$this->render('statistic_budget_contract');
	}
        public function actionStatisticallname()
	{
		$this->layout='//layouts/clear';
		$this->render('Statisticallname');
	}
        public function actionStateb()
	{
		$this->layout='//layouts/clear';
		$this->render('stateb');
	}
        public function actionStatebperson()
	{
		$this->layout='//layouts/clear';
		$this->render('statebperson');
	}
        public function actionFromvillage()
	{
            $this->layout='//layouts/main_1';
            $model=new VillageList('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['VillageList']))
                    $model->attributes=$_GET['VillageList'];
            $this->layout='//layouts/main_1';
            $this->render('from_village',array(
                    'model'=>$model,
            ));
	}        
        public function actionResidentlist()
	{
		$this->layout='//layouts/main_1';
		$this->render('resident_list');
	}
        public function actionViewall()
	{
		$this->layout='//layouts/main_1';
		$this->render('viewall',array("model"=>AllCounts::model()));
	}
        
        public function actionViewallprint()
	{
		$this->layout='//layouts/clear';
		$this->render('viewall_print',array("model"=>AllCounts::model()));
	}
        public function actionViewgraduated()
	{
		$this->layout='//layouts/main_1';
		$this->render('graduated',array("model"=>StatGraduated::model()));
	}
        public function actionViewgraduatedbyf()
	{
		$this->layout='//layouts/clear';
		$this->render('graduatedbyf',array("model"=>StatGraduatedByF::model()));
	}     
        public function actionPersonspecmag()
	{
		$this->layout='//layouts/clear';
		$this->render('getcsv',array("model"=>  PersonspecMag::model()));
	} 
        public function actionPersonspecspecialists()
	{
		$this->layout='//layouts/clear';
		$this->render('getcsv',array("model"=>  PersonspecSpecialists::model()));
	} 
        public function actionVerify(){
            $this->layout='//layouts/main_1';
            $model=new PersonspecAll('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['PersonspecAll']))
                    $model->attributes=$_GET['PersonspecAll'];
            $this->layout='//layouts/main_1';
            $this->render('verify',array(
                    'model'=>$model,
            ));
        }
        public function actionForeigngrad(){
            $this->layout='//layouts/main_1';
            $this->render('foreigngraduated',array("model"=>  GraduatedAbiStat::model()));
        }
        public function actionExamwithoutzno(){
            $this->layout='//layouts/clear';
            $this->render('examwithoutzno');
        }
        public function actionMaglang(){
            $this->layout='//layouts/clear';
            $this->render('maglang');
        }
        public function actionMaglangfil(){
            $this->layout='//layouts/clear';
            $this->render('maglangfil');
        }
        public function actionActs(){
            $this->layout='//layouts/clear';
            $this->render('acts/index');
        }
        public function actionCreateActs(){
            $this->layout='//layouts/clear';
            $this->render('acts/select');
        }
        public function actionGraduatedSchool(){
            $this->layout='//layouts/main_1';
            $model=new GraduatedSchool('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['GraduatedSchool']))
                    $model->attributes=$_GET['GraduatedSchool'];
            $this->layout='//layouts/main_1';
            $this->render('graduatedschool',array(
                    'model'=>$model,
            ));
        }
        public function actionUtil()
	{       $model=new PersonSpecialityView('search');
                $model->unsetAttributes();  // clear any default values
	        if(isset($_GET['PersonSpecialityView'])) {
                    $model->attributes=$_GET['PersonSpecialityView'];
                    $out = "";
                    if (isset($_GET['renum'])){
                        $c = new CDbCriteria();
                        $c->compare("SepcialityID",$model->SepcialityID);
                        $c->order = "CreateDate";
                        $pspes = Personspeciality::model()->findAll($c);
                        
                        foreach($pspes as $i=>$obj){
                            $out.="RequestNumber: ". $obj->RequestNumber." chaget to: ".($i+1)."<br>";
                            $obj->RequestNumber = $i+1; 
                            if ($obj->QualificationID > 1 && $obj->SepcialityID != 70686 && $obj->SepcialityID != 90661){
                                $obj->scenario ="SHORTFORM";
                                //$obj->CausalityID = 100;
                            }
                            if (!$obj->save()) {
                                 debug(print_r($obj->getErrors(),true));
                                
                            }
                        }
                        
                    }
                    $this->render('sverka',array("model"=>$model));
                    if (!empty($out)) echo $out;
                   
                    
                } else {
		$this->render('util');
                }
	}
}
