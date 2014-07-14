<?php

class DirectoryController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

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
                /* array('allow',  // allow all users to perform  actions
                  'actions'=>array('login', 'error', 'captcha', 'index','contact',"logout"),
                  'users'=>array('*'),
                  ),
                  /*array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions'=>array('contact'),
                  'users'=>array('@'),
                  ),
                  array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions'=>array('index','logout'),
                  'users'=>array('@'),
                  ), */
                /* array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions'=>array('admin','delete'),
                  'users'=>array('admin'),
                  ),
                  array('deny',  // deny all users
                  'users'=>array('*'),
                  ), */
        );
    }

    public function actionSchools($code) {
        $result = array();

        if (isset($_GET["masklen"])) {
            $result = Schools::DropDown($code, intval($_GET["masklen"]));
        } else {
            $result = Schools::DropDown($code);
        }
        echo CJSON::encode($result);
        Yii::app()->end();
    }

    /**
     * Контроллер для работы выбора школ при редактировании персоны
     */
    public function actionSchool($q, $page_limit, $page, $area = "") {

        $result = array("more" => false, 'results' => array());
        $count = 0;
        $subcount = 0;

        $text = "";
        $criteria = $this->getSearchCondition("SchoolName", $q, $page_limit, $page);
        
        if (!empty($area)) {
            $req = explode(";", $area);
            $criteria->addSearchCondition("KOATUUCode", substr($req[1], 0, 2));
            if (count($req) > 1 && $req[0] > 0) {
                $criteria->addSearchCondition("KOATUUCode", substr($req[1], 0, 2));
            }
        }

        $model = Schools::model()->findall($criteria);
        $criteria->offset = -1;
        $criteria->limit = -1;
        $count += Schools::model()->count("SchoolName LIKE  '%" . $q . "%'");
        $subcount +=($page - 1) * $page_limit + count($model);
        foreach ($model as $val) {

            $result['results'][] = array("id" => $val->idSchool, "text" => $val->SchoolName);
        }

        if ($count > $subcount) {
            $result['more'] = true;
        }
        $result['count'] = $count;
        $result['subcount'] = $subcount;


        echo CJSON::encode($result);
    }

    /**
     * Контроллер для работы выбора школ при редактировании персоны
     */
    public function actionSchoolr($id) {


        $result = array();
        $text = "";
        $model = Schools::model()->find("idSchool = $id");
        if (!empty($model)) {
            $text = $model->SchoolName;
        }

        $result = array("id" => $id, 'text' => $text);

        echo CJSON::encode($result);
    }

    /**
     * Контроллер для работы выбора адреса при редактировании персоны
     */
    public function actionKoatur($id) {

        $req = explode(";", $id);

        $result = array();
        $text = "";

        if (count($req) > 1 && $req[0] > 0) {
            //PC::debug($req[0] );
            $model = KoatuuLevel1::model()->find("idKOATUULevel1 = {$req[0]}");
            if (!empty($model)) {
                $text = $model->KOATUULevel1FullName;
                // PC::debug($text);
            }

            if (empty($model)) {
                $model = KoatuuLevel2::model()->find("idKOATUULevel2 = {$req[0]}");
                if (!empty($model)) {
                    $text = $model->KOATUULevel2FullName;
                    //PC::debug($text);
                }
                if (empty($model)) {
                    $model = KoatuuLevel3::model()->find("idKOATUULevel3 = {$req[0]}");
                    if (!empty($model)) {
                        $text = $model->KOATUULevel3FullName;
                        //PC::debug($text);
                    }
                }
            }

            $result = array("id" => $id, 'text' => $text);
        }
        echo CJSON::encode($result);
    }

    protected function getSearchCondition($field, $q, $page_limit, $page) {
        $criteria = new CDbCriteria();
        $q = trim($q);

        if (substr_count($q, " ", 0) > 0) {// нсколько слов
            $q = explode(" ", $q);
            foreach ($q as $v) {
                $criteria->addSearchCondition($field, trim($v));
            }
        } else {
            $criteria->addSearchCondition($field, $q);
        }

        $criteria->limit = $page_limit;
        $criteria->offset = ($page - 1) * $page_limit;

        //PC::debug($criteria->condition.print_r($criteria->params,1));

        return $criteria;
    }

    /**
     * Контроллер для работы выбора адреса при редактировании персоны
     */
    public function actionKoatu($q, $page_limit, $page) {

        $result = array("more" => false, 'results' => array());
        $count = 0;
        $subcount = 0;

        $criteria = $this->getSearchCondition("KOATUULevel1FullName", $q, $page_limit, $page);
        $model = KoatuuLevel1::model()->findall($criteria);
        $criteria->offset = -1;
        $criteria->limit = -1;
        $count += KoatuuLevel1::model()->count($criteria);
        $subcount+=($page - 1) * $page_limit + count($model);

        foreach ($model as $val) {

            $result['results'][] = array("id" => $val->idKOATUULevel1 . ";" . $val->KOATUULevel1Code, "text" => $val->KOATUULevel1FullName);
        }
        $criteria = $this->getSearchCondition("KOATUULevel2FullName", $q, $page_limit, $page);
        $model = KoatuuLevel2::model()->findall($criteria);
        $criteria->offset = -1;
        $criteria->limit = -1;
        $count += KoatuuLevel2::model()->count($criteria);
        $subcount+=($page - 1) * $page_limit + count($model);
        foreach ($model as $val) {

            $result['results'][] = array("id" => $val->idKOATUULevel2 . ";" . $val->KOATUULevel2Code, "text" => $val->KOATUULevel2FullName);
        }
        $criteria = $this->getSearchCondition("KOATUULevel3FullName", $q, $page_limit, $page);
        $model = KoatuuLevel3::model()->findall($criteria);
        $criteria->offset = -1;
        $criteria->limit = -1;
        $count += KoatuuLevel3::model()->count($criteria);
        $subcount+=($page - 1) * $page_limit + count($model);
        foreach ($model as $val) {
            //$val = new KoatuuLevel3();
            $result['results'][] = array("id" => $val->idKOATUULevel3 . ";" . $val->KOATUULevel3Code, "text" => $val->KOATUULevel3FullName);
        }
        if ($count > $subcount) {
            $result['more'] = true;
        }
        //PC::debug($count);
        //PC::debug($subcount);
        echo CJSON::encode($result);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionKoatuu($id, $level) {
        $result = array();
        $result["Code"] = "0000000000";
        $result["id"] = 0;
        $key = 0;
        if ($level == "1") {
            $result["Level2"] = KoatuuLevel2::DropDown($id);
            if (count($result["Level2"]) > 0) {
                foreach ($result["Level2"] as $key => $val)
                    break;
                $result["Level3"] = KoatuuLevel3::DropDown($key);
                // echo "Line 1 key = $key";
                if (count($result["Level3"]) > 0) {
                    //echo "Line 2 key = $key";
                    foreach ($result["Level3"] as $key1 => $val)
                        break;
                    $result["Code"] = KoatuuLevel3::getKoatuuLevelCode($key1);
                    $result["id"] = $key1;
                } else {
                    //echo "Line 3 key = $key";
                    $result["Level3"] = array();
                    $result["Code"] = KoatuuLevel2::getKoatuuLevel2Code($key);
                    $result["id"] = $key;
                    //echo "Line4 key = $key";
                }
            } else {
                $result["Level3"] = array();
                $result["Level2"] = array();
                $result["Code"] = KoatuuLevel1::getKoatuuLevelCode($id);
                $result["id"] = $id;
            }
        } else if ($level == "2") {
            $result["Level2"] = array();
            $result["Level3"] = KoatuuLevel3::DropDown($id);
            if (count($result["Level3"]) > 0) {
                foreach ($result["Level3"] as $key => $val)
                    break;
                $result["Code"] = KoatuuLevel3::getKoatuuLevelCode($key);
                $result["id"] = $key;
            } else {

                $result["Level3"] = array();
                $result["Code"] = KoatuuLevel2::getKoatuuLevel2Code($id);
                $result["id"] = $id;
            }
        } else if ($level == "3") {
            $result["Level2"] = array();
            $result["Level3"] = array();
            $result["Code"] = KoatuuLevel3::getKoatuuLevelCode($id);
            $result["id"] = $id;
        }


        echo CJSON::encode($result);
        Yii::app()->end();
    }

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionTest() {
        $res = KoatuuLevel1::getKoatuuLevelID("2310100000");

        var_dump($res);

        $res = KoatuuLevel2::getKoatuuLevelID("2310100000");

        var_dump($res);


        $res = KoatuuLevel3::getKoatuuLevelID("2310100000");

        var_dump($res);
    }

    /**
     * Displays the contact page
     */
    /**
     * Displays the login page
     */
    /* public function actionLogin()
      {
      $model=new LoginForm;
      $this->layout="//layouts/main";
      // if it is ajax validation request
      if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
      {
      echo CActiveForm::validate($model);
      Yii::app()->end();
      }

      // collect user input data
      if(isset($_POST['LoginForm']))
      {
      $model->attributes=$_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if($model->validate() && $model->login())
      $this->redirect(Yii::app()->user->returnUrl);
      }
      // display the login form */

    /* 	$this->render('login',array('model'=>$model));
      } */

    /**
     * Logs out the current user and redirect to homepage.
     */
}
