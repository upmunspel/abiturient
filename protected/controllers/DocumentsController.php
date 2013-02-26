<?php

class DocumentsController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'ajaxOnly + newZno, newZnoSubject',
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('newZno','newZnoSubject'
                                                ),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        public function actionNewZno($personid)
            {   
                $model = new Documents('ZNO');
                $model->PersonID = $personid;
                $this->renderPartial('_form',array(
                            'model'=>$model,
                            'personid'=>$personid,true,true
                ));
            }
        public function actionNewZnoSubject()
            {   
                $model = new Documents('ZNO');
                $subjects = array();
                $valid = true;
                if (isset($_GET["Documents"])){
                    $model->attributes = $_GET["Documents"];
                    $model->validate();
                }
                
                if (isset($_GET["Documentsubject"])){
                        foreach ($_GET["Documentsubject"] as $i=>$obj){
                            $item = new Documentsubject();
                            $item->attributes = $obj;
                            $valid = $valid && $item->validate();
                            $subjects[] = $item;
                        }
                } 
                if ($valid) $subjects[] = new Documentsubject();
                
                $this->renderPartial('_form',array(
                            'model'=>$model,
                            'subjects'=>$subjects, 
                ));
            }

}