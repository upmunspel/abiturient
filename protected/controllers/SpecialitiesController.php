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
      /*array('allow',  // allow all users to perform 'index' and 'view' actions
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
      ),*/
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
        'actions'=>array('index','view','admin','delete','create','update', "ajaxcreate","ajaxupdate",'xedit', "Rename"),
        'roles'=>array("Root","Admins"),
      ),
      array('allow', 
        'actions'=>array('index','admin','xedit'),
        'users'=>array("munspel","igor","pfd"),
      ),
      
      array('deny',  // deny all users
        'users'=>array('*'),
      ),
    );
  }
 /**
  * Переименовывает поле  SpecialitySpecializationName
  */
  public function actionRename()
  {
    echo "<h1>Переоменование  SpecialitySpecializationName</h1>"  ;
 
    $model = Specialities::model()->findAll();
    foreach ($model as $item) {
        $name = $item->getSpecName($item->idSpeciality);
        echo "pos =".strpos(" ,", $name);
        
        $search  = array('  ','  ,',' ,');
        $replace = array(' ', ',',',');
        $name = str_replace($search, $replace, $name); 
        
        $item->SpecialityLicenseName = $name;
        
        if ($item->save()) {
            echo "<div>".$item->idSpeciality." - OK!: $name</div>";
        } else {
            echo "<div>".$item->idSpeciality." - ERROR! </div>";
        }
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
  public function actionCreate()
  {
    $model=new Specialities;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(isset($_POST['Specialities']))
    {
      $model->attributes=$_POST['Specialities'];
                        if (empty($_POST['Specialities']['basespecialitys'])) {
                            $model->basespecialitys = array();
                        }
      if($model->save())
        $this->redirect(array('view','id'=>$model->idSpeciality));
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
  public function actionUpdate($id)
  {
    $model=$this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(isset($_POST['Specialities']))
    {
      $model->attributes=$_POST['Specialities'];
                        if (empty($_POST['Specialities']['basespecialitys'])) {
                            $model->basespecialitys = array();
                        }
      if($model->save())
        $this->redirect(array('view','id'=>$model->idSpeciality));
    }

    $this->render('update',array(
      'model'=>$model,
    ));
  }
  
  
  /**
   * Updates a particular record by EditableColumn's saver.
   */
  public function actionXedit(){
    Yii::import('bootstrap.widgets.TbEditableSaver');
    $reqField = Yii::app()->request->getParam('field',null);
    $reqValue = Yii::app()->request->getParam('value',null);
    $reqId = Yii::app()->request->getParam('pk',null);
    if ($reqField == 'YearPrice'){
      $model = Specialities::model()->findByPk($reqId);
      $num = 0.0 + $reqValue;
      $model->WordPrice = $model->num2str($num);
      $model->save();
    }
    $es = new TbEditableSaver('Specialities'); 
    $es->update();
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
    $dataProvider=new CActiveDataProvider('Specialities');
    $this->render('index',array(
      'dataProvider'=>$dataProvider,
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin()
  {
    $model=new Specialities('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Specialities']))
      $model->attributes=$_GET['Specialities'];
    if (isset($_GET['Specialities']['SPEC'])){
      $model->SPEC = $_GET['Specialities']['SPEC'];
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
  public function loadModel($id)
  {
    $model=Specialities::model()->findByPk($id);
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
    if(isset($_POST['ajax']) && $_POST['ajax']==='specialities-form')
    {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}
