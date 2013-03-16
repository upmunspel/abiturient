<?php

class PersonspecialityController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $defaultAction='admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
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
		return AccessToDictionaries::getAccessRulesToDictionaries();
	}
        public function actionZnosubjects($personid, $specid, $specialityid){
            if ($specid == 0){
                $model = new Personspeciality();
                $model->PersonID = intval($personid);
            } else {
                $model = Personspeciality::model()->findByPk($specid);
                $model->PersonID = $personid;  
            }
            $this->renderPartial("_znosubjects", array('model'=>$model, 'specialityid'=>$specialityid));
        }
        public function actionSpeciality($idFacultet)
        {
            $data = Specialities::model()->findAll('FacultetID=:FacultetID',
                          array(':FacultetID'=>(int) $idFacultet));

            $data=CHtml::listData($data,'idSpeciality','SpecialityName');
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name),true);
            }
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
	public function actionCreate($personid)
	{
		$model=new Personspeciality;
                $model->PersonID = (int)$personid;
                $valid = true;
		if(isset($_GET['Personspeciality']))
		{
			$model->attributes=$_GET['Personspeciality'];
                        $valid  = $model->validate() && $valid;
                        if (!$valid){
                            echo CJSON::encode(array("result"=>"error","data" =>
                            $this->renderPartial('_form', array('model'=>$model),true)));
                             Yii::app()->end();
                        } else {
			if($model->save())
                            $person = Person::model()->findByPk($model->PersonID);
                            echo CJSON::encode(array("result"=>"success","data" =>
                                 $this->renderPartial("//person/tabs/_spec", array('models'=>$person->znos,'personid'=>$model->PersonID), true)
                            ));
                            Yii::app()->end();
                        }
		}

		$this->renderPartial('_Modal', array('model'=>$model,'personid'=>$model->PersonID));
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

		if(isset($_POST['Personspeciality']))
		{
			$model->attributes=$_POST['Personspeciality'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idPersonSpeciality));
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
		$dataProvider=new CActiveDataProvider('Personspeciality');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personspeciality('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personspeciality']))
			$model->attributes=$_GET['Personspeciality'];

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
		$model=Personspeciality::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='personspeciality-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
