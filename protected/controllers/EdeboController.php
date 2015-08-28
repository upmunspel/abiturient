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
                'actions' => array('index', "Changestatus", "Changedoc", "educationsinfo", 
                    "Photosend", "Photosendproc",  "docsend", "docsendproc"),
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
        if (isset($_REQUEST["idRequestSpeciality"])) {
            $idRequestSpeciality = $_REQUEST["idRequestSpeciality"];
            $models = Personspeciality::model()->findAll("SepcialityID = :id", array("id" => $_REQUEST["idRequestSpeciality"]));
            foreach ($models as $item) {
                //$item = new Personspeciality();
                if (!empty($item->edboID)) {
                    $request_list[] = $item->edboID;
                }
            }
            //$request_list = CJSON::encode($request_list);
        }


        //$res =  CJSON::encode(array(1,2,3,4,5,6,7,8,9,10));

        $this->render('index', array('model' => $model, 'res' => $res, "request_list" => $request_list, "idRequestSpeciality" => $idRequestSpeciality));
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

    public function actionEducationsinfo($idSpeciality) {

        $this->render("educationsinfo", array("specid" => $idSpeciality));
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

    public function actionPhotosend() {
        if (isset($_REQUEST["idSpeciality"])) {
            $model = Personspeciality::model()->findAll("SepcialityID = " . $_REQUEST["idSpeciality"] . " and StatusID in (7)");
        } elseif (isset($_REQUEST["idQualification"])) {
            $model = Personspeciality::model()->findAll("QualificationID = " . $_REQUEST["idQualification"] . " and StatusID in (7)");
        } elseif (!isset($_REQUEST["idPersons"])|| trim($_REQUEST["idPersons"]) == "") {
            $model = Personspeciality::model()->findAll("StatusID = 7");
        }
        $res = array();
        if (!isset($_REQUEST["idPersons"]) || trim($_REQUEST["idPersons"]) == "") {
            foreach ($model as $item) {
                $res[] = $item->person->idPerson;
            }
        } else {
            $model = Person::model()->findAll("idPerson in (" . $_REQUEST["idPersons"] . ")");
            foreach ($model as $item) {
                $res[] = $item->idPerson;
            }
        }
        $this->render("proces/photo", array("res" => json_encode($res)));
    }

    public function actionPhotosendproc() {
        if (isset($_REQUEST["idPerson"])) {
            try {
                $model = Person::model()->find("idPerson = " . $_REQUEST["idPerson"]);

                $path = Yii::app()->basePath . "/.." . Yii::app()->params['photosBigPath'];
                $id = $model->idPerson;
                $tfio = $model->PhotoName;
                $file = $path . $tfio;
                if (file_exists($file)) {
                    // $data = file_get_contents($file);
                    //$type = pathinfo($file, PATHINFO_EXTENSION);
                    //$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $img = EWideImage::loadFromFile($file);
                    $tmp_name = $path . md5(time()) . ".jpg";

                    $img->resize(255, null)->saveToFile($tmp_name);
                    $data = file_get_contents($tmp_name);

                    $base64 = base64_encode($data);

                    $res = WebServices::updatePersonPhoto($model->codeU, $base64);

                    if (file_exists($tmp_name)) {
                        unlink($tmp_name);
                    }
                    if ($res == 1) {
                        echo $model->codeU . " : ok!";
                    } else {
                        echo $model->codeU . " : error!";
                    }
                } else {
                    echo "Фото відсутне! ($file)";
                }
            } catch (Exception $ex) {
                if (file_exists($tmp_name)) {
                    unlink($tmp_name);
                }
                echo $ex->getMessage();
            }
        } else {
            echo "Необхыдно вказати ідентифікатор персони.";
        }
    }
    
    public function actionDocsend() {
        if (isset($_REQUEST["idSpeciality"])) {
            $model = Personspeciality::model()->findAll("SepcialityID = " . $_REQUEST["idSpeciality"] . " and StatusID in (7)");
        } elseif (isset($_REQUEST["idQualification"])) {
            $model = Personspeciality::model()->findAll("QualificationID = " . $_REQUEST["idQualification"] . " and StatusID in (7)");
        } elseif (!isset($_REQUEST["idPersons"])|| trim($_REQUEST["idPersons"]) == "") {
            $model = Personspeciality::model()->findAll("StatusID = 7");
        }
        $res = array();
        if (!isset($_REQUEST["idPersons"]) || trim($_REQUEST["idPersons"]) == "") {
            foreach ($model as $item) {
                $res[] = $item->person->idPerson;
            }
        } else {
            $model = Person::model()->findAll("idPerson in (" . $_REQUEST["idPersons"] . ")");
            foreach ($model as $item) {
                $res[] = $item->idPerson;
            }
        }
        $this->render("proces/doc", array("res" => json_encode($res)));
    }

    public function actionDocsendproc() {
        if (isset($_REQUEST["idPerson"])) {
            try {
                $res = WebServices::updatePersonDoc($_REQUEST["idPerson"]);
                $msg = "<ul>";
                $res = CJSON::decode($res);
                
                foreach($res as $item){
                    $item = (object)$item;
                    $doc = PersonDocumentTypes::model()->find("idPersonDocumentTypes = ".$item->idType);
                    $msg.= "<li>".$doc->PersonDocumentTypesName." - ";
                    if ($item->editStatus == 1){
                      $msg.= "ок!";
                    } else {
                       $msg.= "error! - ".$item->message; 
                    }
                    $msg.="</li>";
                }
                $msg.= "</ul>";
                echo $msg;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        } else {
            echo "Необхыдно вказати ідентифікатор персони.";
        }
    }

}
