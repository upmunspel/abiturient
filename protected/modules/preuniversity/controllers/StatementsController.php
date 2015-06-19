<?php

class StatementsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2_noblock';
    public $defaultAction = 'admin';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete', 'editfield', 'index', 'view', 'admin', 'create', 'update', "ajaxcreate", "ajaxupdate", "Reloadphoto"),
                'roles' => array("Root", "Admins", "Operators", "preuniversity"),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionEditfield() {
        if (isset($_POST['pk'])) {
            $pk = $_POST['pk'];
            $name = $_POST['name'];
            $value = trim($_POST['value']);
            if ($_POST['value'] != "" && ( intval($value) < 1 || intval($value) > 100) ){
                    throw new CHttpException(404, 'Бал повинен бути цілим від 1 до 100!');
            }
            $model = Statementpersons::model()->find("StatementID = {$pk["StatementID"]} and PersonID =  {$pk['PersonID']}");
            if (empty($model)) {
                $model = new Statementpersons();
                $model->PersonID = $pk["PersonID"];
                $model->StatementID = $pk["StatementID"];
            }
            $model->{$name} = $value;
            $model->save();
        } else {
            throw new CHttpException(404, 'Пустой первичный ключ!');
        }
        /*
          name:Subject1Val
          value:111123
          pk[PersonID]:1
          pk[StatementID]:1 */

        $model = null; //Statementpersons::model()->findByPk("PersonID = :PersonID and StatementID = :StatementID",
        //array(":StatementID"=>$pk["StatementID"], ":PersonID"=>$pk['PersonID'] ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $itemsmodel = array();
        $person = Person::model()->findAll("idPreuniGroup = " . $model->SpecialityID);
        foreach ($person as $pitem) {
            $sp = Statementpersons::model()->find("PersonID = {$pitem->idPerson} and StatementID = {$model->idStatement}");
            if (empty($sp)) {
                $sp = new Statementpersons();
                $sp->PersonID = $pitem->idPerson;
                $sp->StatementID = $model->idStatement;
                $sp->isNewRecord = false;
            }
            $itemsmodel[] = $sp;
        }
        $this->render('view', array(
            'model' => $this->loadModel($id), "itemsmodel" => $itemsmodel
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Statements;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Statements'])) {
            $model->attributes = $_POST['Statements'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idStatement));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Statements'])) {
            $model->attributes = $_POST['Statements'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->idStatement));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Statements');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Statements('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Statements']))
            $model->attributes = $_GET['Statements'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Statements::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'statements-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
