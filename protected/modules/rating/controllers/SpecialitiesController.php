<?php

class SpecialitiesController extends Controller
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
			'accessControl', // perform access control for CRUD operations
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
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('autocomplete'),
				'users'=>array("*"),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='specialities-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
  
  public function actionAutocomplete(){
    if ( Yii::app()->request->isAjaxRequest ) {
      $reqTerm = Yii::app()->request->getParam('term',null);
      if (!$reqTerm){
        return;
      }
      $criteria = new CDbCriteria();
      $criteria->with = array('eduform');
      $criteria->together = true;
      $criteria->select = array(
         'idSpeciality',
          new CDbExpression("concat_ws(' ',"
                  . "SpecialityClasifierCode,"
                  . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
                  . "SpecialityDirectionName else SpecialityName end),"
                  . "(case SpecialitySpecializationName when '' then '' "
                  . " else concat('(',SpecialitySpecializationName,')') end)"
                  . ",',',concat('форма: ',eduform.PersonEducationFormName)) AS tSPEC"
          ),
      );
      $terms = explode(' ',$reqTerm);
      foreach ($terms as $term){
        $criteria->compare("concat_ws(' ',"
                    . "SpecialityClasifierCode,"
                    . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
                    . "SpecialityDirectionName else SpecialityName end),"
                    . "(case SpecialitySpecializationName when '' then '' "
                    . " else concat('(',SpecialitySpecializationName,')') end)"
                    . ",',',concat('форма: ',eduform.PersonEducationFormName))",$term,true);
      }
      $criteria->order = 'tSPEC ASC';
      $_data = CHtml::ListData(Specialities::model()->findAll($criteria),'idSpeciality','tSPEC');
      $data = array();
      $c = 0;
      foreach ($_data as $id => $val){
        $data[$c]['label'] = $val;
        $data[$c]['value'] = $val;
        $data[$c]['spec_id'] = $id;
        
        $c++;
      }
      $data['count'] = count($data);
      //var_dump($data);
      echo CJSON::encode( $data );
        
    }
  }
}
