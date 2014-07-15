<?php

class EdeboController extends Controller {

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
                'actions' => array('index', "Changestatus"),
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
        if (isset($_POST['EdeboStatusChange'])) {
            $model->attributes = $_POST['EdeboStatusChange'];
            if ($model->validate()) {

                try {
                    $res = WebServices::getRequestsByStatus($model->StatusID, $model->QualificationID, date("Y-m-d", strtotime($model->Data)));
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                }
            }
        }
        $this->render('index', array('model' => $model, 'res' => $res));
    }
    public function actionChangestatus() {
        echo "ok!";
    }


}
