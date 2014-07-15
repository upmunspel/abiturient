<?php

class ReptController extends Controller {

  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout='//layouts/main_noblock';
  public $defaultAction = 'index';

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
        'accessControl', // perform access control for CRUD operations
        'postOnly + ', // we only allow deletion via POST request
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
        array('allow', // allow authenticated user to perform 'create' and 'update' actions
            'actions' => array('index','webexcel'),
            'users' => array('@'),
        ),
//        array('allow', 
//            'actions' => array("info"),
//            'roles' => array('Root','Admin'),),
        array('deny', // deny all users
            'users' => array('*'),
        ),
    );
  }
  
  public function actionIndex() {
    Yii::app()->db->createCommand('SET SESSION group_concat_max_len=150000')->execute();
    $reqFields = Yii::app()->request->getParam('fields',null);
    $reqCond = Yii::app()->request->getParam('cond',null);
    $reqAcondval = Yii::app()->request->getParam('acondval',null);
    $reqCondval = Yii::app()->request->getParam('condval',null);
    $reqExcel = Yii::app()->request->getParam('excel',null);
    //var_dump($reqExcel);exit();
    $fields = array();
    $fields[0] = array('text' => 'ПІБ персони',);
    $fields[1] = array('text' => 'Дата народження',);
    $fields[2] = array('text' => 'Адреса КОАТУУ',);
    $fields[3] = array('text' => 'Країна громадянства',);
    $fields[4] = array('text' => 'Закінчено навчальний заклад',);
    $fields[5] = array('text' => 'Місце народження',);
    $fields[6] = array('text' => 'Іноземна мова',);
    $fields[7] = array('text' => 'Спеціальність',);
    $fields[8] = array('text' => 'Факультет',);
    $fields[9] = array('text' => 'На бюджет',);
    $fields[10] = array('text' => 'На контракт',);
    $fields[11] = array('text' => 'Потрібен гуртожиток',);
    $fields[12] = array('text' => 'Статус заявки',);
    $fields[13] = array('text' => 'Дата створення заявки',);
    $fields[14] = array('text' => 'ЗНО (інформація)',);
    $fields[15] = array('text' => 'Форма навчання',);
    $fields[16] = array('text' => 'Іспити (інформація)',);
    $fields[17] = array('text' => 'ОКР',);
    $fields[18] = array('text' => 'Документи',);
    $fields[19] = array('text' => 'Пільги',);
    $fields[20] = array('text' => 'Тип пільги',);
    $fields[21] = array('text' => 'Першочергово',);
    $fields[22] = array('text' => 'Поза конкурсом',);
    $fields[23] = array('text' => 'Напрям',);
    $fields[24] = array('text' => 'Тип документа',);
    $fields[25] = array('text' => 'Курси ДП',);
    
    if (!is_string($reqFields)){
      throw new CHttpException(400,'Помилка. Невірний запит.');
    }
    $field_nums = explode(',',$reqFields);
    $field_num_indexes = array_flip($field_nums);
    if (count($field_nums) == 0){
      throw new CHttpException(400,'Помилка. Невірний запит.');
    }
    $criteria = new CDbCriteria();
    $select = array('*');
    $with_rel = array();
    $widget_columns = array();
    $keys = array('idPersonSpeciality');
    $group = 'idPerson';
    for ($i = 0; $i < count($reqCond); $i++){
      $condition_type = $reqCond[$i];
      if (isset($reqCondval[$i])){
        $condition_value = $reqCondval[$i];
      } else {
        $condition_value = true;
      }
      if (isset($reqAcondval[$i])){
        $alternative_condition_value = $reqAcondval[$i];
      } else {
        $alternative_condition_value = true;
      }
      $to_select = in_array($i,$field_nums);  
      if (!$to_select && !$condition_type){
        continue;
      }
      
      $header = false;
      if (isset($fields[$i])){
        $header = $fields[$i]['text'];
      }
      switch ($i){
        case 0:
          $rels = array(
              array('name' => 'person', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'sql_as' => 'NAME',
              'sql_expr' => "concat_ws(' ',trim(person.LastName),trim(person.FirstName),person.MiddleName)",
          );
          $widget_column = array('name' => 'NAME', 
            'header' => $header,
            'value' => 
            function ($data){
              echo $data->NAME;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ////////////////////////////////////////////
          break;
        case 1:
          $rels = array(
              array('name' => 'person', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'person.Birthday',
          );
          $widget_column = array('name' => 'person.Birthday', 
            'header' => $header,
            'value' => 
            function ($data){
              echo $data->person->Birthday;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldDateOnly($with_rel, $rels, 
            $sel, $widget_columns, $widget_column, 
            $field_num_index,
            $condition_type, 
            $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 2: //Спеціально для ..баного КОАТУУ 
          $this->addRelationTo('person', $with_rel);
          $KOATUU3_sql = "(SELECT concat(KOATUULevel3FullName,' (тип: ',KOATUULevel3Type,')') FROM koatuulevel3 "
                  . "WHERE person.KOATUUCodeID=idKOATUULevel3)";
          $KOATUU2_sql = "(SELECT KOATUULevel2FullName FROM koatuulevel2 "
                  . "WHERE person.KOATUUCodeID=idKOATUULevel2)";
          $KOATUU1_sql = "(SELECT KOATUULevel1FullName FROM koatuulevel1 "
                  . "WHERE person.KOATUUCodeID=idKOATUULevel1)";
          
          $KOATUU_sql = "IF (ISNULL(".$KOATUU3_sql."),"
                  . "IF (ISNULL(".$KOATUU2_sql."),"
                  . "IF (ISNULL(".$KOATUU1_sql."),NULL,".$KOATUU1_sql."),"
                  .$KOATUU2_sql."),"
                  .$KOATUU3_sql.")";
          array_push($keys,'KOATUU');
          if ($to_select){
            array_push($select, 
                    new CDbExpression($KOATUU_sql." AS KOATUU"));
            $widget_columns[$field_num_indexes[$i]] =
                    array('name' => 'KOATUU', 
                        'header' => $header,
                        'value' => '$data->KOATUU');
          }
          if ($condition_type == 1 && $alternative_condition_value){
            $criteria->addCondition("person.KOATUUCodeID = '"
                    .$alternative_condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $koatuu_keys = explode('|',$condition_value);
            $result_ids = array();
            $denial = ($condition_type == 3)? "NOT":"";
            $kriteria1 = new CDbCriteria();
            $kriteria2 = new CDbCriteria();
            $kriteria3 = new CDbCriteria();
            foreach ($koatuu_keys as $koatuu_key){
              $or_koatuu_keys = explode('&',$koatuu_key);
              if (count($or_koatuu_keys) > 1){
                $koatuu1_like_disjunct = '1';
                $koatuu2_like_disjunct = '1';
                $koatuu3_like_disjunct = '1';
                foreach ($or_koatuu_keys as $koatuu_k){
                  $koatuu3_like_disjunct .= " AND (concat(KOATUULevel3FullName,"
                      . "' (тип: ',KOATUULevel3Type,')') LIKE '%"
                      .$koatuu_k."%')";
                  $koatuu2_like_disjunct .= ' AND (KOATUULevel2FullName LIKE "%'
                      .$koatuu_k.'%")';
                  $koatuu1_like_disjunct .= ' AND (KOATUULevel1FullName LIKE "%'
                      .$koatuu_k.'%")';
                }
                $kriteria3->addCondition($koatuu3_like_disjunct,'OR');
                $kriteria2->addCondition($koatuu2_like_disjunct,'OR');
                $kriteria1->addCondition($koatuu1_like_disjunct,'OR');
              } else {
              $kriteria3->addCondition("concat(KOATUULevel3FullName,"
                      . "' (тип: ',KOATUULevel3Type,')') LIKE '%"
                      .$koatuu_key."%'","OR");
              $kriteria2->addCondition('KOATUULevel2FullName LIKE "%'
                      .$koatuu_key.'%"',"OR");
              $kriteria1->addCondition('KOATUULevel1FullName LIKE "%'
                      .$koatuu_key.'%"',"OR");
              }
            }
              $k3models = KoatuuLevel3::model()->findAll($kriteria3);
              foreach ($k3models as $model){
                  /* @var $model KoatuuLevel3 */
                  $result_ids[$model->idKOATUULevel3] = $model->idKOATUULevel3;
              }
              $k2models = KoatuuLevel2::model()->findAll($kriteria2);
              foreach ($k2models as $model){
                  /* @var $model KoatuuLevel2 */
                  $result_ids[$model->idKOATUULevel2] = $model->idKOATUULevel2;
              }
              $k1models = KoatuuLevel1::model()->findAll($kriteria1);
              foreach ($k1models as $model){
                  /* @var $model KoatuuLevel1 */
                  $result_ids[$model->idKOATUULevel1] = $model->idKOATUULevel1;
              }
              $koatuu_id_in = implode(',',$result_ids);
            if (!$koatuu_id_in){
              $criteria->addCondition('person.KOATUUCodeID IS '.$denial.' NULL');
            } else {
              $criteria->addCondition('person.KOATUUCodeID '.$denial.' IN ('.$koatuu_id_in.')');
            }
          }
          if ($condition_type == 4){
            $criteria->addCondition("person.KOATUUCodeID = '' OR ISNULL(person.KOATUUCodeID)");
          }
          //KOATUU END ////////////////////////////////////////////////////
          break;
        case 3:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.country', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 'person.CountryID',
              'db_field' => 'country.CountryName',
          );
          $widget_column = array('name' => 'country.CountryName', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->person->country)){
                echo $data->person->country->CountryName;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 4:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.school', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 'person.SchoolID',
              'db_field' => 'school.SchoolName',
          );
          $widget_column = array('name' => 'school.SchoolName', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->person->school)){
                echo $data->person->school->SchoolName;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 5:
          $rels = array(
              array('name' => 'person', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'person.BirthPlace',
          );
          $widget_column = array('name' => 'person.BirthPlace', 
            'header' => $header,
            'value' => 
            function ($data){
              echo $data->person->BirthPlace;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 6:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.language', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 'person.LanguageID',
              'db_field' => 'language.LanguagesName',
          );
          $widget_column = array('name' => 'language.LanguagesName', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->person->language)){
                echo $data->person->language->LanguagesName;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 7:
         // $group = 't.idPersonSpeciality';
          $SPEC_sql = "concat_ws(' ',"
                  . "SpecialityClasifierCode,"
                  . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
                  . "SpecialityDirectionName else SpecialityName end),"
                  . "(case SpecialitySpecializationName when '' then '' "
                  . " else concat('(',SpecialitySpecializationName,')') end)"
                  . ",',',concat('форма: ',eduform.PersonEducationFormName))";
          $rels = array(
              array('name' => 'sepciality', 'select' => false),
              array('name' => 'sepciality.eduform', 'select' => false),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 't.SepcialityID',
              'sql_as' => 'SPEC',
              'sql_expr' => $SPEC_sql,
              'group_concat' => true,
          );
          $widget_column = array('name' => 'SPEC', 
            'header' => $header,
            'value' => 
            function ($data){
                $_arr = array();
              $_nodes = explode('||',$data->SPEC);
              foreach ($_nodes as $_node){
                $_subjs = explode(';;',$_node);
                if (!$_node){continue;}
                $is_first = true;
                foreach ($_subjs as $_subj){
                  if (isset($_arr[$_subj]) || !$_subj){continue;}
                  $_arr[$_subj] = true;
                  if (!$is_first){echo '<br/>';} else{$is_first = false;}
                  echo $_subj;
                }
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 8:
          $group = 't.idPersonSpeciality';
          $rels = array(
              array('name' => 'sepciality', 'select' => true),
              array('name' => 'sepciality.facultet', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'facultet.FacultetFullName',
          );
          $widget_column = array('name' => 'person.BirthPlace', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->sepciality->facultet)){
                echo $data->sepciality->facultet->FacultetFullName;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 9:
          $group = 't.idPersonSpeciality';
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'isBudget',
          );
          $widget_column = array('name' => 'isBudget', 
            'header' => $header,
            'value' => 
            function ($data){
              echo ($data->isBudget)? "так":"ні";
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldCheckboxOnly($with_rel, $rels, 
            $sel, $widget_columns, $widget_column, 
            $field_num_index,
            $condition_type, $condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 10:
          $group = 't.idPersonSpeciality';
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'isContract',
          );
          $widget_column = array('name' => 'isContract', 
            'header' => $header,
            'value' => 
            function ($data){
              echo ($data->isContract)? "так":"ні";
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldCheckboxOnly($with_rel, $rels, 
            $sel, $widget_columns, $widget_column, 
            $field_num_index,
            $condition_type, $condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 11:
          $group = 't.idPersonSpeciality';
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'isNeedHostel',
          );
          $widget_column = array('name' => 'isNeedHostel', 
            'header' => $header,
            'value' => 
            function ($data){
              echo ($data->isNeedHostel)? "так":"ні";
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldCheckboxOnly($with_rel, $rels, 
            $sel, $widget_columns, $widget_column, 
            $field_num_index,
            $condition_type, $condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 12:
          $group = 't.idPersonSpeciality';
          $rels = array(
              array('name' => 'status', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 't.StatusID',
              'db_field' => 'status.PersonRequestStatusTypeName',
          );
          $widget_column = array('name' => 'status.PersonRequestStatusTypeName', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->status)){
                echo $data->status->PersonRequestStatusTypeName;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 13:
          $group = 't.idPersonSpeciality';
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 't.CreateDate',
          );
          $widget_column = array('name' => 't.CreateDate', 
            'header' => $header,
            'value' => 
            function ($data){
              echo date('d.m.Y',strtotime($data->CreateDate));
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldDateOnly($with_rel, $rels, 
            $sel, $widget_columns, $widget_column, 
            $field_num_index,
            $condition_type, 
            $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 14:
          $rels = array(
              array('name' => 'documentSubject1', 'select' => true),
              array('name' => 'documentSubject1.subject1', 'select' => true),
              array('name' => 'documentSubject1.document1', 'select' => true),
              array('name' => 'documentSubject2', 'select' => true),
              array('name' => 'documentSubject2.subject2', 'select' => true),
              array('name' => 'documentSubject2.document2', 'select' => true),
              array('name' => 'documentSubject3', 'select' => true),
              array('name' => 'documentSubject3.subject3', 'select' => true),
              array('name' => 'documentSubject3.document3', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'sql_as' => 'ZNO',
              'sql_expr' => "group_concat(DISTINCT concat_ws(';;',
                IF(ISNULL(t.DocumentSubject1),'',
                  concat(
                    subject1.SubjectName,
                    '; бал: ',IF(ISNULL(documentSubject1.SubjectValue),
                      'немає',documentSubject1.SubjectValue),
                    '; номер: ',IF(ISNULL(document1.Numbers),
                      'немає',document1.Numbers),
                    '; PIN: ',IF(ISNULL(document1.ZNOPin),
                      'немає',document1.ZNOPin)
                  )
                ),
                IF(ISNULL(t.DocumentSubject2),'',
                  concat(
                    subject2.SubjectName,
                    '; бал: ',IF(ISNULL(documentSubject2.SubjectValue),
                      'немає',documentSubject2.SubjectValue),
                    '; номер: ',IF(ISNULL(document2.Numbers),
                      'немає',document2.Numbers),
                    '; PIN: ',IF(ISNULL(document2.ZNOPin),
                      'немає',document2.ZNOPin)
                  )
                ),
                IF(ISNULL(t.DocumentSubject3),'',
                  concat(
                    subject3.SubjectName,
                    '; бал: ',IF(ISNULL(documentSubject3.SubjectValue),
                      'немає',documentSubject3.SubjectValue),
                    '; номер: ',IF(ISNULL(document3.Numbers),
                      'немає',document3.Numbers),
                    '; PIN: ',IF(ISNULL(document3.ZNOPin),
                      'немає',document3.ZNOPin)
                  )
                )
              ) SEPARATOR '||')"
          );
          $widget_column = array('name' => 'ZNO', 
                        'header' => $header,
                        'value' => 
            function ($data){
              $_arr = array();
              $_nodes = explode('||',$data->ZNO);
              foreach ($_nodes as $_node){
                $_subjs = explode(';;',$_node);
                if (!$_node){continue;}
                $is_first = true;
                foreach ($_subjs as $_subj){
                  if (isset($_arr[$_subj]) || !$_subj){continue;}
                  $_arr[$_subj] = true;
                  if (!$is_first){echo '<br/>';} else{$is_first = false;}
                  echo $_subj;
                }
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 16:
          //$group = 't.idPersonSpeciality';
          $rels = array(
              array('name' => 'exam1', 'select' => true),
              array('name' => 'exam2', 'select' => true),
              array('name' => 'exam3', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'sql_as' => 'EXAM',
              'sql_expr' => "concat_ws(';;',
                IF(ISNULL(t.Exam1ID),'',
                concat(exam1.SubjectName,'; бал: ',
                IF(ISNULL(t.Exam1Ball),'немає',t.Exam1Ball))),
                IF(ISNULL(t.Exam2ID),'',
                concat(exam2.SubjectName,'; бал: ',
                IF(ISNULL(t.Exam2Ball),'немає',t.Exam2Ball))),
                IF(ISNULL(t.Exam3ID),'',
                concat(exam3.SubjectName,'; бал: ',
                IF(ISNULL(t.Exam3Ball),'немає',t.Exam3Ball)))
              )",
             'group_concat' => true,
          );
          $widget_column = array('name' => 'EXAM', 
                        'header' => $header,
                        'value' => 
            function ($data){
              $_arr = array();
              $_nodes = explode('||',$data->EXAM);
              foreach ($_nodes as $_node){
                $_subjs = explode(';;',$_node);
                if (!$_node){continue;}
                $is_first = true;
                foreach ($_subjs as $_subj){
                  if (isset($_arr[$_subj]) || !$_subj){continue;}
                  $_arr[$_subj] = true;
                  if (!$is_first){echo '<br/>';} else{$is_first = false;}
                  echo $_subj;
                }
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 18:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.docs', 'select' => false),
              array('name' => 'person.docs.type', 'select' => false),
          );
          $sel = array(
              'to_select' => $to_select,
              'sql_as' => 'DOCS',
              'sql_expr' => "concat(
                    type.PersonDocumentTypesName,
                    ': ',
                    IF(ISNULL(docs.Series),'',docs.Series),' ',
                    IF(ISNULL(docs.Numbers),'',concat(docs.Numbers,' ')),
                    IF((ISNULL(docs.Issued) OR docs.Issued=''),
                      '',concat('видано: ',docs.Issued,', ')),
                    IF((ISNULL(docs.DateGet) OR docs.DateGet LIKE '1970-01-01'),
                      '',concat('дата видачі ',docs.DateGet,' ')),
                    IF ((ISNULL(docs.AtestatValue) OR docs.AtestatValue = 0),'',
                    concat('(значення: ',docs.AtestatValue, ')'))
                  )",
              'group_concat' => true,
          );
          $widget_column = array('name' => 'DOCS', 
                        'header' => $header,
                        'value' => 
            function ($data){
              $_arr = array();
              $_nodes = explode('||',$data->DOCS);
              foreach ($_nodes as $_node){
                $_subjs = explode(';;',$_node);
                if (!$_node){continue;}
                $is_first = true;
                foreach ($_subjs as $_subj){
                  if (isset($_arr[$_subj]) || !$_subj){continue;}
                  $_arr[$_subj] = true;
                  if (!$is_first){echo '<br/>';} else{$is_first = false;}
                  echo $_subj;
                }
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 19:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.benefits', 'select' => false),
              array('name' => 'person.benefits.benefit', 'select' => false),
          );
          $sel = array(
              'to_select' => $to_select,
              'sql_as' => 'BENEFITS',
              'sql_expr' => "
                concat(
                    benefit.BenefitName,
                    ': ',
                    IF(ISNULL(benefits.Series),'',concat('серія: ',benefits.Series)),' ',
                    IF(ISNULL(benefits.Numbers),'',concat('номер: ',benefits.Numbers,' ')),
                    IF((ISNULL(benefits.Issued) OR benefits.Issued=''),
                      '',concat('видано: ',benefits.Issued,', ')),
                    IF ((benefit.isPV = 1),' (першочергово)',''),
                    IF ((benefit.isPZK = 1),' (поза конкурсом)','')
                  )",
              'group_concat' => true,
          );
          $widget_column = array('name' => 'BENEFITS', 
                        'header' => $header,
                        'type' => 'raw',
                        'value' => 
            function ($data){
              $_arr = array();
              $_nodes = explode('||',$data->BENEFITS);
              foreach ($_nodes as $_node){
                $_subjs = explode(';;',$_node);
                if (!$_node){continue;}
                $is_first = true;
                foreach ($_subjs as $_subj){
                  if (isset($_arr[$_subj]) || !$_subj){continue;}
                  $_arr[$_subj] = true;
                  if (!$is_first){echo '<br/>';} else{$is_first = false;}
                  echo $_subj;
                }
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 20:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.benefits', 'select' => false),
              array('name' => 'person.benefits.benefit', 'select' => false),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 'benefits.BenefitID',
              'sql_as' => 'BENTYPES',
              'sql_expr' => 'benefit.BenefitName',
              'group_concat' => true,
          );
          $widget_column = array('name' => 'BENTYPES', 
                        'header' => $header,
                        'value' => 
            function ($data){
              echo $data->BENTYPES;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 21:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.benefits', 'select' => false),
              array('name' => 'person.benefits.benefit', 'select' => false),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'benefit.isPV',
          );
          $widget_column = array('name' => 'benefit.isPV', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->person->benefits)){
                $echo = 'ні';
                foreach ($data->person->benefits as $ben){
                  if ($ben->benefit->isPV){
                    $echo = 'так';
                  }
                }
                echo $echo;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldCheckboxOnly($with_rel, $rels, 
            $sel, $widget_columns, $widget_column, 
            $field_num_index,
            $condition_type, $condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 22:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.benefits', 'select' => false),
              array('name' => 'person.benefits.benefit', 'select' => false),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'benefit.isPZK',
          );
          $widget_column = array('name' => 'benefit.isPZK', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->person->benefits)){
                $echo = 'ні';
                foreach ($data->person->benefits as $ben){
                  if ($ben->benefit->isPZK){
                    $echo = 'так';
                  }
                }
                echo $echo;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldCheckboxOnly($with_rel, $rels, 
            $sel, $widget_columns, $widget_column, 
            $field_num_index,
            $condition_type, $condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 15:
          $group = 't.idPersonSpeciality';
          $rels = array(
              array('name' => 'sepciality', 'select' => true),
              array('name' => 'sepciality.eduform', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 'sepciality.PersonEducationFormID',
              'db_field' => 'eduform.PersonEducationFormName',
          );
          $widget_column = array('name' => 'eduform.PersonEducationFormName', 
            'header' => $header,
            'value' => 
            function ($data){
              echo $data->sepciality->eduform->PersonEducationFormName;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 17:
          $group = 't.idPersonSpeciality';
          $rels = array(
              array('name' => 'qualification', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 't.QualificationID',
              'db_field' => 'qualification.QualificationName',
          );
          $widget_column = array('name' => 'qualification.QualificationName', 
            'header' => $header,
            'value' => 
            function ($data){
              if (!empty($data->qualification)){
                echo $data->qualification->QualificationName;
              }
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria);
          ////////////////////////////////////////////
          break;
        case 23:
          $group = 't.idPersonSpeciality';
          $rels = array(
              array('name' => 'sepciality', 'select' => true),
          );
          $DIRECTION_sql = "concat_ws(' ',"
                  . "SpecialityClasifierCode,"
                  . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
                  . "SpecialityDirectionName else SpecialityName end),"
                  . "(case SpecialitySpecializationName when '' then '' "
                  . " else concat('(',SpecialitySpecializationName,')') end)"
                  . ")";
          $sel = array(
              'to_select' => $to_select,
              'sql_as' => 'DIRECTION',
              'sql_expr' => $DIRECTION_sql,
              'group_concat' => false,
          );
          $widget_column = array('name' => 'DIRECTION', 
            'header' => $header,
            'value' => 
            function ($data){
              echo $data->DIRECTION;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ////////////////////////////////////////////
          break;
        case 24:
          $rels = array(
              array('name' => 'person', 'select' => true),
              array('name' => 'person.docs', 'select' => false),
              array('name' => 'person.docs.type', 'select' => false),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field_id' => 'docs.TypeID',
              'sql_as' => 'DOCTYPES',
              'sql_expr' => 'type.PersonDocumentTypesName',
              'group_concat' => true,
          );
          $widget_column = array('name' => 'DOCTYPES', 
                        'header' => $header,
                        'value' => 
            function ($data){
              echo $data->DOCTYPES;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextAlternative($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value, $alternative_condition_value,
            $criteria
          );
          ///////////////////////////////////////
          break;
        case 25:
          $rels = array(
              array('name' => 'coursedp', 'select' => true),
          );
          $sel = array(
              'to_select' => $to_select,
              'db_field' => 'coursedp.CourseDPName',
          );
          $widget_column = array('name' => 'NAME', 
            'header' => $header,
            'value' => 
            function ($data){
              echo $data->coursedp->CourseDPName;
            }
          );
          $field_num_index = ($to_select)? $field_num_indexes[$i]:0;
          $this->ProcessFieldTextOnly($with_rel, $rels, 
            $select, $sel, 
            $widget_columns, $widget_column, $field_num_index,
            $condition_type, $condition_value,
            $criteria
          );
          ////////////////////////////////////////////
          break;
      }
    }
    $criteria->select = $select;
    $criteria->with = $with_rel;
    $criteria->group = $group;
    $criteria->together = true;

    $model = new Personspeciality;
    //$criteria->addCondition('KOA=123');
    $dataProvider =  new CActiveDataProvider($model,array(
        'criteria' => $criteria,
        'sort' => array(
            'defaultOrder' => array(
                'idPersonSpeciality' => CSort::SORT_ASC,
            ),
            'attributes' => array(
                'NAME' => array(
                    'asc' => 'NAME',
                    'desc' => 'NAME DESC',
                ),
                'DIRECTION' => array(
                    'asc' => 'sepciality.SpecialityName ASC,sepciality.SpecialityDirectionName ASC,sepciality.SpecialityClasifierCode ASC',
                    'desc' => 'sepciality.SpecialityName DESC,sepciality.SpecialityDirectionName DESC,sepciality.SpecialityClasifierCode DESC',
                ),
                'KOATUU' => array(
                    'asc' => 'KOATUU',
                    'desc' => 'KOATUU DESC',
                ),
                'ZNO' => array(
                    'asc' => 'ZNO',
                    'desc' => 'ZNO DESC',
                ),
                'BENEFITS' => array(
                    'asc' => 'BENEFITS',
                    'desc' => 'BENEFITS DESC',
                ),
                'DOCS' => array(
                    'asc' => 'DOCS',
                    'desc' => 'DOCS DESC',
                ),
                'status.PersonRequestStatusTypeName' => array(
                    'asc' => 'status.PersonRequestStatusTypeName',
                    'desc' => 'status.PersonRequestStatusTypeName DESC',
                ),
                'facultet.FacultetFullName' => array(
                    'asc' => 'facultet.FacultetFullName',
                    'desc' => 'facultet.FacultetFullName DESC',
                ),
                'language.LanguagesName' => array(
                    'asc' => 'language.LanguagesName',
                    'desc' => 'language.LanguagesName DESC',
                ),
                'person.BirthPlace' => array(
                    'asc' => 'person.BirthPlace',
                    'desc' => 'person.BirthPlace DESC',
                ),
                'person.Birthday' => array(
                    'asc' => 'person.Birthday',
                    'desc' => 'person.Birthday DESC',
                ),
                'school.SchoolName' => array(
                    'asc' => 'school.SchoolName',
                    'desc' => 'school.SchoolName DESC',
                ),
                't.CreateDate' => array(
                    'asc' => 't.CreateDate',
                    'desc' => 't.CreateDate DESC',
                ),
                '*',
            ),
        ),
        'pagination'=>array(
            'pageSize'=> ($reqExcel)? 15000:150,
        ),
    ));
    $dataProvider->setTotalItemCount(count($model->findAll($criteria)));
    $this->layout = ($reqExcel)? '//layouts/clear' : '//layouts/main_noblock';
    $direct_widget_columns = array();
    for ($i = 0; $i < count($field_nums); $i++){
      foreach ($widget_columns as $key=>$value){
        if ($key == $i){
          $direct_widget_columns[]=$value;
        }
      }
    }
    
    $this->render(($reqExcel)? '/statistic/rept_excel':'/statistic/rept',array(
        'data' => $dataProvider,
        'columns' => $direct_widget_columns,
    ));
  }
  
  protected function addRelationTo($rel,&$with_rel,$is_select = true){
    if (in_array($rel, $with_rel)){
      return false;
    }
    if ($is_select){
      array_push($with_rel,$rel);
    } else {
      $with_rel[$rel] = array('select' => false);
    }
    return true;
  }
  
  protected function getConditionString($db_field,$_condition_value){
    $condition_value = str_replace('"', "\\\"", $_condition_value);
    $field_keys = explode('|',$condition_value);
    $add_criteria = '0';
    foreach ($field_keys as $field_key){
      $or_field_keys = explode('&',$field_key);
      //var_dump($or_field_keys);
      if (count($or_field_keys) > 1){
        $field_like_disjunct = '1';
        foreach ($or_field_keys as $field_k){
          $field_like_disjunct .= " AND (".$db_field." LIKE '%"
              .$field_k."%')";
        }
        $add_criteria .= ' OR ('.$field_like_disjunct.')';
      } else {
      $add_criteria .= ' OR ('.$db_field.' LIKE "%'
              .$field_key.'%")';
      }
    }
    return $add_criteria;
  }
  
  protected function ProcessFieldTextOnly(&$with_rel, $rels, 
          &$select, $sel, 
          &$widget_columns, $widget_column, $field_num_index,
          $condition_type, $condition_value,
          &$criteria){
    //$sel['sql_expr']
    //$sel['sql_as']
    //$sel['group_concat']
    //$sel['db_field']
    //$sel['to_select']
    //$rel['name']
    //$rel['select']
    if (!isset($sel['group_concat'])){
      $sel['group_concat'] = false;
    }
    if (!empty($rels)){
      foreach ($rels as $rel){
        $this->addRelationTo($rel['name'], $with_rel, $rel['select']);
      }
    }
    $to_select = $sel['to_select'];
    $sql_expr = '';
    $db_field = '';
    if (isset($sel['sql_expr'])){
      $sql_expr = $sel['sql_expr'];
      $sql_as = $sel['sql_as'];
    } else {
      $db_field = $sel['db_field'];
    }
    if ($to_select){
      if ($sql_expr){
        $_sql_expr = ($sel['group_concat'])? 
          'GROUP_CONCAT(DISTINCT '.$sql_expr.' SEPARATOR ";;")' : 
          $sql_expr;
        array_push($select,new CDbExpression($_sql_expr." AS ".$sql_as
        ));
      }
      $widget_columns[$field_num_index] =  
              $widget_column;
    }
    if ($condition_type == 1 && $condition_value){
      $criteria->addCondition($sql_expr." LIKE '"
              .$condition_value."'");
    }
    if (($condition_type == 2 || $condition_type == 3) && $condition_value){
      $denial = ($condition_type == 3)? "NOT":"";
      if ($sql_expr){
        $db_field = $sql_expr;
      }
      $add_criteria = $this->getConditionString($db_field, $condition_value);
      $criteria->addCondition($denial.'('.$add_criteria.')');
    }
    if ($condition_type == 4){
      if ($sql_expr){
        $db_field = $sql_expr;
      }
      $criteria->addCondition("ISNULL(".$db_field.") OR ".$db_field."=''");
    }
    if ($condition_type == 3 && !$condition_value){
      if ($sql_expr){
        $db_field = $sql_expr;
      }
      $criteria->addCondition("NOT(ISNULL(".$db_field.") OR ".$db_field."='')");
    }
    return false;
  }
  
  
  protected function ProcessFieldTextAlternative(&$with_rel, $rels, 
          &$select, $sel, 
          &$widget_columns, $widget_column, $field_num_index,
          $condition_type, $condition_value, $alternative_condition_value,
          &$criteria){
    //$sel['sql_expr']
    //$sel['sql_as']
    //$sel['db_field']
    //$sel['db_field_id']
    //$sel['to_select']
    //$rel['name']
    //$rel['select']
    if (!isset($sel['group_concat'])){
      $sel['group_concat'] = false;
    }
    if (!empty($rels)){
      foreach ($rels as $rel){
        $this->addRelationTo($rel['name'], $with_rel, $rel['select']);
      }
    }
    $to_select = $sel['to_select'];
    $sql_expr = '';
    $db_field = '';
    $db_field_id = $sel['db_field_id'];
    if (isset($sel['sql_expr'])){
      $sql_expr = $sel['sql_expr'];
      $sql_as = $sel['sql_as'];
    } else {
      $db_field = $sel['db_field'];
    }
    if ($to_select){
      if ($sql_expr){
        $_sql_expr = ($sel['group_concat'])? 
          'GROUP_CONCAT(DISTINCT '.$sql_expr.' SEPARATOR ";;")' : 
          $sql_expr;
        array_push($select,new CDbExpression($_sql_expr." AS ".$sql_as
        ));
      }
      $widget_columns[$field_num_index] =  
              $widget_column;
    }
    if ($condition_type == 1 && $alternative_condition_value){
      $criteria->addCondition($db_field_id." = '"
              .$alternative_condition_value."'");
    }
    if (($condition_type == 2 || $condition_type == 3) && $condition_value){
      $denial = ($condition_type == 3)? "NOT":"";
      if ($sql_expr){
        $db_field = $sql_expr;
      }
      $add_criteria = $this->getConditionString($db_field, $condition_value);
      $criteria->addCondition($denial.'('.$add_criteria.')');
    }
    if ($condition_type == 4){
      $criteria->addCondition("ISNULL(".$db_field_id.") OR ".$db_field_id."=''");
    }
    if ($condition_type == 3 && !$condition_value){
      $criteria->addCondition("NOT(ISNULL(".$db_field_id.") OR ".$db_field_id."='')");
    }
    return false;
  }
  
  protected function ProcessFieldDateOnly(&$with_rel, $rels, 
          $sel, &$widget_columns, $widget_column, 
          $field_num_index,
          $condition_type, 
          $condition_value, $alternative_condition_value,
          &$criteria){
    //$sel['db_field']
    //$sel['to_select']
    //$rel['name']
    //$rel['select']
    if (!empty($rels)){
      foreach ($rels as $rel){
        $this->addRelationTo($rel['name'], $with_rel, $rel['select']);
      }
    }
    $to_select = $sel['to_select'];
    $db_field = $sel['db_field'];
 
    if ($to_select){
      $widget_columns[$field_num_index] =  
              $widget_column;
    }
    if ($condition_type == 1 && $condition_value){
      $condition_date = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
      $criteria->addCondition($db_field." = '".$condition_date."'");
    }
    if ($condition_type == 2 && $condition_value){
      $condition_date = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
      $criteria->addCondition($db_field." LIKE '%".$condition_date."%'");
    }
    if ($condition_type == 4){
      $criteria->addCondition($db_field." = '' OR ISNULL(".$db_field.")");
    }
    if ($condition_type == 5 && $condition_value && $alternative_condition_value){
      $condition_date1 = date('Y-m-d',strtotime(str_replace('.','-',$condition_value))) . ' 00:00:00';
      $condition_date2 = date('Y-m-d',strtotime(str_replace('.','-',$alternative_condition_value))) . ' 23:59:59';
      $criteria->addCondition($db_field." BETWEEN '".$condition_date1."' "
              . "AND '".$condition_date2."'");
    }
    return false;
  }
  
  protected function ProcessFieldCheckboxOnly(&$with_rel, $rels, 
          $sel, &$widget_columns, $widget_column, 
          $field_num_index,
          $condition_type, $condition_value,
          &$criteria){
    //$sel['db_field']
    //$sel['to_select']
    //$rel['name']
    //$rel['select']
    if (!empty($rels)){
      foreach ($rels as $rel){
        $this->addRelationTo($rel['name'], $with_rel, $rel['select']);
      }
    }
    $to_select = $sel['to_select'];
    $db_field = $sel['db_field'];
 
    if ($to_select){
      $widget_columns[$field_num_index] =  
              $widget_column;
    }
    if ($condition_type == 1){
      $cvalue = ($condition_value)? '1':'0';
      $criteria->addCondition($db_field." = '"
              .$cvalue."'");
    }
    if ($condition_type == 4){
      $criteria->addCondition("ISNULL(".$db_field.")");
    }
    return false;
  }
  
}
