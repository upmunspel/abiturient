<?php

class RatingController extends Controller {

  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout = '//layouts/column2';
  public $defaultAction = 'rating';

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
        'ajaxOnly + Refresh, Edboupdate, Studupdate',
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
            'actions' => array("rating", "excelrating", 'ratinglinks'),
            'users' => array('*'),
        ),
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
            'actions' => array(
                "edbodata"
            ),
            'users' => array('@'),
        ),
        array('deny', // deny all users
            'users' => array('*'),
        ),
    );
  }
  
  /**
   * Формування рейтингу та звірення даних з ЄДЕБО.
   */
  public function actionRating(){
    $reqPersonspeciality = Yii::app()->request->getParam('Personspeciality',null);
    $reqFaculty = Yii::app()->request->getParam('Facultets',null);
    $reqBenefits = Yii::app()->request->getParam('Benefit',null);
    
    $model = new Personspeciality();
    $model->rating_order_mode = 0;
    
    if (isset($reqPersonspeciality['rating_order_mode'])){
      $model->rating_order_mode = $reqPersonspeciality['rating_order_mode'];
      if ($model->rating_order_mode){
        $model->SepcialityID = $reqPersonspeciality['SepcialityID'];
      }
    }
    
    $faculty = new Facultets('search');
    $benefit = new Benefit('search');
    if (!$model->rating_order_mode){
      $faculty->unsetAttributes();  // clear any default values
      if ($reqFaculty){
        $faculty->attributes = $reqFaculty;
      }
      $benefit->unsetAttributes();  // clear any default values
      if ($reqBenefits){
        $benefit->attributes = $reqBenefits;
      }
    }
    $model->searchFaculty = $faculty;
    $model->searchBenefit = $benefit;
    
    if (isset($reqPersonspeciality['searchID']) && !$model->rating_order_mode){
      $model->searchID = $reqPersonspeciality['searchID'];
    }
    if (isset($reqPersonspeciality['NAME']) && !$model->rating_order_mode){
      $model->NAME = $reqPersonspeciality['NAME'];
    }
    if (isset($reqPersonspeciality['SPEC']) && !$model->rating_order_mode){
      $model->SPEC = $reqPersonspeciality['SPEC'];
    }
    if (isset($reqPersonspeciality['status_confirmed'])){
      $model->status_confirmed = $reqPersonspeciality['status_confirmed'];
    }
    if (isset($reqPersonspeciality['status_committed'])){
      $model->status_committed = $reqPersonspeciality['status_committed'];
    }
    if (isset($reqPersonspeciality['status_submitted'])){
      $model->status_submitted = $reqPersonspeciality['status_submitted'];
    }
    if (isset($reqPersonspeciality['mistakes_only']) && !$model->rating_order_mode){
      $model->mistakes_only = $reqPersonspeciality['mistakes_only'];
    }
    if (isset($reqPersonspeciality['edbo_mode']) && !$model->rating_order_mode){
      $model->edbo_mode = $reqPersonspeciality['edbo_mode'];
    }
    if (isset($reqPersonspeciality['page_size']) && !$model->rating_order_mode){
      $model->page_size = $reqPersonspeciality['page_size'];
    }
    
    $data = $model->search_rel();
    $this->layout = '//layouts/main';
    $this->render('/personspeciality/rating',array(
       'model' => $model,
       'data' => $data,
    ));
  }
  
  /**
   * Формування XLS-файлу з рейтингом конкретної спеціальності
   */
  public function actionExcelrating(){
    $reqPersonspeciality = Yii::app()->request->getParam('Personspeciality',null);
    $reqFaculty = Yii::app()->request->getParam('Facultets',null);
    $reqBenefits = Yii::app()->request->getParam('Benefit',null);
    $reqToExcel = Yii::app()->request->getParam('toexcel',1);

    $model = new Personspeciality();
    if (isset($reqPersonspeciality['rating_order_mode'])){
      $model->rating_order_mode = $reqPersonspeciality['rating_order_mode'];
      if ($model->rating_order_mode){
        $model->SepcialityID = $reqPersonspeciality['SepcialityID'];
      }
    }
    $faculty = new Facultets('search');
    $benefit = new Benefit('search');
    if (!$model->rating_order_mode){
      $faculty->unsetAttributes();  // clear any default values
      if ($reqFaculty){
        $faculty->attributes = $reqFaculty;
      }
      $benefit->unsetAttributes();  // clear any default values
      if ($reqBenefits){
        $benefit->attributes = $reqBenefits;
      }
      if (isset($reqPersonspeciality['SPEC'])){
        $model->SPEC = $reqPersonspeciality['SPEC'];
      }
    }
    $model->searchFaculty = $faculty;
    $model->searchBenefit = $benefit;
    if (isset($reqPersonspeciality['status_confirmed'])){
      $model->status_confirmed = $reqPersonspeciality['status_confirmed'];
    }
    if (isset($reqPersonspeciality['status_committed'])){
      $model->status_committed = $reqPersonspeciality['status_committed'];
    }
    if (isset($reqPersonspeciality['status_submitted'])){
      $model->status_submitted = $reqPersonspeciality['status_submitted'];
    }
    //повертається масив моделей
    $models = $model->search_rel(true);
    if (count($models)){
        $_data = $this->CreateRatingData($models);
        $_data['toexcel'] = $reqToExcel;
        $this->layout = '//layouts/clear';
        $this->render('/personspeciality/excelrating',$_data);
    } else {
        echo 'Помилка - немає даних!';
    }
  }
  
  /**
   * Метод формує рейтингові дані для конкретної спеціальності.
   * @param Personspeciality[] $models масив моделей, що повертає метод search_rel
   * @return array
   */
  protected function CreateRatingData($models){
        $Speciality = iconv("utf-8", "windows-1251",
                $models[0]->SPEC);
        $Faculty = iconv("utf-8", "windows-1251",
                $models[0]->sepciality->facultet->FacultetFullName);
        $_contract_counter = $models[0]->sepciality->SpecialityContractCount;
        $_budget_counter = $models[0]->sepciality->SpecialityBudgetCount;
        $_pzk_counter = $models[0]->sepciality->Quota1;
        $_quota_counter = $models[0]->sepciality->Quota2;
        Personspeciality::setCounters(
                $_contract_counter, 
                $_budget_counter, 
                $_pzk_counter, 
                $_quota_counter);

        $u_max_info_row = array();
        $info_row = array();

        $i = 0;
        $qpzk = 0;
        $u = 0;
        
        $data['pzk'] = array();
        $data['quota'] = array();
        $data['budget'] = array();
        $data['contract'] = array();
        $data['below'] = array();
        $below_counter = 0;
        
        foreach ($models as $model){
          $info_row['PIB'] = iconv("utf-8", "windows-1251",$model->NAME);
          $info_row['Points'] = $model->ComputedPoints;
          $info_row['isPZK'] = ($model->isOutOfComp || $model->Quota1)? '+': '';
          $info_row['isExtra'] = ($model->isExtraEntry)? '+': '';
          $info_row['isOriginal'] = (!$model->isCopyEntrantDoc)? '+': '';
          $was = 0;
          if ((Personspeciality::$is_rating_order) && $model->Quota1){
            //цільовики
            $was = Personspeciality::decrementCounter(Personspeciality::$C_QUOTA);    
            if ($was){
              Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
              $local_counter = 1 + $_quota_counter - $was;
              $data['quota'][$local_counter] = $info_row;
              $qpzk++;
            } else {
              $info_row['isPZK'] = 'Z';
              if ($u == 0){
                $u_max_info_row = $info_row;
              } else if ( (float)$u_max_info_row['Points'] < (float)$info_row['Points'] ){
                $u_max_info_row = $info_row;
              }
              $data['u'][$u++] = $info_row;
              $i++;
              continue;
            }
          }

          if ((Personspeciality::$is_rating_order) && $model->isOutOfComp && !$model->Quota1){
            //поза конкурсом
            $was = Personspeciality::decrementCounter(Personspeciality::$C_OUTOFCOMPETITION);
            if ($was){
              Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
              $local_counter = 1 + $_pzk_counter - $was;
              $data['pzk'][$local_counter] = $info_row;
              $qpzk++;
            } else {
              $info_row['isPZK'] = 'Z';
              if ($u == 0){
                $u_max_info_row = $info_row;
              } else if ( (float)$u_max_info_row['Points'] < (float)$info_row['Points'] ){
                $u_max_info_row = $info_row;
              }
              $data['u'][$u++] = $info_row;
              $i++;
              continue;
            }
          }

          if ( (Personspeciality::$is_rating_order) && (
                  ( $model->isBudget && !$model->isOutOfComp && !$model->Quota1 ) || 
                  (!empty($data['u']) && !$model->isOutOfComp && !$model->Quota1 )) ){
            //на бюджет
            while (!empty($data['u']) && ( (float)$u_max_info_row['Points'] > (float)$info_row['Points'])){
              $was = Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
              if ($was){
                $local_counter = 1 + $_budget_counter - $was - $qpzk;
                $data['budget'][$local_counter] = $u_max_info_row;
              }
              else {
                $was = Personspeciality::decrementCounter(Personspeciality::$C_CONTRACT);
                if ($was){
                  $local_counter = 1 + $_contract_counter - $was;
                  $data['contract'][$local_counter] = $u_max_info_row;
                }
                else {
                  break;
                }
              }
              $p_max = 0.0;
              foreach ($data['u'] as $u_id => $d_u){
                if ($d_u['PIB'] == $u_max_info_row['PIB'] && $d_u['Points'] == $u_max_info_row['Points']){
                  unset($data['u'][$u_id]);
                  continue;
                }
                if ((float)$d_u['Points'] > $p_max){
                  $p_max = (float)$d_u['Points'];
                  $u_max_info_row = $d_u;
                }
              }
            }
            $was = Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
            if ($was){
              $local_counter = 1 + $_budget_counter - $was - $qpzk;
              $data['budget'][$local_counter] = $info_row;
              $i++;
              continue;
            }
          }

          if ((Personspeciality::$is_rating_order) && 
                  ((!$model->isBudget && !$model->isOutOfComp && !$model->Quota1) || 
                  (!$was && $model->isBudget && !$model->isOutOfComp && !$model->Quota1) )){
            //на контракт
            while (!empty($data['u']) && ( (float)$u_max_info_row['Points'] > (float)$info_row['Points'])){
              $was = Personspeciality::decrementCounter(Personspeciality::$C_CONTRACT);
              if ($was){
                $local_counter = 1 + $_contract_counter - $was;
                $data['contract'][$local_counter] = $u_max_info_row;
              }
              if (!$was){
                break;
              }
              $p_max = 0.0;
              foreach ($data['u'] as $u_id => $d_u){
                if ($d_u['PIB'] == $u_max_info_row['PIB'] && $d_u['Points'] == $u_max_info_row['Points']){
                  unset($data['u'][$u_id]);
                  continue;
                }
                if ((float)$d_u['Points'] > $p_max){
                  $p_max = (float)$d_u['Points'];
                  $u_max_info_row = $d_u;
                }
              }
            }
            $was = Personspeciality::decrementCounter(Personspeciality::$C_CONTRACT);
            if ($was){
              $local_counter = 1 + $_contract_counter - $was;
              $data['contract'][$local_counter] = $info_row;
              $i++;
              continue;
            }
          }
          
          if (!$was){
            while (!empty($data['u']) && ( (float)$u_max_info_row['Points'] > (float)$info_row['Points'])){
              $data['below'][$below_counter++] = $u_max_info_row;
              $p_max = 0.0;
              foreach ($data['u'] as $u_id => $d_u){
                if ($d_u['PIB'] == $u_max_info_row['PIB'] && $d_u['Points'] == $u_max_info_row['Points']){
                  unset($data['u'][$u_id]);
                  continue;
                }
                if ((float)$d_u['Points'] > $p_max){
                  $p_max = (float)$d_u['Points'];
                  $u_max_info_row = $d_u;
                }
              }
            }
            $data['below'][$below_counter++] = $info_row;
          }
          $i++;
        }
        return array('data'=>$data,
            'Speciality'=>$Speciality,
            'Faculty'=>$Faculty,
            '_contract_counter'=>$_contract_counter,
            '_budget_counter'=>$_budget_counter,
            '_pzk_counter'=>$_pzk_counter,
            '_quota_counter'=>$_quota_counter,
            );
  }
  
  public function actionRatinglinks(){
    foreach (Specialities::model()->findAll() as $spec){
      echo "http://10.1.103.26/abiturient/rating/rating/excelrating?&Personspeciality%5BSepcialityID%5D=".$spec->idSpeciality."&Personspeciality%5Brating_order_mode%5D=1&Personspeciality%5Bstatus_confirmed%5D=0&Personspeciality%5Bstatus_committed%5D=0&Personspeciality%5Bstatus_submitted%5D=1<br/>";
      echo "http://10.1.103.26/abiturient/rating/rating/excelrating?&Personspeciality%5BSepcialityID%5D=".$spec->idSpeciality."&Personspeciality%5Brating_order_mode%5D=1&Personspeciality%5Bstatus_confirmed%5D=1&Personspeciality%5Bstatus_committed%5D=0&Personspeciality%5Bstatus_submitted%5D=1<hr/>";
    }
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
