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
            'ratinglinks', 'ratinginfo', 'ratinginfolinks', 'edborating', 'edboratinglinks'),
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
        if (mb_substr($_data['Speciality'],0,1,'utf-8') == '6'){
          $this->renderPartial('/personspeciality/excelrating',$_data);
        } else {
          $spec_tokens = explode(', форма:',$_data['Speciality']);
          $specname_tokens = explode(' ',$spec_tokens[0]);
          unset($specname_tokens[0]);
          $spec_tokens[0] = implode(' ',$specname_tokens);
          $_data['spec_name'] = $spec_tokens[0];
          $_data['spec_eduform'] = $spec_tokens[1];
          $this->renderPartial('/personspeciality/rating_specmag',$_data);
        }
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
    $model->rating_order_mode = 1;
    $model->SepcialityID = $reqPersonspeciality['SepcialityID'];
    $faculty = new Facultets('search');
    $benefit = new Benefit('search');
    $model->searchFaculty = $faculty;
    $model->searchBenefit = $benefit;

    //повертається масив моделей
    $models = $model->search_rel(true);
    if (count($models)){
        $_data = $this->CreateRatingData($models);
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
        $license_info = array();
        foreach ($spec->specquotes as $specquota){
          $license_info[10*$specquota->QuotaID] = array($specquota->quota->QuotaName,intval($specquota->BudgetPlaces));
        }
        $license_info[0] = array('=====================',-1);
        $license_info[1] = array('За кошти фізичних або юридичних осіб',intval($spec->SpecialityContractCount));
        $license_info[2] = array('За кошти державного бюджету',intval($spec->SpecialityBudgetCount));
        $license_info[3] = array('Поза конкурсом',intval($spec->Quota1));
        $this->layout = '//layouts/clear';
        $this->renderPartial('/personspeciality/ratinginfo',array(
          'Speciality' => $Speciality,
          'Faculty' => $Faculty,
          'license_info' => $license_info,
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
        $Speciality = $models[0]->SPEC;
        $Faculty = $models[0]->sepciality->facultet->FacultetFullName;
        $license = array();
        $budget = intval($models[0]->sepciality->SpecialityBudgetCount);
        $license_info = array();
        $Specquotes = Specialityquotes::model()->findAll('SpecialityID='.$models[0]->SepcialityID.' ORDER BY QuotaID DESC');
        foreach ($Specquotes as $specquota){
          $license[10*$specquota->QuotaID] = array(intval($specquota->BudgetPlaces),0);
          $license_info[10*$specquota->QuotaID] = array($specquota->quota->QuotaName,$license[10*$specquota->QuotaID][0]);
        }
        $license[3] = array(intval($models[0]->sepciality->Quota1),1);
        $license[2] = array($budget,1);
        $license[1] = array(intval($models[0]->sepciality->SpecialityContractCount),1);
        $license_info[0] = array('=====================',-1);
        $license_info[1] = array('За кошти фізичних або юридичних осіб',$license[1][0]);
        $license_info[2] = array('За кошти державного бюджету',intval($models[0]->sepciality->SpecialityBudgetCount));
        $license_info[3] = array('Поза конкурсом',$license[3][0]);
        $data = array();
        for ($i = 0; $i < count($models); $i++){
          $data[$i] = $models[$i]->ComputedPoints 
            + 0.001*(($models[$i]->isExtraEntry)? 1:0) 
            + 1000*(($models[$i]->isOutOfComp)? 1:0) 
            + ((empty($models[$i]->sepciality->specquotes))? 0:
              10000.0*((isset($models[$i]->QuotaID))? intval($models[$i]->QuotaID):0))
            + 0.0000001*$models[$i]->ProfileSubjectValue ;
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
          $j = 0;
          foreach ($data as $idx => $point){
            $q_id = isset($models[$idx]->QuotaID)? intval($models[$idx]->QuotaID) : 0;
            if ($level > 3 && $q_id == 0){
              break;
            }
            if ($j >= $lic[0] && $level > 3){
              break;
            }
            if ($level == 3 && $point < 1000.0){
              break;
            }
            if ($level > 3 && $q_id > 0 && $q_id != ($level/10)){
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
            $ZNO = 0+((!empty($models[$model_index]->documentSubject1))? $models[$model_index]->documentSubject1->SubjectValue : 0) +
              ((!empty($models[$model_index]->documentSubject2))? $models[$model_index]->documentSubject2->SubjectValue : 0)+
              ((!empty($models[$model_index]->documentSubject3))? $models[$model_index]->documentSubject3->SubjectValue : 0);
            $ExamsPoints = 0+$models[$model_index]->Exam1Ball+$models[$model_index]->Exam2Ball+$models[$model_index]->Exam3Ball;
            $info_row['PIB'] = $models[$model_index]->NAME;
            $info_row['Points'] = $models[$model_index]->ComputedPoints;
            $info_row['ZNO'] = $ZNO;
            $info_row['DocPoints'] = $models[$model_index]->ZnoDocValue;
            $info_row['ExamsPoints'] = $ExamsPoints;
            $info_row['OlympsPoints'] = 0+((!empty($models[$model_index]->olymp))? $models[$model_index]->olymp->OlympiadAwardBonus : 0);
            $info_row['CoursesPoints'] = 0+$models[$model_index]->CoursedpBall;
            $info_row['isPZK'] = ($models[$model_index]->isOutOfComp)? 'V': '—';
            $info_row['isExtra'] = ($models[$model_index]->isExtraEntry)? 'V': '—';
            $info_row['isQuota'] = (intval($models[$model_index]->QuotaID)>0)? 'V': '—';
            $info_row['isOriginal'] = (!$models[$model_index]->isCopyEntrantDoc)? 'V': '—';
            $info_row['AnyOriginal'] = ($models[$model_index]->AnyOriginal && $models[$model_index]->isCopyEntrantDoc)? 'V': '—';
            $info_row['idPersonSpeciality'] = $models[$model_index]->idPersonSpeciality;
            $rating_list[$k][$place] = $info_row;
          }
        }
        $j = 0;
        foreach ($data as $model_index => $point){
          $ZNO = 0+((!empty($models[$model_index]->documentSubject1))? $models[$model_index]->documentSubject1->SubjectValue : 0) +
            ((!empty($models[$model_index]->documentSubject2))? $models[$model_index]->documentSubject2->SubjectValue : 0)+
            ((!empty($models[$model_index]->documentSubject3))? $models[$model_index]->documentSubject3->SubjectValue : 0);
          $ExamsPoints = 0+$models[$model_index]->Exam1Ball+$models[$model_index]->Exam2Ball+$models[$model_index]->Exam3Ball;
          $info_row['PIB'] = $models[$model_index]->NAME;
          $info_row['Points'] = $models[$model_index]->ComputedPoints;
          $info_row['ZNO'] = $ZNO;
          $info_row['DocPoints'] = $models[$model_index]->ZnoDocValue;
          $info_row['ExamsPoints'] = $ExamsPoints;
          $info_row['OlympsPoints'] = 0+((!empty($models[$model_index]->olymp))? $models[$model_index]->olymp->OlympiadAwardBonus : 0);
          $info_row['CoursesPoints'] = 0+$models[$model_index]->CoursedpBall;
          $info_row['isPZK'] = ($models[$model_index]->isOutOfComp)? 'V': '—';
          $info_row['isExtra'] = ($models[$model_index]->isExtraEntry)? 'V': '—';
          $info_row['isQuota'] = (intval($models[$model_index]->QuotaID)>0)? 'V': '—';
          $info_row['isOriginal'] = (!$models[$model_index]->isCopyEntrantDoc)? 'V': '—';
          $info_row['AnyOriginal'] = ($models[$model_index]->AnyOriginal && $models[$model_index]->isCopyEntrantDoc)? 'V': '—';
          $info_row['idPersonSpeciality'] = $models[$model_index]->idPersonSpeciality;
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
            if ($level > 3 && $q_id > 0 && $q_id != ($level/10)){
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
            $iter = 0;
            while (!empty($data['u']) && ( ( (float)$u_max_info_row['Points'] > (float)$info_row['Points'] ) || 
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isExtra'] == 'V') ||
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isPZK'] == 'V') )
              && ($iter < 2000)
              ){
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
              foreach ($data['u'] as $u_id => $d_u){
                if ($d_u['PIB'] == $u_max_info_row['PIB'] && $d_u['Points'] == $u_max_info_row['Points']){
                  unset($data['u'][$u_id]);
                  $iter++;
                  break;
                }
              }
              $p_max = 0.0;
              foreach ($data['u'] as $u_id => $d_u){
                if ( (float)$d_u['Points'] > $p_max ){
                  $u_max_info_row = $d_u;
                  $p_max = (float)$d_u['Points'];
                }
              }
              $iter++;
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
            $iter = 0;
            $continue = false;
            while (!empty($data['u']) && ( ( (float)$u_max_info_row['Points'] > (float)$info_row['Points'] ) || 
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isExtra'] == 'V') ||
              ( (float)$u_max_info_row['Points'] == (float)$info_row['Points'] && $u_max_info_row['isPZK'] == 'V') )
              && ($iter < 2000)
              ){
              $was = Personspeciality::decrementCounter(Personspeciality::$C_CONTRACT);
              if ($was){
                $local_counter = 1 + $_contract_counter - $was;
                $data['contract'][$local_counter] = $u_max_info_row;
              }
              if (!$was){
                break;
                $continue = true;
              }
              foreach ($data['u'] as $u_id => $d_u){
                if ($d_u['PIB'] == $u_max_info_row['PIB'] && $d_u['Points'] == $u_max_info_row['Points']){
                  unset($data['u'][$u_id]);
                  $iter++;
                  break;
                }
              }
              $p_max = 0.0;
              foreach ($data['u'] as $u_id => $d_u){
                if ( (float)$d_u['Points'] > $p_max ){
                  $u_max_info_row = $d_u;
                  $p_max = (float)$d_u['Points'];
                }
              }
              $iter++;
            }
            if (!$continue){
            $was = Personspeciality::decrementCounter(Personspeciality::$C_CONTRACT);
            if ($was){
              $local_counter = 1 + $_contract_counter - $was;
              $data['contract'][$local_counter] = $info_row;
              $i++;
              continue;
            }
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
