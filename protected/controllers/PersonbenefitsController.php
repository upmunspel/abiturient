<?php

class PersonbenefitsController extends Controller
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
                        'ajaxOnly + create, newbenefit, newBenefitDoc, delBenefitDoc, appendBenefit',
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update',
                                                    'newBenefit',"newBenefitDoc","delBenefitDoc",
                                                    "appendBenefit", "delBenefit",
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
        public function actionNewBenefit($personid)
	{   
            $model = new PersonBenefits();
        
            if (!empty($personid)){
                 $model->PersonID = $personid;
            }
            $this->renderPartial('_form',array(
			'model'=>$model,
                        'personid'=>$personid,
            ));
	}
        public function actionNewBenefitDoc()
	{   
            $model = new PersonBenefits();
            $documents = array();
            $valid = true;
            if (isset($_GET["PersonBenefits"])){
                $model->attributes = $_GET["PersonBenefits"];
            }
            
            if (isset($_GET["Documents"])){
                    foreach ($_GET["Documents"] as $i=>$obj){
                        $item = new Documents();
                        $item->attributes = $obj;
                        $valid = $valid && $item->validate();
                        $documents[] = $item;
                    }
            } 
            if ($valid ) $documents[] = new Documents();
            $this->renderPartial('_form',array(
			'model'=>$model,
                        'documents'=>$documents,
            ));
	}
        
        public function actionDelBenefitDoc($num)
	{   
            $model = new PersonBenefits();
            $documents = array();
            if (isset($_GET["PersonBenefits"])){
                $model->attributes = $_GET["PersonBenefits"];
            }
            
            if (isset($_GET["Documents"])){
                    unset($_GET["Documents"][$num]); 
                    foreach ($_GET["Documents"] as $i=>$obj){
                        $item = new Documents();
                        $item->attributes = $obj;
                        $documents[] = $item;
                    }
            } 
           
            $this->renderPartial('_form',array(
			'model'=>$model,
                        'documents'=>$documents,
            ));
	}
        
        public function actionDelBenefit($benefitid, $personid)
	{   
            $flag = $transaction = Yii::app()->db->getCurrentTransaction();
            if ($transaction === null)
            {
                $transaction = Yii::app()->db->beginTransaction();
            }
            try
            {
                $benefit = PersonBenefits::model()->findByPk($benefitid);
                if (!empty($benefit)){
                    if (!empty($benefit->items)){
                        foreach ($benefit->items as $item){
                            $tm = $item->document;
                            if ($item->delete()){
                                if (!empty($tm)) $tm->delete();
                            } 
                        }
                    }
                    $benefit->delete();
                }
                $transaction->commit();
                $person = Person::model()->findByPk($personid);
                echo CJSON::encode(array("result"=>'success','data'=>$this->renderPartial("_benefits", array('models'=>$person->benefits,'personid'=>$personid),true)));
            } catch (CHttpException $e) {
                if ($flag !== null) {
                        $transaction->rollback();
                 }
                 echo CJSON::encode(array("result"=>"error","data" =>$e->getMessage()));
                 
            } catch (Exception $e) {
                    if ($flag !== null) {
                        $transaction->rollback();
                    }
                    echo CJSON::encode(array("result"=>"error","data" =>"Дія заборонена!"));
            } 
	}
        
        public function actionAppendBenefit(){
            $model = new PersonBenefits();
            $documents = array();
            $valid = true;
            if (isset($_GET["PersonBenefits"])){
                $model->attributes = $_GET["PersonBenefits"];
                if (isset($_GET["Documents"])){
                    foreach ($_GET["Documents"] as $i=>$obj){
                        $item = new Documents();
                        $item->attributes = $obj;
                        $valid = $valid && $item->validate();
                        $documents[] = $item;
                    }
                }
            }
            if (!$valid){
                echo CJSON::encode(array("result"=>"suceess","data" =>
                $this->renderPartial('_form', array('model'=>$model,'documents'=>$documents),true)));
            } else {
                /* save all new records */
                $flag = $transaction = Yii::app()->db->getCurrentTransaction();
                if ($transaction === null)
                {
                    $transaction = Yii::app()->db->beginTransaction();
                }
                try
                {
                    
                   if ($model->save()){
                       foreach ($documents as $doc){
                           $doc->PersonID = $model->PersonID;
                           if ($doc->save()){
                                if (empty($doc->idDocuments)) throw new Exception("idDocuments is empty!");
                                                           
                               $rel = new PersonBenefitDocument();
                               $rel->DocumentID = $doc->getPrimaryKey();
                               $rel->PersonBenefitID = $model->idPersonBenefits;
                               $rel->save();
                           }
                       }
                   }
                    
                
                
                    $transaction->commit();
                    $person = Person::model()->findByPk($model->PersonID);
                    echo CJSON::encode(array("result"=>"success","data" =>
                    $this->renderPartial("_benefits", array('models'=>$person->benefits,'personid'=>$model->PersonID), true)
                    ));
                } catch (Exception $e) {
                    if ($flag !== null)
                    {
                        $transaction->rollback();
                       
                    }
                    echo CJSON::encode(array("result"=>"suceess","data" =>$e->getMessage()));
                   
                }
               
                
            };
            
        } 
	public function actionCreate($personid)
	{   
            $models = array();
        
            if (!empty($personid)){
                
                if (isset($_GET["PersonBenefits"])){
                    foreach ($_GET["PersonBenefits"] as $i=>$obj){
                        $id = $obj["idPersonBenefits"];
                        if ($id > 0){
                            $item = PersonBenefits::model()->findAllByPk($id);
                        } else {
                            $item = new PersonBenefits();
                        }
                        $item->attributes = $obj;
                        $item->PersonID = $personid;
                        $models[] = $item;
                    }
                
                } else {
                    
                    $person = Person::model()->findByPk($personid);
                    $res = $person->benefits;
                    if (is_array($res)) $models = $res;
                    if (is_object($res)) $models[] = $res;
                    
                }
                if (empty($_GET["reload"])) {
                    
                    $models[] = new PersonBenefits();
                    
                }
            }
            
            $this->renderPartial('_form',array(
			'models'=>$models,
                        'personid'=>$personid,
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

		if(isset($_POST['PersonBenefits']))
		{
			$model->attributes=$_POST['PersonBenefits'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idPersonBenefits));
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
		$dataProvider=new CActiveDataProvider('PersonBenefits');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PersonBenefits('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PersonBenefits']))
			$model->attributes=$_GET['PersonBenefits'];

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
		$model=PersonBenefits::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='person-benefits-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
