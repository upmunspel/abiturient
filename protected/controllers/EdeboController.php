<?php

class EdeboController extends Controller {

    public $layout = '//layouts/main_noblock';

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
            array('allow', // allow all users to perform  actions
                'actions' => array(),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', "Changestatus", "Changedoc"),
                'users' => array('@'),
            ),
            /* array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions'=>array('index','logout'),
              'users'=>array('@'),
              ),
              array('allow', // allow admin user to perform 'admin' and 'delete' actions
              'actions'=>array('admin','delete'),
              'users'=>array('admin'),
              ), */
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $model = new EdeboStatusChange();
        $res = "";
        $request_list = array();
        $idRequestSpeciality = "";
        if (isset($_POST['EdeboStatusChange'])) {
            
            $model->attributes = $_POST['EdeboStatusChange'];
            if ($model->validate()) {

                try {
                    $res = WebServices::getRequestsByStatus($model->StatusID, $model->QualificationID, date("Y-m-d", strtotime($model->Data)));
                } catch (Exception $exc) {
                    Yii::log($exc->getTraceAsString());
                }
            }
        }
        if (isset($_REQUEST["idRequestSpeciality"])){
            $idRequestSpeciality = $_REQUEST["idRequestSpeciality"];
            $models = Personspeciality::model()->findAll("SepcialityID = :id", array("id"=>$_REQUEST["idRequestSpeciality"]));
            foreach($models as $item){
                //$item = new Personspeciality();
                if (!empty($item->edboID)){
                    $request_list[]=$item->edboID;
                }
            }
            //$request_list = CJSON::encode($request_list);
        }
        
        
        //$res =  CJSON::encode(array(1,2,3,4,5,6,7,8,9,10));
        
        $this->render('index', array('model' => $model, 'res' => $res, "request_list"=>$request_list, "idRequestSpeciality"=>$idRequestSpeciality  ));
        
    }

    public function actionChangestatus($idPersonRequest, $idStatus, $numberProtocol, $dateProtocol) {
        try {
            $res = WebServices::RequestStatusChange($idPersonRequest, $idStatus, $numberProtocol, $dateProtocol);
            $res = CJSON::decode($res);
            if ($res["error"]) {
                throw new Exception(" Помилка - " . $res["message"]);
            } else {
                echo "<span style='color: green;'> " . $res["message"] . "</span>";
            }
        } catch (Exception $exc) {
            echo "<span style='color: red;'> " . $exc->getMessage() . "</span>";
        }
    }
     public function actionChangedoc($edboID) {
        try {
            $res = WebServices::RequestDocStatusChange($edboID);
            $res = CJSON::decode($res);
            if ($res["error"]) {
                throw new Exception(" Помилка - " . $res["message"]);
            } else {
                echo "<span style='color: green;'>  ok!  </span>";
            }
        } catch (Exception $exc) {
            echo "<span style='color: red;'> " . $exc->getMessage() . "</span>";
        }
    }

    public function actionConvert() {
        /*
          $spec = Personspeciality::model()->findAll("CoursedpID > 0");
          if (!empty($spec)) {
          $i = 1;
          foreach ($spec as $item) {
          //$item = new Personspeciality();
          echo $i . ". " . $item->PersonID . " : " . $item->idPersonSpeciality;
          //Personbenefits::model()->deleteAll("PersonID = {$item->PersonID} and BenefitID = 41");
          $ben = new Personbenefits('CONVERT');

          $ben->PersonID = $item->PersonID;
          $ben->BenefitID = 41;
          if ($ben->save()) {
          echo " додано пільгу " . $ben->idPersonBenefits;
          $sb = new Personspecialitybenefits();
          $sb->PersonBenefitID = $ben->idPersonBenefits;
          $sb->PersonSpecialityID = $item->idPersonSpeciality;
          if ($sb->save()) {
          echo " додано пільгу до заявки " . $ben->idPersonBenefits;
          }
          } else {
          echo " Помилка персони! - пільга вже існує! ";
          $ben = Personbenefits::model()->find("PersonID = {$item->PersonID} and BenefitID = 41");

          $sb = Personspecialitybenefits::model()->find("PersonBenefitID = {$ben->idPersonBenefits} and PersonSpecialityID = {$item->idPersonSpeciality}");
          if (empty($sb)) {
          $sb = new Personspecialitybenefits();

          $sb->PersonBenefitID = $ben->idPersonBenefits;
          $sb->PersonSpecialityID = $item->idPersonSpeciality;
          if ($sb->save()) {
          echo " додано пільгу до заявки " . $ben->idPersonBenefits;
          }
          } else {
          echo " Помилка заявки! - Пільга вже існує " . $ben->idPersonBenefits;
          }
          //print_r($ben->getErrors());
          }

          echo "<br>";
          $i++;
          }

          }
         */
    }

}
