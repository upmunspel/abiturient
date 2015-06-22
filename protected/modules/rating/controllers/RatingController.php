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
            'ratinglinks', 'ratinginfo', 'ratinginfolinks', 'edborating', 'edboratinglinks', 'ratinginfolinks6'),
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
    $reqToExcel = Yii::app()->request->getParam('toexcel',1);
    $reqViewContacts = Yii::app()->request->getParam('contacts',null);
    $model = new Personspeciality();
    $is_submitted = false;
    if (isset($reqPersonspeciality['status_confirmed'])){
      $model->status_confirmed = $reqPersonspeciality['status_confirmed'];
    }
    if (isset($reqPersonspeciality['status_committed'])){
      $model->status_committed = $reqPersonspeciality['status_committed'];
    }
    if (isset($reqPersonspeciality['status_submitted'])){
      $model->status_submitted = $reqPersonspeciality['status_submitted'];
      $is_submitted = $reqPersonspeciality['status_submitted'];
    }
    $model->SepcialityID = $reqPersonspeciality['SepcialityID'];
    $spec_quota_models = Specialityquotes::model()->findAll('SpecialityID='.$model->SepcialityID);
    $Speciality = Specialities::model()->findByPk($model->SepcialityID);
    $Faculty = $Speciality->facultet->FacultetFullName;
    $license = array();
    $budget = intval($Speciality->SpecialityBudgetCount);
    $license[3] = array(intval($Speciality->Quota1),1);
    $license[2] = array($budget,1);
    $license[1] = array(intval($Speciality->SpecialityContractCount),1);
    $license_info[0] = array('=====================',-1);
    $license_info[1] = array('За кошти фізичних або юридичних осіб',$license[1][0]);
    $license_info[2] = array('За кошти державного бюджету',$budget);
    $license_info[3] = array('Поза конкурсом',$license[3][0]);
    //var_dump($license_info);exit();
    $rating_data = array();
    $general_count = 0;
    foreach ($spec_quota_models as $sqm){
      $model->quota_budget_places = intval($sqm->BudgetPlaces);
      $license[$sqm->QuotaID] = array($model->quota_budget_places,0);
      $license_info[$sqm->QuotaID] = array($sqm->quota->QuotaName,$license[$sqm->QuotaID][0]);
      $model->param_quotaID = $sqm->QuotaID;
      $rating_data[$license_info[$sqm->QuotaID][0]] = $this->CreateRatingData($model->rating_search(0,true));
      $general_count += count($rating_data[$license_info[$sqm->QuotaID][0]]);
    }
    $rating_data[$license_info[3][0]] = $this->CreateRatingData($model->rating_search(1,true));
    $general_count += count($rating_data[$license_info[3][0]]);
    $rating_data[$license_info[2][0]] = $this->CreateRatingData($model->rating_search(2,true));
    $general_count += count($rating_data[$license_info[2][0]]);
    $rating_data[$license_info[1][0]] = $this->CreateRatingData($model->rating_search(3,true));
    $general_count += count($rating_data[$license_info[1][0]]);
    $rating_data[$license_info[0][0]] = $this->CreateRatingData($model->rating_search(4,true));
    $general_count += count($rating_data[$license_info[0][0]]);
    //var_dump($rating_data);exit();
    if ($general_count > 0){
        $_data = array(
          'data' => $rating_data,
          'Speciality' => implode(' ',array(
              $Speciality->SpecialityClasifierCode,
              (mb_substr($Speciality->SpecialityClasifierCode,0,1) == '6')? 
                $Speciality->SpecialityDirectionName : $Speciality->SpecialityName,
              empty($Speciality->SpecialitySpecializationName) ?
                "" : '('.$Speciality->SpecialitySpecializationName.')',
              'форма: '.$Speciality->eduform->PersonEducationFormName,
          )),
          'Faculty' => $Faculty,
          'license_info' => $license_info,
        );
        $_data['toexcel'] = $reqToExcel;
        $_data['contacts'] = (in_array('Root',Yii::app()->user->getUserRoles())) ? $reqViewContacts : 0;
        $this->layout = '//layouts/clear';
        if (mb_substr($_data['Speciality'],0,1,'utf-8') == '6'){
          $this->renderPartial('/personspeciality/excelrating',$_data);
        } else {
          $_data['spec_name'] = implode(' ',array((mb_substr($Speciality->SpecialityClasifierCode,0,1) == '6')? 
                $Speciality->SpecialityDirectionName : $Speciality->SpecialityName,
              empty($Speciality->SpecialitySpecializationName) ?
                "" : '('.$Speciality->SpecialitySpecializationName.')'));
          $_data['spec_eduform'] = $Speciality->eduform->PersonEducationFormName;
          $_data['is_submitted'] = $is_submitted;
          $this->renderPartial('/personspeciality/rating_specmag',$_data);
        }
    } else {
        echo 'Error: empty data.';
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
      $model->SepcialityID = $spec_model->idSpeciality;
      $spec_quota_models = Specialityquotes::model()->findAll('SpecialityID='.$model->SepcialityID);
      $Speciality = Specialities::model()->findByPk($model->SepcialityID);
      $Faculty = $Speciality->facultet->FacultetFullName;
      $license = array();
      $license_info = array();
      $budget = intval($Speciality->SpecialityBudgetCount);
      $license[3] = array(intval($Speciality->Quota1),1);
      $license[2] = array($budget,1);
      $license[1] = array(intval($Speciality->SpecialityContractCount),1);
      $license_info[0] = array('=====================',-1);
      $license_info[1] = array('За кошти фізичних або юридичних осіб',$license[1][0]);
      $license_info[2] = array('За кошти державного бюджету',$budget);
      $license_info[3] = array('Поза конкурсом',$license[3][0]);
      //var_dump($license_info);exit();
      $rating_data = array();
      $general_count = 0;
      foreach ($spec_quota_models as $sqm){
        $model->quota_budget_places = intval($sqm->BudgetPlaces);
        $license[$sqm->QuotaID] = array($model->quota_budget_places,0);
        $license_info[$sqm->QuotaID] = array($sqm->quota->QuotaName,$license[$sqm->QuotaID][0]);
        $model->param_quotaID = $sqm->QuotaID;
        $rating_data[$license_info[$sqm->QuotaID][0]] = $this->CreateRatingData($model->rating_search(0));
        $general_count += count($rating_data[$license_info[$sqm->QuotaID][0]]);
      }
      $rating_data[$license_info[3][0]] = $this->CreateRatingData($model->rating_search(1));
      $general_count += count($rating_data[$license_info[3][0]]);
      $rating_data[$license_info[2][0]] = $this->CreateRatingData($model->rating_search(2));
      $general_count += count($rating_data[$license_info[2][0]]);
      $rating_data[$license_info[1][0]] = $this->CreateRatingData($model->rating_search(3));
      $general_count += count($rating_data[$license_info[1][0]]);
      $rating_data[$license_info[0][0]] = $this->CreateRatingData($model->rating_search(4));
      $general_count += count($rating_data[$license_info[0][0]]);
      //var_dump($rating_data);exit();
      if ($general_count > 0){
          $_data = array(
            'data' => $rating_data,
            'Speciality' => implode(' ',array(
                $Speciality->SpecialityClasifierCode,
                (mb_substr($Speciality->SpecialityClasifierCode,0,1) == '6')? 
                  $Speciality->SpecialityDirectionName : $Speciality->SpecialityName,
                empty($Speciality->SpecialitySpecializationName) ?
                  "" : '('.$Speciality->SpecialitySpecializationName.')',
                'форма: '.$Speciality->eduform->PersonEducationFormName,
            )),
            'Faculty' => $Faculty,
            'license_info' => $license_info,
          );
          $_data['contacts'] = 1;
          $this->layout = '//layouts/clear';
          $this->renderPartial('/personspeciality/rating_contacts',$_data);
      }
      unset($model);
    }
    $this->renderPartial('/personspeciality/ratingcontacts_footer',array());
  }
  
  /**
   * Формування рейтингів конкретної спеціальності на основі даних ЄДЕБО
   */
  public function actionEdborating(){
    $reqDirection = Yii::app()->request->getParam('Direction',null);
    $reqSpecCode = Yii::app()->request->getParam('SpecCode',null);
    $reqEduForm = Yii::app()->request->getParam('EduForm',null);
    $reqEduQualification = Yii::app()->request->getParam('EduQualification',null);
    $reqSpecialization = Yii::app()->request->getParam('Specialization','none');
    $reqStatuses = Yii::app()->request->getParam('statuses',"\"Допущено\"");
    $model = new EdboData();
    if (!$reqDirection || !$reqSpecCode || !$reqEduForm 
      || $reqSpecialization == 'none' || !$reqEduQualification){
      echo 'We need params: Direction,SpecCode,EduForm,Specialization,EduQualification'; exit();
    }
    $model->Direction = $reqDirection;
    $model->SpecCode = $reqSpecCode;
    $model->EduForm  = $reqEduForm;
    $model->Specialization  = $reqSpecialization;
    $model->statuses  = $reqStatuses;
    $model->EduQualification  = $reqEduQualification;
    $models = $model->search_rating();
    if (count($models)){
        $_data = $this->CreateRatingEdbo($models);
        //var_dump($_data);exit();
        $_data['toexcel'] = 0;
        $_data['contacts'] = 0;
        $this->layout = '//layouts/clear';
        $this->renderPartial('/personspeciality/excelrating',$_data);
    }
  }  
  
  /**
   * Формування рейтингів конкретної спеціальності у стилі ВступІнфо
   */
  public function actionRatinginfo(){
    $reqPersonspeciality = Yii::app()->request->getParam('Personspeciality',null);
    $model = new Personspeciality();

    $model->SepcialityID = $reqPersonspeciality['SepcialityID'];
    $spec_quota_models = Specialityquotes::model()->findAll('SpecialityID='.$model->SepcialityID);
    $Speciality = Specialities::model()->findByPk($model->SepcialityID);
    $Faculty = $Speciality->facultet->FacultetFullName;
    $license = array();
    $budget = intval($Speciality->SpecialityBudgetCount);
    $license[3] = array(intval($Speciality->Quota1),1);
    $license[2] = array($budget,1);
    $license[1] = array(intval($Speciality->SpecialityContractCount),1);
    $license_info[0] = array('=====================',-1);
    $license_info[1] = array('За кошти фізичних або юридичних осіб',$license[1][0]);
    $license_info[2] = array('За кошти державного бюджету',$budget);
    $license_info[3] = array('Поза конкурсом',$license[3][0]);
    //var_dump($license_info);exit();
    $rating_data = array();
    $general_count = 0;
    foreach ($spec_quota_models as $sqm){
      $model->quota_budget_places = intval($sqm->BudgetPlaces);
      $license[$sqm->QuotaID] = array($model->quota_budget_places,0);
      $license_info[$sqm->QuotaID] = array($sqm->quota->QuotaName,$license[$sqm->QuotaID][0]);
      $model->param_quotaID = $sqm->QuotaID;
      $rating_data[$license_info[$sqm->QuotaID][0]] = $this->CreateRatingData($model->rating_search(0));
      $general_count += count($rating_data[$license_info[$sqm->QuotaID][0]]);
    }
    $rating_data[$license_info[3][0]] = $this->CreateRatingData($model->rating_search(1));
    $general_count += count($rating_data[$license_info[3][0]]);
    $rating_data[$license_info[2][0]] = $this->CreateRatingData($model->rating_search(2));
    $general_count += count($rating_data[$license_info[2][0]]);
    $rating_data[$license_info[1][0]] = $this->CreateRatingData($model->rating_search(3));
    $general_count += count($rating_data[$license_info[1][0]]);
    $rating_data[$license_info[0][0]] = $this->CreateRatingData($model->rating_search(4));
    $general_count += count($rating_data[$license_info[0][0]]);
    //var_dump($rating_data);exit();
        $_data = array(
          'data' => ($general_count > 0)? $rating_data : array(),
          'Speciality' => implode(' ',array(
              $Speciality->SpecialityClasifierCode,
              (mb_substr($Speciality->SpecialityClasifierCode,0,1) == '6')? 
                $Speciality->SpecialityDirectionName : $Speciality->SpecialityName,
              empty($Speciality->SpecialitySpecializationName) ?
                "" : '('.$Speciality->SpecialitySpecializationName.')',
              ', форма: '.$Speciality->eduform->PersonEducationFormName,
          )),
          'Faculty' => $Faculty,
          'license_info' => $license_info,
        );
        $this->layout = '//layouts/clear';
        $this->renderPartial('/personspeciality/ratinginfo',$_data);
  }
  
  /**
   * Метод формує рейтингові дані (PARTIAL) для конкретної спеціальності.
   * @param Personspeciality[] $models масив моделей, що повертає метод rating_search
   * @return array
   */
  protected function CreateRatingData($models){
        $data = array();
        for ($i = 0; $i < count($models); $i++){
          $ZNO = 0+((!empty($models[$i]->documentSubject1))? $models[$i]->documentSubject1->SubjectValue : 0) +
            ((!empty($models[$i]->documentSubject2))? $models[$i]->documentSubject2->SubjectValue : 0)+
            ((!empty($models[$i]->documentSubject3))? $models[$i]->documentSubject3->SubjectValue : 0);
          $ExamsPoints = 0+$models[$i]->Exam1Ball+$models[$i]->Exam2Ball+$models[$i]->Exam3Ball;
          $quotaID = intval($models[$i]->QuotaID);
          $isOutOfComp = intval($models[$i]->isOutOfComp);
          $info_row['PIB'] = $models[$i]->NAME;
          $info_row['Points'] = $models[$i]->ComputedPoints;
          $info_row['ZNO'] = $ZNO;
          $info_row['AdditionalBall'] = ($models[$i]->AdditionalBall > 0.0) ? 
            0.0+$models[$i]->AdditionalBall : 0.0;
          $info_row['DocPoints'] = $models[$i]->ZnoDocValue;
          $info_row['ExamsPoints'] = $ExamsPoints;
          $info_row['OlympsPoints'] = 0+((!empty($models[$i]->olymp))? 
            $models[$i]->olymp->OlympiadAwardBonus : 0);
          $info_row['CoursesPoints'] = 0+$models[$i]->CoursedpBall;
          $info_row['isPZK'] = ($isOutOfComp)? 'V': '—';
          $info_row['isExtra'] = ($models[$i]->isExtraEntry)? 'V': '—';
          $info_row['isQuota'] = ($quotaID>0)? 'V': '—';
          $info_row['isOriginal'] = (!$models[$i]->isCopyEntrantDoc)? 'V': '—';
          $info_row['AnyOriginal'] = ($models[$i]->AnyOriginal && $models[$i]->isCopyEntrantDoc)? 'V': '—';
          $info_row['idPersonSpeciality'] = $models[$i]->idPersonSpeciality;
          $data[$i] = $info_row;          
        }
        return $data;
  }
  
  /**
   * Метод формує рейтингові дані для конкретної спеціальності на основі даних ЄДЕБО.
   * @param Personspeciality[] $models масив моделей, що повертає метод search_rel
   * @return array
   */
  protected function CreateRatingEdbo($models){
        $Speciality = $models[0]->SpecCode . ' ' .$models[0]->Direction . 
          (($models[0]->Specialization)? ' (' . $models[0]->Specialization . ')' : '') . ', форма: ' . $models[0]->EduForm;
        $Faculty = $models[0]->StructBranch;
        $license = array();
        $spec_model = Specialities::model()->find('SpecialityDirectionName LIKE "'.$models[0]->Direction.'" AND SpecialityClasifierCode LIKE "'.$models[0]->SpecCode.'"');
        if (!$spec_model){
          echo "No speciality for criteria SpecialityDirectionName LIKE \"".$models[0]->Direction."\"
           AND SpecialityClasifierCode LIKE \"".$models[0]->SpecCode."\"";
           exit();
        }
        $budget = intval($spec_model->SpecialityBudgetCount);
        $license_info = array();
        $license[4][0] = 0;
        foreach ($spec_model->specquotes as $specquota){
          $license[4][0] += intval($specquota->BudgetPlaces);
          $license[4][1] = 0;
        }
        $license[3] = array(intval($spec_model->Quota1),1);
        $license[2] = array($budget,1);
        $license[1] = array(intval($spec_model->SpecialityContractCount),1);
        $license_info[0] = array('=====================',-1);
        $license_info[1] = array('За кошти фізичних або юридичних осіб',$license[1][0]);
        $license_info[2] = array('За кошти державного бюджету',intval($spec_model->SpecialityBudgetCount));
        $license_info[3] = array('Поза конкурсом',$license[3][0]);
        $license_info[4] = array('Квота',$license[4][0]);
        $data = array();
        for ($i = 0; $i < count($models); $i++){
          $data[$i] = $models[$i]->RatingPoints 
            + 0.001*(($models[$i]->PriorityEntry)? 1:0) 
            + 1000*(($models[$i]->Benefit)? 1:0) 
            + ((empty($spec_model->specquotes))? 0:
              10000.0*((isset($models[$i]->Quota))? intval($models[$i]->Quota):0));
        }
        $rating_list = array();
        $cnt_minus_budget = 0;
        foreach ($license as $level => $lic){
          arsort($data);
          $rating_list[$level] = array();
          $minus = 0;
          if ($level == 3){
            $minus = 1000;
          }
          if ($level > 3){
            $minus = 10000.0;
          }
          $j = 0;
          foreach ($data as $idx => $point){
            $q_id = intval($models[$idx]->Quota);
            if ($level > 3 && $q_id == 0){
              break;
            }
            if ($j >= $lic[0] && $level > 3){
              break;
            }
            if ($level == 3 && $point < 1000.0){
              break;
            }
            if ($level == 3 && $q_id > 0){
              $minus = 10000.0 * $q_id;
              $data[$idx] = ($point - $minus >= 0) ? ($point - $minus) : $point ;
              continue;
            }
            $local_counter = $j;
            if ($level == 2){
              $local_counter += $cnt_minus_budget;
            }
            if (($local_counter >= $lic[0])){
              if (!$minus){
                $minus = $q_id * 10000.0;
              }
              $data[$idx] = ($point - $minus >= 0) ? ($point - $minus) : $point ;
              $j++;
              continue;
            }
            $rating_list[$level][$j++] = $idx;
            unset($data[$idx]);
            if ($level > 2){
              $cnt_minus_budget++;
            }
          }
        }
        foreach ($rating_list as $k => $list){
          foreach ($list as $place => $model_index){
            $info_row['PIB'] = $models[$model_index]->PIB;
            $info_row['Points'] = $models[$model_index]->RatingPoints;
            $info_row['DocPoints'] = $models[$model_index]->DocPoint;
            $info_row['isPZK'] = ($models[$model_index]->Benefit)? 'V': '—';
            $info_row['isExtra'] = ($models[$model_index]->PriorityEntry)? 'V': '—';
            $info_row['isQuota'] = (intval($models[$model_index]->Quota)>0)? 'V': '—';
            $info_row['isOriginal'] = ($models[$model_index]->OD)? 'V': '—';
            $info_row['idPersonSpeciality'] = $models[$model_index]->ID;
            $rating_list[$k][$place] = $info_row;
          }
        }
        $j = 0;
        foreach ($data as $model_index => $point){
            $info_row['PIB'] = $models[$model_index]->PIB;
            $info_row['Points'] = $models[$model_index]->RatingPoints;
            $info_row['DocPoints'] = $models[$model_index]->DocPoint;
            $info_row['isPZK'] = ($models[$model_index]->Benefit)? 'V': '—';
            $info_row['isExtra'] = ($models[$model_index]->PriorityEntry)? 'V': '—';
            $info_row['isQuota'] = (intval($models[$model_index]->Quota)>0)? 'V': '—';
            $info_row['isOriginal'] = ($models[$model_index]->OD)? 'V': '—';
            $info_row['idPersonSpeciality'] = $models[$model_index]->ID;
          $rating_list[0][$j++] = $info_row;
        }
        unset($data);
        $data = array();
        foreach ($rating_list as $key => $ls){
          $data[$license_info[$key][0]] = $ls;
        }
        unset($rating_list);
        //var_dump($license_info);exit();
        return array('data'=>$data,
            'Speciality'=>$Speciality,
            'Faculty'=>$Faculty,
            'license_info' => $license_info,
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
      $href = 'http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT']
        .'/abiturient/rating/rating/excelrating?&Personspeciality%5BSepcialityID%5D='.$spec->idSpeciality
        .'&Personspeciality%5Brating_order_mode%5D=1&toexcel=0'; 
      echo "<li><a href='".$href."' target='_blank'>".$spec->tSPEC."</a></li>";
    }
    echo "</ul></body></html>";
  }
  
  public function actionRatinginfolinks(){
    $criteria = new CDbCriteria();
    $criteria->with = array('eduform');
    $criteria->together = true;
    $criteria->addCondition('eduform.idPersonEducationForm IN (1,2)');
    $criteria->addCondition('substr(SpecialityClasifierCode,1,1) NOT LIKE "6"');
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
    echo '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>Інформація про подані абітурієнтами заяви на старші курси</title> </head><body>';
    echo "<p style='text-align: right; font-family: \"Courier New\"; font-size: 8pt;'>Дані сформовано ".date('d.m.Y H:i')."</p>";
    echo "<h1 style='text-align: center;'>Інформація про подані абітурієнтами заяви</h1>";
   // echo "<h3 style='text-align: center;'>Заяви на ОКР \"Бакалавр\"</h3>";
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
      $href = Yii::app()->createAbsoluteUrl("/rating/rating/ratinginfo",array(
        'Personspeciality[SepcialityID]' => $spec->idSpeciality,
        'Personspeciality[rating_order_mode]' => 1,
      ));
      echo "<li><a href='".$href."' target='_blank'>".$spec->tSPEC." ("
        .Personspeciality::model()->count('(SepcialityID='.$spec->idSpeciality . ' AND StatusID IN (1,4,5,7,8))')
        .")</a></li>";
    }
    echo "</ul><footer style='text-align: center;'>ЗНУ, Лабораторія ІС та КТ</footer>"
    .'<!--ZNUstat-->
