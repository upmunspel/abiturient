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
            'actions' => array("rating", "excelrating", 
            'ratinglinks', 'ratinginfo', 'ratinginfolinks'),
            'users' => array('*'),
        ),
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
            'actions' => array(
                "edbodata"
            ),
            'users' => array('@'),
        ),
        array('allow',
            'actions' => array(
                "ratingcontacts"
            ),
            'roles' => array('Root','Admin'),
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
    if (isset($reqPersonspeciality['QualificationID']) && !$model->rating_order_mode){
      $model->QualificationID = $reqPersonspeciality['QualificationID'];
    }
    if (isset($reqPersonspeciality['CourseID']) && !$model->rating_order_mode){
      $model->CourseID = $reqPersonspeciality['CourseID'];
    }
    if (isset($reqPersonspeciality['DateFrom']) && !$model->rating_order_mode){
      $model->DateFrom = $reqPersonspeciality['DateFrom'];
    }
    if (isset($reqPersonspeciality['DateTo']) && !$model->rating_order_mode){
      $model->DateTo = $reqPersonspeciality['DateTo'];
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
    if (isset($reqPersonspeciality['ext_param']) && !$model->rating_order_mode){
      $model->ext_param = $reqPersonspeciality['ext_param'];
    }
    if (isset($reqPersonspeciality['ForeignOnly']) && !$model->rating_order_mode){
      $model->ForeignOnly = $reqPersonspeciality['ForeignOnly'];
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
    $reqViewContacts = Yii::app()->request->getParam('contacts',null);

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
        $_data['contacts'] = (in_array('Root',Yii::app()->user->getUserRoles())) ? $reqViewContacts : 0;
        $this->layout = '//layouts/clear';
        $this->renderPartial('/personspeciality/excelrating',$_data);
    } else {
        echo 'Помилка - немає даних!';
    }
  }

  /**
   * Формування XLS-файлу з рейтингом для усіх спеціальностей факультету
   */
  public function actionRatingcontacts($id){
    $reqToExcel = Yii::app()->request->getParam('toexcel',0);
    $specs_of_faculty = array();
    $faculty_model = false;
    if (is_numeric($id) && $id > 0){
      $fcriteria = new CDbCriteria();
      $fcriteria->compare('FacultetID',$id);
      $fcriteria->order = 'SpecialityName ASC, SpecialityDirectionName ASC, PersonEducationFormID ASC';
      $specs_of_faculty = Specialities::model()->findAll($fcriteria);
      $faculty_model = Facultets::model()->findByPk($id);
    }
    if (empty($specs_of_faculty) || !$faculty_model){
      throw new Exception ("Помилка: для факультета з ID = ".$id
              .' не знайшлося напрямів або такий не існує.');
    }
    $this->renderPartial('/personspeciality/ratingcontacts_header',
            array('Faculty'=>$faculty_model->idFacultet,
               'toexcel' => $reqToExcel));
    foreach ($specs_of_faculty as $spec_model){
      $model = new Personspeciality();
      $model->rating_order_mode = 1;
      $model->SepcialityID = $spec_model->idSpeciality;
      $faculty = new Facultets('search');
      $benefit = new Benefit('search');
      $model->searchFaculty = $faculty;
      $model->searchBenefit = $benefit;

      //повертається масив моделей
      $models = $model->search_rel(true);
      if (count($models)){
          $_data = $this->CreateRatingData($models);
          $_data['toexcel'] = $reqToExcel;
          $_data['contacts'] = (in_array('Root',Yii::app()->user->getUserRoles())) 
                  ? 1 : 0;
          $this->layout = '//layouts/clear';
          $this->renderPartial('/personspeciality/rating_contacts',$_data);
      }
    }
    $this->renderPartial('/personspeciality/ratingcontacts_footer',array());
  }
  
  /**
   * Формування рейтингів конкретної спеціальності у стилі ВступІнфо
   */
  public function actionRatinginfo(){
    $reqPersonspeciality = Yii::app()->request->getParam('Personspeciality',null);
    $reqFaculty = Yii::app()->request->getParam('Facultets',null);
    $reqBenefits = Yii::app()->request->getParam('Benefit',null);

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
        $_data = $this->CreateRatingInfoData($models);
        $this->layout = '//layouts/clear';
        $this->renderPartial('/personspeciality/ratinginfo',$_data);
    } else {
        $criteria = new CDbCriteria();
        $criteria->compare('idSpeciality',$reqPersonspeciality['SepcialityID']);
        $criteria->with = array('eduform','facultet');
        $criteria->select = array(
                new CDbExpression("concat_ws(' ',"
              . "SpecialityClasifierCode,"
              . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
              . "SpecialityDirectionName else SpecialityName end),"
              . "(case SpecialitySpecializationName when '' then '' "
              . " else concat('(',SpecialitySpecializationName,')') end)"
              . ",',',concat('форма: ',eduform.PersonEducationFormName)) AS tSPEC"),
        );
        $criteria->together = true;
        $spec = Specialities::model()->find($criteria);
        $Speciality = $spec->tSPEC;
        $Faculty = $spec->facultet->FacultetFullName;
        $_contract_counter = $spec->SpecialityContractCount;
        $_budget_counter = $spec->SpecialityBudgetCount;
        $_pzk_counter = $spec->Quota1;
        $_quota_counter = $spec->Quota2;
        $this->layout = '//layouts/clear';
        $this->renderPartial('/personspeciality/ratinginfo',array(
          'Speciality' => $Speciality,
          'Faculty' => $Faculty,
          '_contract_counter' => $_contract_counter,
          '_budget_counter' => $_budget_counter,
          '_pzk_counter' => $_pzk_counter,
          '_quota_counter' => $_quota_counter,
          'data' => array(),
        ));
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
          $info_row['isPZK'] = ($model->isOutOfComp)? '+': '';
          $info_row['isExtra'] = ($model->isExtraEntry)? '+': '';
          $info_row['isOriginal'] = (!$model->isCopyEntrantDoc)? '+': '';
          $info_row['idPersonSpeciality'] = $model->idPersonSpeciality;
          $was = 0;
          if ((Personspeciality::$is_rating_order) && $model->Quota1 && $model->isBudget){
            //цільовики
            $was = Personspeciality::decrementCounter(Personspeciality::$C_QUOTA);    
            if ($was){
              Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
              $local_counter = 1 + $_quota_counter - $was;
              $data['quota'][$local_counter] = $info_row;
              $qpzk++;
            } else {
              $info_row['isPZK'] = 'Q';
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

          if ((Personspeciality::$is_rating_order) && $model->isOutOfComp && !$model->Quota1
                  && $model->isBudget){
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
                  (!empty($data['u']) && !$model->isOutOfComp && !$model->Quota1 && $model->isBudget)) ){
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
            //усі інші
            $iter = 0;
            while (!empty($data['u']) && ( ( (float)$u_max_info_row['Points'] > (float)$info_row['Points'] ) || 
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isExtra'] == 'V') ||
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isPZK'] == 'V') )
              && ($iter < 2000)
              ){
              $data['below'][$below_counter++] = $u_max_info_row;
              foreach ($data['u'] as $u_id => $d_u){
                if ($d_u['PIB'] == $u_max_info_row['PIB'] && $d_u['Points'] == $u_max_info_row['Points']){
                  unset($data['u'][$u_id]);
                  $iter++;
                  break;
                }
                $iter++;
              }
              $p_max = 0.0;
              foreach ($data['u'] as $u_id => $d_u){
                if ( (float)$d_u['Points'] > $p_max ){
                  $u_max_info_row = $d_u;
                  $p_max = (float)$d_u['Points'];
                }
              }
            }
            $data['below'][$below_counter++] = $info_row;
          }
          $i++;
        }
        if (!empty($data['u'])){
            foreach ($data['u'] as $dblw){
                //додаємо залишок
                $data['below'][$below_counter++] = $dblw;
            }
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
  
  /**
   * Метод формує рейтингові дані в стилі ВступІнфо для конкретної спеціальності.
   * @param Personspeciality[] $models масив моделей, що повертає метод search_rel
   * @return array
   */
  protected function CreateRatingInfoData($models){
        $Speciality = $models[0]->SPEC;
        $Faculty = $models[0]->sepciality->facultet->FacultetFullName;
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
          $ZNO = 0+((!empty($model->documentSubject1))? $model->documentSubject1->SubjectValue : 0) +
            ((!empty($model->documentSubject2))? $model->documentSubject2->SubjectValue : 0)+
            ((!empty($model->documentSubject3))? $model->documentSubject3->SubjectValue : 0);
          $ExamsPoints = 0+$model->Exam1Ball+$model->Exam2Ball+$model->Exam3Ball;
          $info_row['PIB'] = $model->NAME;
          $info_row['Points'] = $model->ComputedPoints;
          $info_row['ZNO'] = $ZNO;
          $info_row['DocPoints'] = $model->ZnoDocValue;
          $info_row['ExamsPoints'] = $ExamsPoints;
          $info_row['OlympsPoints'] = 0+((!empty($model->olymp))? $model->olymp->OlympiadAwardBonus : 0);
          $info_row['CoursesPoints'] = 0+$model->CoursedpBall;
          $info_row['isPZK'] = ($model->isOutOfComp)? 'V': '—';
          $info_row['isExtra'] = ($model->isExtraEntry)? 'V': '—';
          $info_row['isQuota'] = ($model->Quota1)? 'V': '—';
          $info_row['isOriginal'] = (!$model->isCopyEntrantDoc)? 'V': '—';
          $info_row['AnyOriginal'] = ($model->AnyOriginal && $model->isCopyEntrantDoc)? 'V': '—';
          $info_row['idPersonSpeciality'] = $model->idPersonSpeciality;
          $was = 0;
          if ((Personspeciality::$is_rating_order) && $model->Quota1 && $model->isBudget){
            //цільовики
            $was = Personspeciality::decrementCounter(Personspeciality::$C_QUOTA);    
            if ($was){
              Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
              $local_counter = 1 + $_quota_counter - $was;
              $data['quota'][$local_counter] = $info_row;
              $qpzk++;
            } else {
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

          if ((Personspeciality::$is_rating_order) && $model->isOutOfComp && !$model->Quota1
                  && $model->isBudget){
            //поза конкурсом
            $was = Personspeciality::decrementCounter(Personspeciality::$C_OUTOFCOMPETITION);
            if ($was){
              Personspeciality::decrementCounter(Personspeciality::$C_BUDGET);
              $local_counter = 1 + $_pzk_counter - $was;
              $data['pzk'][$local_counter] = $info_row;
              $qpzk++;
            } else {
              $info_row['isPZK'] = 'V';
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
                  (!empty($data['u']) && !$model->isOutOfComp && !$model->Quota1 && $model->isBudget)) ){
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
            //усі інші
            $iter = 0;
            while (!empty($data['u']) && ( ( (float)$u_max_info_row['Points'] > (float)$info_row['Points'] ) || 
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isExtra'] == 'V') ||
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isPZK'] == 'V') )
              && ($iter < 2000)
              ){
              $data['below'][$below_counter++] = $u_max_info_row;
              foreach ($data['u'] as $u_id => $d_u){
                if ($d_u['PIB'] == $u_max_info_row['PIB'] && $d_u['Points'] == $u_max_info_row['Points']){
                  unset($data['u'][$u_id]);
                  $iter++;
                  break;
                }
                $iter++;
              }
              $p_max = 0.0;
              foreach ($data['u'] as $u_id => $d_u){
                if ( (float)$d_u['Points'] > $p_max ){
                  $u_max_info_row = $d_u;
                  $p_max = (float)$d_u['Points'];
                }
              }
            }
            $data['below'][$below_counter++] = $info_row;
          }
          $i++;
        }
        if (!empty($data['u'])){
            foreach ($data['u'] as $dblw){
                //додаємо залишок
                $data['below'][$below_counter++] = $dblw;
            }
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
    $criteria->order = 'SpecialityName ASC,SpecialityDirectionName ASC,SpecialityClasifierCode ASC';
    echo "<html><meta charset='utf8'><head></head><body><ul>";
    foreach (Specialities::model()->findAll($criteria) as $spec){
      $href = 'http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].'/abiturient/rating/rating/excelrating?&Personspeciality%5BSepcialityID%5D='.$spec->idSpeciality.'&Personspeciality%5Brating_order_mode%5D=1&Personspeciality%5Bstatus_confirmed%5D=1&Personspeciality%5Bstatus_committed%5D=0&Personspeciality%5Bstatus_submitted%5D=1&toexcel=0'; 
      echo "<li><a href='".$href."' target='_blank'>".$spec->tSPEC."</a></li>";
    }
    echo "</ul></body></html>";
  }
  
  public function actionRatinginfolinks(){
    $criteria = new CDbCriteria();
    $criteria->with = array('eduform');
    $criteria->together = true;
    $criteria->addCondition('eduform.idPersonEducationForm IN (1,2)');
    $criteria->addCondition('idSpeciality NOT IN(162738)');
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
    $criteria->order = 'SpecialityName ASC,SpecialityDirectionName ASC,SpecialityClasifierCode ASC, eduform.PersonEducationFormName ASC';
    echo "<html><meta charset='utf8'><head></head><body>";
    echo "<p style='text-align: right; font-family: \"Courier New\"; font-size: 8pt;'>Дані сформовано ".date('d.m.Y H:i')."</p>";
    echo "<h1 style='text-align: center;'>Інформація про подані абітурієнтами заяви</h1>";
    echo "<h3 style='text-align: center;'>Заяви на ОКР \"Бакалавр\"</h3>";
    echo "<ul>";
    $is_elder = false;
    foreach (Specialities::model()->findAll($criteria) as $spec){
      if ((mb_substr($spec->tSPEC,0,1,'utf-8') == '7' || mb_substr($spec->tSPEC,0,1,'utf-8') == '8') && (!$is_elder)){
        echo "</ul>";
        echo '<hr/>';
        echo "<h3 style='text-align: center;'>Заяви на ОКР \"Спеціаліст\" і \"Магістр\"</h3>";
        echo "<ul>";
        $is_elder= true;
      }
      $href = 'http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].'/abiturient/rating/rating/ratinginfo?&Personspeciality%5BSepcialityID%5D='.$spec->idSpeciality.'&Personspeciality%5Brating_order_mode%5D=1'; 
      echo "<li><a href='".$href."' target='_blank'>".$spec->tSPEC." ("
        .Personspeciality::model()->count('(SepcialityID='.$spec->idSpeciality . ' AND StatusID IN (1,4,5,7,8))')
        .")</a></li>";
    }
    echo "</ul><footer style='text-align: center;'>ЗНУ, Лабораторія ІС та КТ</footer></body></html>";
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
