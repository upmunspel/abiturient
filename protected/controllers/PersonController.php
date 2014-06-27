<?php

class PersonController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2_1';
    protected $edboobj = null;

    protected function FindLocalPersonByDoc($seria, $number) {

        $c = new CDbCriteria();
        if (!(trim($seria) === "")) {
            $c->compare("Series", trim($seria));
        }
        if (!(trim($number) === "")) {
            $c->compare("Numbers", trim($number));
        }
        $models = Documents::model()->findAll($c);

        if (!is_array($models) && is_object($models))
            return $models->PersonID;
        foreach ($models as $obj) {
            return $obj->PersonID;
            if ($obj->TypeID == 2)
                return $obj->PersonID;
            if ($obj->TypeID == 3)
                return $obj->PersonID;
            if ($obj->TypeID == 4)
                return $obj->PersonID;
        }

        return 0;
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            /* array('allow', // allow authenticated user to perform 'create' and 'update' actions
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
              ), */
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view', 'admin', 'create', 'update', "ajaxcreate", "ajaxupdate", "Reloadphoto"),
                'roles' => array("Root", "Admins", "Operators"),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);

        if (isset($_GET["opt"]) && !empty($model) && $_GET["opt"] == 'edboadd') {
            if ($model->SendEdboRequest()) {
                // $model->save();
            }
            $this->redirect(Yii::app()->createUrl("person/view", array("id" => $id)));
        }

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $this->layout = '//layouts/column2_noblock';

        $model = new Person;

        $model->Birthday = date("d.m.Y", mktime(0, 0, 0, 1, 1, date('Y') - 18));

        $searchRes = array();


        // Обработка формы поиска
        if (isset($_POST['search'])) {
            $findRes = 0; //$this->FindLocalPersonByDoc($_POST['search']['attestatSeries'],$_POST['search']['attestatNumber']);
            //debug($findRes);
            try {
                if ($findRes == 0) {
                    $res = WebServices::findPerson($_POST['search']['series'], $_POST['search']['number']);
                    $searchRes = Person::JsonDataAsArray($res);
                } else {
                    Yii::app()->user->setFlash("message", "Персона вже існує в системі з кодом $findRes");
                    $this->redirect(Yii::app()->createUrl("person/update", array("id" => $findRes)));
                }
            } catch (Exception $e) {
                Yii::app()->user->setFlash("message", $e->getMessage());
            }
        }

        if (isset($_GET['personCodeU'])) {

            try {
                if ($model->loadByUCode($_GET['personCodeU'])) {
                    try {
                        $response = WebServices::findPersonDocumentsByCodeU($_GET['personCodeU']);
                        $searchRes = $model->loadDocumentsFromJSON($response);
                        $response = WebServices::findPersonContactsByCodeU($_GET['personCodeU']);
                        $searchRes = $model->loadContactsFromJSON($response);
                    } catch (Exception $e) {
                        Yii::app()->user->setFlash("message", $e->getMessage());
                    }
                }
            } catch (Exception $e) {
                Yii::app()->user->setFlash("message", $e->getMessage());
            }
        }

        if (isset($_POST['Person'])) {
            $model->attributes = $_POST['Person'];
            if (isset($_POST['Documents']['persondoc'])) {
                $model->persondoc->attributes = $_POST['Documents']['persondoc'];
                $model->validate();
            }
            if (isset($_POST['Documents']['entrantdoc'])) {
                $model->entrantdoc->attributes = $_POST['Documents']['entrantdoc'];
            }
            if (isset($_POST['Documents']['inndoc'])) {
                $model->inndoc->attributes = $_POST['Documents']['inndoc'];
            }
            if (isset($_POST['Documents']['hospdoc'])) {
                $model->hospdoc->attributes = $_POST['Documents']['hospdoc'];
            }
            if (isset($_POST['PersonContacts']['homephone'])) {
                $model->homephone->attributes = $_POST['PersonContacts']['homephone'];
            }
            if (isset($_POST['PersonContacts']['mobphone'])) {
                $model->mobphone->attributes = $_POST['PersonContacts']['mobphone'];
            }
            //$model->CreateDate = null;

            $entrant_valid = true;
            $showPersonEntrantDocForm = Yii::app()->user->checkAccess("showPersonEntrantDocForm");
            if ($showPersonEntrantDocForm) {
                $entrant_valid = $model->entrantdoc->validate("ENTRANT");
            }
            if ($entrant_valid && $model->persondoc->validate() && $model->inndoc->validate("INN") && $model->hospdoc->validate("HOSP") && $model->homephone->validate() && $model->mobphone->validate() && $model->save()) {
                $model->persondoc->PersonID = $model->idPerson;
                if ($showPersonEntrantDocForm) {
                    $model->entrantdoc->PersonID = $model->idPerson;
                }
                $model->inndoc->PersonID = $model->idPerson;
                $model->hospdoc->PersonID = $model->idPerson;
                $model->homephone->PersonID = $model->idPerson;
                $model->mobphone->PersonID = $model->idPerson;

                $model->persondoc->save();

                if ($showPersonEntrantDocForm) {
                    $model->entrantdoc->save();
                }

                $model->inndoc->save();
                $model->hospdoc->save();
                $model->homephone->save();
                $model->mobphone->save();




                if (isset(Yii::app()->session[$model->codeU . "-documents"])) {
                    //Documents::loadAndSave($model->idPerson, unserialize(Yii::app()->session[$model->codeU."-documents"]));
                }
//                            debug("model->entrantdoc->AtestatValue = ".$model->entrantdoc->AtestatValue);
//                            if (!empty($model->entrantdoc->edboID) && (empty($model->entrantdoc->AtestatValue)  || $model->entrantdoc->AtestatValue == 0 )  {
//                                  debug("model->entrantdoc->AtestatValue = ".$model->entrantdoc->AtestatValue);
//                                  $old = Yii::app()->user->getFlash("message");
//                                  Yii::app()->user->setFlash("message",$old." Необхідно ввести середный бал документа про освіту з номером:".$model->entrantdoc->Numbers."!" );
//                            }
                /*
                  if (!$model->SendEdboRequest()){
                  $model->delete();
                  $this->render('create',array('model'=>$model,"searchres"=>$searchRes));
                  Yii::app()->end();
                  }
                 */

                $this->redirect(array('view', 'id' => $model->idPerson));
            }
        }

        $this->render('create', array('model' => $model, "searchres" => $searchRes));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->layout = '//layouts/column2_noblock';
        $model = $this->loadModel($id);
        //var_dump($_POST);
        //var_dump($model);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Person'])) {
            $model->attributes = $_POST['Person'];
            if (empty($_POST['Person']['KOATUUCodeL2ID']))
                $model->KOATUUCodeL2ID = null;
            if (empty($_POST['Person']['KOATUUCodeL3ID']))
                $model->KOATUUCodeL3ID = null;
            if (isset($_POST['Documents']['persondoc'])) {
                $model->persondoc->attributes = $_POST['Documents']['persondoc'];
                $model->persondoc->PersonID = $model->idPerson;
            }
            if (isset($_POST['Documents']['entrantdoc'])) {
                $model->entrantdoc->attributes = $_POST['Documents']['entrantdoc'];
                $model->entrantdoc->PersonID = $model->idPerson;
            }
            if (isset($_POST['Documents']['inndoc'])) {
                $model->inndoc->attributes = $_POST['Documents']['inndoc'];
                $model->inndoc->PersonID = $model->idPerson;
            }
            if (isset($_POST['Documents']['hospdoc'])) {
                $model->hospdoc->attributes = $_POST['Documents']['hospdoc'];
                $model->hospdoc->PersonID = $model->idPerson;
            }
            if (isset($_POST['PersonContacts']['homephone'])) {
                $model->homephone->attributes = $_POST['PersonContacts']['homephone'];
                $model->homephone->PersonID = $model->idPerson;
            }
            if (isset($_POST['PersonContacts']['mobphone'])) {
                $model->mobphone->attributes = $_POST['PersonContacts']['mobphone'];
                $model->mobphone->PersonID = $model->idPerson;
            }
            $entrant_valid = true;
            $showPersonEntrantDocForm = Yii::app()->user->checkAccess("showPersonEntrantDocForm");
            if ($showPersonEntrantDocForm) {
                $entrant_valid = $model->entrantdoc->validate("ENTRANT");
            }
            if ($model->validate() && $model->persondoc->validate() && $entrant_valid && $model->inndoc->validate("INN") && $model->hospdoc->validate("HOSP") && $model->homephone->validate() && $model->mobphone->validate()) {
                if ($model->save()) {

                    $model->persondoc->save();
                    if ($showPersonEntrantDocForm) {
                        $model->entrantdoc->save();
                    }
                    $model->inndoc->save();
                    $model->hospdoc->save();
                    $model->homephone->save();
                    $model->mobphone->save();

                    //$model->SendEdboRequest();
                }
                $this->redirect(array('view', 'id' => $model->idPerson));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
// we only allow deletion via POST request
//                  try {       
            $model = $this->loadModel($id);
            $model->delete();
//                  } catch (Exception $e) {
//                     
//                         Yii::app()->user->setFlash("error", "Дія заборонена!");
//           } 
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->layout = "//layouts/column2_1";
        //$this->layout="'//layouts/column2";
        /* $dataProvider=new CActiveDataProvider('Person');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          )); */
        $model = new Person('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Person']))
            $model->attributes = $_GET['Person'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionReloadphoto($id) {
        $model = $this->loadModel($id);
        WebServices::getPersonPhotoByCodeU($model->codeU);
        $this->renderPartial('_photo', array('model' => $model));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->layout = "//layouts/column2_1";
        $model = new Person('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Person']))
            $model->attributes = $_GET['Person'];

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
        $model = Person::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'person-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