<script>
 document.writeln(\'<a href="http://sites.znu.edu.ua/counter/statistic.php?site_id=10&t=\'+Math.random()+\'"><img src="http://sites.znu.edu.ua:8000/counter/count.php?id=10&t=\'+Math.random()+\'"></a>\');
</script>
<noscript>
<a href="http://sites.znu.edu.ua/counter/statistic.php?site_id=10"><img src="http://sites.znu.edu.ua:8000/counter/count.php?id=10"></a>
</noscript>
<!--/ZNUstat-->'
    ."</body></html>";
  }
  
  public function actionRatinginfolinks6(){
    $criteria = new CDbCriteria();
    $criteria->with = array('eduform');
    $criteria->together = true;
    //$criteria->addCondition('eduform.idPersonEducationForm IN (1,2)');
    $criteria->addCondition('substr(SpecialityClasifierCode,1,1) LIKE "6"');
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
    echo '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>Інформація про подані абітурієнтами заяви (ОКР "Бакалавр")</title> </head><body>';
    echo "<p style='text-align: right; font-family: \"Courier New\"; font-size: 8pt;'>Дані сформовано ".date('d.m.Y H:i')."</p>";
    echo "<h1 style='text-align: center;'>Інформація про подані абітурієнтами заяви</h1>";
    echo "<h3 style='text-align: center;'>Заяви на ОКР \"Бакалавр\"</h3>";
    echo "<ul>";
    foreach (Specialities::model()->findAll($criteria) as $spec){
      $href = Yii::app()->createAbsoluteUrl("/rating/rating/ratinginfo",array(
        'Personspeciality[SepcialityID]' => $spec->idSpeciality,
        'Personspeciality[rating_order_mode]' => 1,
      )); 
      echo "<li><a href='".$href."' target='_blank'>".$spec->tSPEC." ("
        .Personspeciality::model()->count('(SepcialityID='.$spec->idSpeciality . ' AND StatusID IN (1,4,5,7,8))')
        .")</a></li>";
    }
    echo "</ul><footer style='text-align: center;'>ЗНУ, Лабораторія ІС та КТ</footer>"
    .'<!--ZNUstat-->
<script>
 document.writeln(\'<a href="http://sites.znu.edu.ua/counter/statistic.php?site_id=10&t=\'+Math.random()+\'"><img src="http://sites.znu.edu.ua:8000/counter/count.php?id=10&t=\'+Math.random()+\'"></a>\');
</script>
<noscript>
<a href="http://sites.znu.edu.ua/counter/statistic.php?site_id=10"><img src="http://sites.znu.edu.ua:8000/counter/count.php?id=10"></a>
</noscript>
<!--/ZNUstat-->'
    ."</body></html>";
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
  
  /**
   * Список рейтингів конкретної спеціальності на основі даних ЄДЕБО
   */
  public function actionEdboratinglinks(){
    $criteria = new CDbCriteria();
    
    $criteria->order = 'EduQualification ASC, StructBranch ASC, Speciality ASC,Direction ASC,SpecCode ASC';
    $criteria->group = 'CONCAT(EduQualification," ",SpecCode," ",Direction," ",Specialization," ",EduForm)';
    echo "<html><meta charset='utf8'><head></head><body><ul>";
    foreach (EdboData::model()->findAll($criteria) as $spec){
      $href1 = 'http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].'/abiturient/rating/rating/edborating?&Direction='
        .urlencode($spec->Direction).'&SpecCode='.urlencode($spec->SpecCode).'&EduForm='.$spec->EduForm.'&statuses='
        .urlencode('"Допущено","Рекомендовано"').'&EduQualification='
        .urlencode('Бакалавр').'&Specialization='.urlencode((($spec->Specialization)? ' (' . $spec->Specialization . ')' : ''));       
      $href2 = 'http://'.$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'].'/abiturient/rating/rating/edborating?&Direction='
        .urlencode($spec->Direction).'&SpecCode='.urlencode($spec->SpecCode).'&EduForm='.$spec->EduForm.'&statuses='
        .urlencode('"Рекомендовано"').'&EduQualification='
        .urlencode('Бакалавр').'&Specialization='.urlencode((($spec->Specialization)? ' (' . $spec->Specialization . ')' : ''));   
      
      echo "<li><a href='".$href1."' target='_blank'>". $spec->EduQualification . ": " . $spec->StructBranch . ': '. $spec->SpecCode . ' ' .$spec->Direction . 
      (($spec->Specialization)? ' (' . $spec->Specialization . ')' : '') . ', форма: ' . $spec->EduForm." --- допущено і рекомендовано</a></li>"; 
      echo "<li><a href='".$href2."' target='_blank'>". $spec->EduQualification . ": " .$spec->StructBranch . ': '. $spec->SpecCode . ' ' .$spec->Direction . 
      (($spec->Specialization)? ' (' . $spec->Specialization . ')' : '') . ', форма: ' . $spec->EduForm." --- рекомендовано</a></li>";
    }
    echo "</ul></body></html>";
  }
}
