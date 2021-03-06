<?php

class PersonspecialityController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $defaultAction = 'admin';

    /**
     * @return array action filters
     */
    public function filters() {
//		return array(
//			//'accessControl', // perform access control for CRUD operations
//			//'postOnly', // we only allow deletion via POST request
//		);
        return array(
            'accessControl', // perform access control for CRUD operations
            'ajaxOnly + Refresh, Edboupdate, Studupdate, Entrance, Priorityinfo, Educationsinfo',
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
                'actions' => array(),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('Znosubjects',
                    'Speciality',
                    'Specialitys',
                    'View',
                    'Create',
                    'Update',
                    "Delete",
                    "Index",
                    "Refresh",
                    'admin', "Edboupdate",
                    'Studupdate',
                    "Create_electron",
                    "Entrance",
                    "Priorityinfo",
                    "Educationsinfo",
                ),
                'users' => array('@'),
            ),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionEdboupdate($id) {
        $model = Personspeciality::model()->findByPk($id);
        if (Yii::app()->user->checkAccess("wsAllowEdit")) {
            try {

                $link = Yii::app()->user->getEdboSearchUrl() . "request.jsp";

                $client = new EHttpClient($link, array('maxredirects' => 30, 'timeout' => 120,));

                $client->setParameterPost(array("personIdMySql" => $model->PersonID, "personSpeciality" => $id));
                $response = $client->request(EHttpClient::POST);

                if ($response->isSuccessful()) {
                    $obj = (object) CJSON::decode($response->getBody());
                    //Yii::log(print_r($obj,1));
                    if ($obj->error) {
                        Yii::app()->user->setFlash("message", $obj->message);
                    } else {
                        Yii::app()->user->setFlash("message", $obj->message);
                    }
                } else {
                    Yii::app()->user->setFlash("message", "Синхронізація не виконана! Спробуйте пізніше.");
                }
            } catch (Exception $e) {
                Yii::app()->user->setFlash("message", "Синхронізація не виконана! Спробуйте пізніше.");
            }
        } else {
            Yii::app()->user->setFlash("message", WebServices::$MSG_EDBO_EDIT_DENY);
        }
        echo CJSON::encode(array("result" => "success", "data" => ""));
    }

    public function actionZnosubjects($personid) {
        $model = new Personspeciality;
        if (isset($_POST['Personspeciality'])) {
            $model->attributes = $_POST['Personspeciality'];
            $model->PersonID = intval($personid);
        }
        $this->renderPartial("_subjects_holder", array('model' => $model, 'specialityid' => $model->SepcialityID));
    }

    public function actionSpeciality($idFacultet, $idEducationForm, $QualificationID, $BaseSpecID = "") {
        //Yii::log(print_r($BaseSpecID,1)); 
        $data = Specialities::DropDownMask($idFacultet, $idEducationForm, $QualificationID, $BaseSpecID);
        echo CHtml::tag('option', array('value' => ""), "", true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionEntrance($id) {
        $id = intval($id);
        $data = Causality::model()->findAll("PersonEnteranceTypeID = $id");
        echo CHtml::tag('option', array('value' => ""), "", true);
        foreach ($data as $obj) {
            //$obj = new Causality();
            echo CHtml::tag('option', array('value' => $obj->idCausality), $obj->CausalityName, true);
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /*
     * @param $model Personspeciality 
     */

    protected function _setDefaults($model) {
        if ($model->PersonID > 0) {

            $lng = Languages::model()->findByPk($model->person->LanguageID);
            if (!empty($lng)) {
                $id = Languagesex::model()->find("LanguageExName='{$lng->LanguagesName}'");
                if (!empty($id)) {
                    $model->LanguageExID = $id->idLanguageEx;
                }
            }
        }
        //$model = new Personspeciality();
        $user = User::model()->findByPk(Yii::app()->user->id);
        //debug(print_r($user->syspk, true));
        if (!empty($user->syspk)) {
            $pk = $user->syspk;
            //$pk=new SysPk();
            $model->CourseID = $pk->CourseID;
            $model->QualificationID = $pk->QualificationID;
            $model->isBudget = $pk->isBudget;
            $model->isContract = $pk->isContract;
            $model->EducationFormID = $pk->EducationFormID;
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($personid, $reload = "") {
        $model = new Personspeciality;
        $model->PersonID = (int) $personid;
        $this->_setDefaults($model);
        $valid = true;

        if (isset($_GET['idRequest'])) {
            try {
                $pr = Person::model()->findByPk($personid);
                $idReq = intval($_GET['idRequest']);
                $res = WebServices::findRequestsByCodeU($pr->codeU, $idReq);
                $sbj = WebServices::findRequestsSubjects($idReq);
                $model->loadRequestFromJsqon($res, $sbj);
            } catch (Exception $ex) {
                Yii::log($ex->getMessage());
                Yii::app()->user->setFlash("specmessage", $ex->getMessage());
            }
        }

        if (isset($_GET['Personspeciality'])) {
            $renderForm = "_form";
            //if (isset($_GET['Personspeciality']['GraduatedUniversitieID'])){
            if (!empty($_GET['Personspeciality']['QualificationID']) && $_GET['Personspeciality']['QualificationID'] > 1 && ($_GET['Personspeciality']['SepcialityID'] != 70686 && $_GET['Personspeciality']['SepcialityID'] != 90661)) {
                $model->scenario = "SHORTFORM";
                $renderForm = "_formShort";
                $model->CausalityID = 100;
            }
            $model->attributes = $_GET['Personspeciality'];

            if (intval($model->EntranceTypeID) == 1) {

                $model->Exam1ID = null;
                $model->Exam1Ball = null;
                $model->Exam2ID = null;
                $model->Exam2Ball = null;
                $model->Exam3ID = null;
                $model->Exam3Ball = null;
                $model->CausalityID = null;
            } elseif (intval($model->EntranceTypeID) == 2) {
//                $model->DocumentSubject1 = null;
//                $model->DocumentSubject2 = null;
//                $model->DocumentSubject3 = null;
            }
            if (!$reload) {
                $valid = $model->validate() && $valid;
                if (!$valid) {
                    //debug ($model->PersonID);
                    echo CJSON::encode(array("result" => "error", "data" =>
                        $this->renderPartial($renderForm, array('model' => $model), true)));
                    Yii::app()->end();
                } else {
                    if ($model->save())
                    //debug ($model->PersonID);
                        $person = Person::model()->findByPk($model->PersonID);
                    echo CJSON::encode(array("result" => "success", "data" =>
                        $this->renderPartial("//person/tabs/_spec", array('models' => $person->specs, 'personid' => $model->PersonID), true)
                    ));
                    Yii::app()->end();
                }
            } else {
                echo CJSON::encode(array("result" => "success", "data" => $this->renderPartial("_formShort", array('model' => $model), true)
                ));
                Yii::app()->end();
            }
        }

        $this->renderPartial('_Modal', array('model' => $model, 'personid' => $model->PersonID));
    }

    public function actionCreate_electron($personid, $spec) {
        $model = new Personspeciality;
        $model->PersonID = (int) $personid;
        $this->_setDefaults($model);
        $valid = true;

        if (isset($_GET['Personspeciality'])) {
            $renderForm = "_form";
            //if (isset($_GET['Personspeciality']['GraduatedUniversitieID'])){

            $model->attributes = $_GET['Personspeciality'];

            if (intval($model->EntranceTypeID) == 1) {

                $model->Exam1ID = null;
                $model->Exam1Ball = null;
                $model->Exam2ID = null;
                $model->Exam2Ball = null;
                $model->Exam3ID = null;
                $model->Exam3Ball = null;
                $model->CausalityID = null;
            } elseif (intval($model->EntranceTypeID) == 2) {
                $model->DocumentSubject1 = null;
                $model->DocumentSubject2 = null;
                $model->DocumentSubject3 = null;
            }

            $valid = $model->validate() && $valid;
            if (!$valid) {
                //debug ($model->PersonID);
                echo CJSON::encode(array("result" => "error", "data" =>
                    $this->renderPartial($renderForm, array('model' => $model), true)));
                Yii::app()->end();
            } else {
                if ($model->save())
                //debug ($model->PersonID);
                    $person = Person::model()->findByPk($model->PersonID);
                echo CJSON::encode(array("result" => "success", "data" =>
                    $this->renderPartial("//person/tabs/_spec", array('models' => $person->specs, 'personid' => $model->PersonID), true)
                ));
                Yii::app()->end();
            }
        }

        //debug($link);
        //print "<script type=\"text/javascript\">prompt('Введдіть ЄДБО Кодi!');</script>";
        //$client = new EHttpClient($link, array('maxredirects' => 30, 'timeout'=> 30,));
        //$client->setParameterPost($_GET);
        //$response = $client->request(EHttpClient::POST);
        $searchRes = array();
        $searchRes = $model->loadOnlineStatementFromJSON($spec);
        $user = Yii::app()->user->getUserModel();
        if ($user->syspk->SpecMask == "1") {
            $this->renderPartial('_Modal_electron', array('model' => $model, 'spec' => $spec));
        } else {
            $this->renderPartial('_Modal_electron_error', array('model' => $model));
        }
    }

    public function actionRefresh($id) {
        $this->renderPartial("//person/tabs/_spec", array('personid' => $id));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {

        $model = $this->loadModel($id);

        $valid = true;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_GET['Personspeciality'])) {

            $renderForm = "_form";
            //if (isset($_GET['Personspeciality']['GraduatedUniversitieID'])){
            //debug($model->SepcialityID);
            if (!empty($_GET['Personspeciality']['QualificationID']) && $_GET['Personspeciality']['QualificationID'] > 1 && $model->SepcialityID != 70686 && $model->SepcialityID != 90661) {
                $model->scenario = "SHORTFORM";
                $renderForm = "_formShort";
                $model->CausalityID = 100;
            }
            $model->attributes = $_GET['Personspeciality'];

            if (empty($_GET['Personspeciality']['benefits']) && Yii::app()->user->checkAccess("showBenefits")) {
                $model->benefits = array();
            }

            if (intval($model->EntranceTypeID) == 1) {
                $model->Exam1ID = null;
                $model->Exam1Ball = null;
                $model->Exam2ID = null;
                $model->Exam2Ball = null;
                $model->Exam3ID = null;
                $model->Exam3Ball = null;
                $model->CausalityID = null;
            } elseif (intval($model->EntranceTypeID) == 2) {
//                $model->DocumentSubject1 = null;
//                $model->DocumentSubject2 = null;
//                $model->DocumentSubject3 = null;
            }
            $valid = $model->validate() && $valid;
            try {
                if (!$valid) {
                    echo CJSON::encode(array("result" => "error", "data" =>
                        $this->renderPartial($renderForm, array('model' => $model), true)));
                    Yii::app()->end();
                } else {
                    if ($model->save())
                        $person = Person::model()->findByPk($model->PersonID);
                    echo CJSON::encode(array("result" => "success", "data" =>
                        $this->renderPartial("//person/tabs/_spec", array('models' => $person->specs, 'personid' => $model->PersonID), true)
                    ));
                    Yii::app()->end();
                }
            } catch (Exception $e) {
                echo CJSON::encode(array("result" => "error", "data" => $e->getMessage()));
                Yii::app()->end();
            }
        }

        $this->renderPartial('_Modal', array('model' => $model, 'personid' => $model->PersonID));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        try {
            $model = $this->loadModel($id);
            $personid = $model->PersonID;
            if (empty($model->edboID)) {
                if ($model->QualificationID > 1 && $model->SepcialityID != 70686 && $model->SepcialityID != 90661) {
                    $model->scenario = "SHORTFORM";
                    $model->CausalityID = 100;
                }
                $model->StatusID = 10;
                if (!$model->save()) {
                    Yii::log(print_r($model->getErrors(), true));
                }
            } else {
                Yii::app()->user->setFlash("message", "Заборонено видаляти заявку!");
            }
            $person = Person::model()->findByPk($personid);
            echo CJSON::encode(array("result" => "success", "data" => $this->renderPartial("//person/tabs/_spec", array('models' => $person->specs, 'personid' => $personid), true)));
        } catch (CHttpException $e) {
            echo CJSON::encode(array("result" => "error", "data" => $e->getMessage()));
        } catch (Exception $e) {
            echo CJSON::encode(array("result" => "error", "data" => "Дія заборонена!"));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Personspeciality');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Personspeciality('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Personspeciality']))
            $model->attributes = $_GET['Personspeciality'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Обновление цены за обучение
     * @param type $id
     */
    public function actionStudupdate($id) {
        $model = $this->loadModel($id);
        $valid = true;
        if (isset($_POST['Personspeciality'])) {
            $model->attributes = $_POST['Personspeciality'];
            $valid = $model->validate() && $valid;

            try {
                if ($model->save())
                    $model = new PersonSpecialityView('search');
                $model->unsetAttributes();  // clear any default values
                if (isset($_GET['PersonSpecialityView']))
                    $model->attributes = $_GET['PersonSpecialityView'];
                //$person = PersonSpecialityView::model()->findByPk($model->idPersonSpeciality);
                echo CJSON::encode(array("result" => "success", "data" =>
                    $this->renderPartial("//prices/tabs/_studprice", array('model' => $model), true)
                ));
                Yii::app()->end();
            } catch (Exception $e) {
                echo CJSON::encode(array("result" => "error", "data" => $e->getMessage()));
                Yii::app()->end();
            }
        }
        $this->renderPartial('_studpriceModal', array('model' => $model, 'personid' => $model->idPersonSpeciality));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Personspeciality::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionSpecialitys($idFacultet, $idEducationForm, $QualificationID) {
//            $data = Specialities::model()->findAll('FacultetID=:FacultetID',
//                          array(':FacultetID'=>(int) $idFacultet));
//
//            $data=CHtml::listData($data,'idSpeciality','SpecialityName');
//            echo CHtml::tag('option', array('value'=>""), "", true);
        $data = Specialities::DropDownMask1($idFacultet, $idEducationForm, $QualificationID);
        echo CHtml::tag('option', array('value' => ""), "", true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionPriorityinfo($idperson) {
        /*
         * {
          "requestPriority":1,
          "idPersonRequest":6927303,
          "personEducationFormName":"Денна",
          "qualificationName":"Бакалавр (4 р. 00 м.)",
          "universityFacultetFullName":"Математичний",
          "specClasifierCode":"6.040201",
          "specSpecialityClasifierCode":"",
          "specIndastryName":"Фізико-математичні науки",
          "specDirectionName":"математика",
          "specSpecialityName":"",
          "specScecializationName":""
          },
         */

        $msg = "";
        $priority = "Доступні пріорітети: ";
        $type = "success";
        $count = 0;
        $model = Person::model()->findByPk($idperson);
        if (!empty($model) && !empty($model->codeU)) {
            try {
                $res = WebServices::getPersonAllPriority($model->codeU);
                $res = CJSON::decode($res);
                Yii::log(print_r($res,1));
                if (is_array($res)) {
                    foreach ($res as $item) {
                        $item = (object) $item;
                        if ($item->idPersonRequest > 0) {
                            $type = "info";
                            $msg.= "<div>";
                            $msg.= $item->requestPriority . " : " . $item->qualificationName . ", " . $item->specClasifierCode . " - " . $item->specDirectionName;
                            $msg.= "</div>";
                            $count++;
                        } else {
                            $priority.=$item->requestPriority . " | ";
                        }
                    }
                }
                if ($count == 0) {
                    $msg = "Всі пріорітети вільні!";
                    $type = "success";
                }
                $msg.= "<div>" . $priority . "</div>";
            } catch (Exception $e) {
                $msg = $e->getMessage();
                $type = "error";
            }
        } else {
            $msg.= "Необхідно синхронізувати персону!";
            $type = "warning";
        }
        Yii::app()->user->setFlash($type, $msg);
    }

    public function actionEducationsinfo($idperson) {


        $msg = "";

        $type = "info";
        $count = 0;
        $model = Person::model()->findByPk($idperson);
        if (!empty($model) && !empty($model->codeU)) {
            try {
                $res = WebServices::getPersonBaseEducations($model->codeU);
                $res = CJSON::decode($res);
                
                if (is_array($res)) {
                    $msg.="<ul>";
                    foreach ($res as $item) {
                        $item = (object) $item;
                        if ($item->qualificationName == "Бакалавр") {
                            $type = "info";
                            $msg.= "<li>";
                            $msg.= $item->personEducationFormName .
                                    " : " . $item->personEducationPaymentTypeName .
                                    " : " . $item->qualificationName .
                                    " : " . $item->specDirectionName .
                                    " : " . $item->universityFullName;
                            $msg.= "</li>";
                            $count++;
                        } else {
                            $tmp = "<li>";
                            $tmp.= $item->personEducationFormName .
                                    " : " . $item->personEducationPaymentTypeName .
                                    " : " . $item->qualificationName .
                                    " : " . $item->specDirectionName .
                                    " : " . $item->universityFullName;
                            $tmp.= "</li>";
                            Yii::log($tmp);
                            Yii::log(print_r($item,1));
                        }
                    }
                    $msg.="</ul>";
                }
                if ($count == 0) {
                    $msg = "Попередня освіта відсутня або не зареестровано у базі ЄДБО";
                    $type = "success";
                } else {
                    $type = "warning";
                    $msg.="<h3>Заявки даної персони може приймати тільки оператор 116 аудиторії!</h3>";
                }
            } catch (Exception $e) {
                $msg = $e->getMessage();
                $type = "error";
            }
        } else {
            $msg.= "Необхідно синхронізувати персону!";
            $type = "warning";
        }
        Yii::app()->user->setFlash($type, $msg);
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'personspeciality-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
