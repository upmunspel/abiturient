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
    $reqFields = Yii::app()->request->getParam('fields',null);
    $reqCond = Yii::app()->request->getParam('cond',null);
    $reqAcondval = Yii::app()->request->getParam('acondval',null);
    $reqCondval = Yii::app()->request->getParam('condval',null);
    //var_dump($reqCondval);exit();
    $fields = array();
    $fields[] = array('text' => 'ПІБ персони',);
    $fields[] = array('text' => 'Дата народження',);
    $fields[] = array('text' => 'Адреса КОАТУУ',);
    $fields[] = array('text' => 'Країна громадянства',);
    $fields[] = array('text' => 'Закінчено навчальний заклад',);
    $fields[] = array('text' => 'Місце народження',);
    $fields[] = array('text' => 'Іноземна мова',);
    $fields[] = array('text' => 'Спеціальність',);
    $fields[] = array('text' => 'Факультет',);
    $fields[] = array('text' => 'На бюджет',);
    $fields[] = array('text' => 'На контракт',);
    $fields[] = array('text' => 'Потрібен гуртожиток',);
    $fields[] = array('text' => 'Статус заявки',);
    $fields[] = array('text' => 'Дата створення заявки',);
    $fields[] = array('text' => 'ЗНО (інформація)',);
    $fields[] = array('text' => 'Форма навчання',);
    $fields[] = array('text' => 'Іспити (інформація)',);
    $fields[] = array('text' => 'ОКР',);
    $fields[] = array('text' => 'Документи',);
    $fields[] = array('text' => 'Пільги',);
    $fields[] = array('text' => 'Тип пільги',);
    $fields[] = array('text' => 'Першочергово',);
    $fields[] = array('text' => 'Поза конкурсом',);
    
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
      }
      if (isset($reqAcondval[$i])){
        $alternative_condition_value = $reqAcondval[$i];
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
          $NAME_sql = "concat_ws(' ',trim(person.LastName),trim(person.FirstName),person.MiddleName)";
          array_push($keys,'NAME');
          $this->addRelationTo('person', $with_rel);
          if ($to_select){
            array_push($select, 
                    new CDbExpression($NAME_sql." AS NAME"));
            $widget_columns[$field_num_indexes[$i]] =
                    array('name' => 'NAME','header' => $header, 
                    'value' => '$data->NAME',);
          }
          if ($condition_type == 1 && $condition_value){
            $criteria->addCondition($NAME_sql." LIKE '".$condition_value."'");
          }
          if ($condition_type == 2 && $condition_value){
            $criteria->addCondition($NAME_sql." LIKE '%".$condition_value."%'");
          }
          if ($condition_type == 3 && $condition_value){
            $criteria->addCondition($NAME_sql." NOT LIKE '%".$condition_value."%'");
          }
          if ($condition_type == 4){
            $criteria->addCondition($NAME_sql." LIKE ''");
          }
          break;
        case 1:
          $this->addRelationTo('person', $with_rel);
          array_push($keys,'Birthday');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] = 
                    array('name' => 'person.Birthday', 'header' => $header);
          }
          if ($condition_type == 1 && $condition_value){
            $condition_date = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
            $criteria->addCondition("person.Birthday = '".$condition_date."'");
          }
          if ($condition_type == 2 && $condition_value){
            $condition_date = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
            $criteria->addCondition("person.Birthday LIKE '%".$condition_date."%'");
          }
          if ($condition_type == 4){
            $criteria->addCondition("person.Birthday = '' OR ISNULL(person.Birthday)");
          }
          if ($condition_type == 5 && $condition_value && $alternative_condition_value){
             $condition_date1 = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
             $condition_date2 = date('Y-m-d',strtotime(str_replace('.','-',$alternative_condition_value)));
            $criteria->addCondition("person.Birthday BETWEEN '".$condition_date1."' "
                    . "AND '".$condition_date2."'");
          }
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
            $k2models = KoatuuLevel2::model()->findAll($kriteria2);
            $k1models = KoatuuLevel1::model()->findAll($kriteria1);
            foreach ($k3models as $model){
                /* @var $model KoatuuLevel3 */
                $result_ids[$model->idKOATUULevel3] = $model->idKOATUULevel3;
            }
            foreach ($k2models as $model){
                /* @var $model KoatuuLevel2 */
                $result_ids[$model->idKOATUULevel2] = $model->idKOATUULevel2;
            }
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
          break;
        case 3:
          $this->addRelationTo('person', $with_rel);
          $this->addRelationTo('person.country', $with_rel);
          array_push($keys,'country.CountryName');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =
                    array('name' => 'country.CountryName', 
                        'header' => $header,
                        'value' => '$data->person->country->CountryName'
                        );
          }
          if ($condition_type == 1 && $alternative_condition_value){
            $criteria->addCondition("person.CountryID = '"
                    .$alternative_condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $denial = ($condition_type == 3)? "NOT":"";
            $db_field = 'country.CountryName';
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("country.CountryName  = '' OR ISNULL(country.CountryName )");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("person.CountryID IS NOT NULL");
          }
          break;
        case 4:
          $this->addRelationTo('person', $with_rel);
          $this->addRelationTo('person.school', $with_rel);
          array_push($keys,'school.SchoolName');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =
                    array('name' => 'school.SchoolName', 
                        'header' => $header,
                        'value' => '$data->person->school->SchoolName'
                        );
          }
          if ($condition_type == 1 && $alternative_condition_value){
            $criteria->addCondition("person.SchoolID = '"
                    .$alternative_condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $db_field = 'school.SchoolName';
            $denial = ($condition_type == 3)? "NOT":"";
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("school.SchoolName  = '' OR ISNULL(school.SchoolName )");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("person.SchoolID IS NOT NULL");
          }
          break;
        case 5:
          $this->addRelationTo('person', $with_rel);
          array_push($keys,'person.BirthPlace');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'person.BirthPlace', 
                        'header' => $header,
                        'value' => '$data->person->BirthPlace'
                        );
          }
          if ($condition_type == 1 && $condition_value){
            $criteria->addCondition("person.BirthPlace LIKE '"
                    .$condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $db_field = 'person.BirthPlace';
            $denial = ($condition_type == 3)? "NOT":"";
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("person.BirthPlace = '' OR ISNULL(person.BirthPlace)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(person.BirthPlace = '' OR ISNULL(person.BirthPlace))");
          }
          break;
        case 6:
          $this->addRelationTo('person', $with_rel);
          $this->addRelationTo('person.language', $with_rel);
          array_push($keys,'language.LanguagesName');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'language.LanguagesName', 
                        'header' => $header,
                        'value' => '$data->person->language->LanguagesName'
                        );
          }
          if ($condition_type == 1 && $alternative_condition_value){
            $criteria->addCondition("person.LanguageID='"
                    .$alternative_condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $db_field = 'language.LanguagesName';
            $denial = ($condition_type == 3)? "NOT":"";
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("language.LanguagesName = '' OR ISNULL(language.LanguagesName)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(ISNULL(person.LanguageID))");
          }
          break;
        case 7:
          $group = 't.idPersonSpeciality';
          $this->addRelationTo('sepciality', $with_rel);
          $this->addRelationTo('sepciality.eduform', $with_rel);
          $SPEC_sql = "concat_ws(' ',"
                  . "SpecialityClasifierCode,"
                  . "(case substr(SpecialityClasifierCode,1,1) when '6' then "
                  . "SpecialityDirectionName else SpecialityName end),"
                  . "(case SpecialitySpecializationName when '' then '' "
                  . " else concat('(',SpecialitySpecializationName,')') end)"
                  . ",',',concat('форма: ',eduform.PersonEducationFormName))";
          array_push($keys,'SPEC');
          if ($to_select){
            array_push($select,new CDbExpression($SPEC_sql." AS SPEC"
            ));
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'SPEC', 
                        'header' => $header,
                        'value' => '$data->SPEC'
                        );
          }
          if ($condition_type == 1 && $alternative_condition_value){
            $criteria->addCondition("SepcialityID='"
                    .$alternative_condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $db_field = $SPEC_sql;
            $denial = ($condition_type == 3)? "NOT":"";
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(SepcialityID)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(ISNULL(SepcialityID))");
          }
          break;
        case 8:
          $group = 't.idPersonSpeciality';
          $this->addRelationTo('sepciality', $with_rel);
          $this->addRelationTo('sepciality.facultet', $with_rel);
          array_push($keys,'facultet.FacultetFullName');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'facultet.FacultetFullName', 
                        'header' => $header,
                        'value' => '$data->sepciality->facultet->FacultetFullName'
                        );
          }
          if ($condition_type == 1 && $condition_value){
            $criteria->addCondition("facultet.FacultetFullName LIKE '"
                    .$condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $db_field = 'facultet.FacultetFullName';
            $denial = ($condition_type == 3)? "NOT":"";
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(facultet.FacultetFullName)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(ISNULL(facultet.FacultetFullName))");
          }
          break;
        case 9:
          $group = 't.idPersonSpeciality';
          array_push($keys,'isBudget');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'isBudget', 
                        'header' => $header,
                        'value' => '($data->isBudget)?"так":"ні"'
                        );
          }
          if ($condition_type == 1){
            $cvalue = ($condition_value)? '1':'0';
            $criteria->addCondition("isBudget = '"
                    .$cvalue."'");
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(isBudget)");
          }
          break;
        case 10:
          $group = 't.idPersonSpeciality';
          array_push($keys,'isContract');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'isContract', 
                        'header' => $header,
                        'value' => '($data->isContract)?"так":"ні"'
                        );
          }
          if ($condition_type == 1){
            $cvalue = ($condition_value)? '1':'0';
            $criteria->addCondition("isContract = '"
                    .$cvalue."'");
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(isContract)");
          }
          break;
        case 11:
          $group = 't.idPersonSpeciality';
          array_push($keys,'isNeedHostel');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'isNeedHostel', 
                        'header' => $header,
                        'value' => '($data->isNeedHostel)?"так":"ні"'
                        );
          }
          if ($condition_type == 1){
            $cvalue = ($condition_value)? '1':'0';
            $criteria->addCondition("isNeedHostel = '"
                    .$cvalue."'");
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(isNeedHostel)");
          }
          break;
        case 12:
          $group = 't.idPersonSpeciality';
          $this->addRelationTo('status', $with_rel);
          array_push($keys,'status.PersonRequestStatusTypeName');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'status.PersonRequestStatusTypeName', 
                        'header' => $header,
                        'value' => '$data->status->PersonRequestStatusTypeName'
                        );
          }
          if ($condition_type == 1 && $alternative_condition_value){
            $criteria->addCondition("t.StatusID='"
                    .$alternative_condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $db_field = 'status.PersonRequestStatusTypeName';
            $denial = ($condition_type == 3)? "NOT":"";
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("status.PersonRequestStatusTypeName = '' "
                    . "OR ISNULL(status.PersonRequestStatusTypeName)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(ISNULL(t.StatusID))");
          }
          break;
        case 13:
          $group = 't.idPersonSpeciality';
          array_push($keys,'t.CreateDate');
          if ($to_select){
            $widget_columns[$field_num_indexes[$i]] = 
                    array('name' => 't.CreateDate', 'header' => $header, 
                        'value' => 'date("d.m.Y",strtotime($data->CreateDate))');
          }
          if ($condition_type == 1 && $condition_value){
            $condition_date = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
            $criteria->addCondition("MID(t.CreateDate,0,10) = '".$condition_date."'");
          }
          if ($condition_type == 2 && $condition_value){
            $condition_date = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
            $criteria->addCondition("MID(t.CreateDate,0,10) LIKE '%".$condition_date."%'");
          }
          if ($condition_type == 4){
            $criteria->addCondition("t.CreateDate = '' OR ISNULL(t.CreateDate)");
          }
          if ($condition_type == 5 && $condition_value && $alternative_condition_value){
             $condition_date1 = date('Y-m-d',strtotime(str_replace('.','-',$condition_value)));
             $condition_date2 = date('Y-m-d',strtotime(str_replace('.','-',$alternative_condition_value)));
            $criteria->addCondition("t.CreateDate BETWEEN '".$condition_date1." 00:00:00' "
                    . "AND '".$condition_date2." 23:59:59'");
          }
          break;
        case 14:
          $group = 't.idPersonSpeciality';
          array_push($keys,'ZNO');
          $ZNO_sql = "concat_ws(';;',
              IF(ISNULL(t.DocumentSubject1),'',(select concat(concat('предмет1: ',
              IF(ISNULL(sj1.SubjectName),'відсутній',sj1.SubjectName)),
                IF(ISNULL(sj1.SubjectName),'',concat('; бал: ',docsj1.SubjectValue,
                  '; номер: ',d1.Numbers,
                  '; PIN: ',d1.ZNOPin))) from 
                documentsubject docsj1 
                join subjects sj1 on (docsj1.SubjectID=sj1.idSubjects)
                join documents d1 on (docsj1.DocumentID=d1.idDocuments)
                where docsj1.idDocumentSubject=t.DocumentSubject1 limit 1
              )),
              IF(ISNULL(t.DocumentSubject2),'',(select concat(concat('предмет2: ',
              IF(ISNULL(sj2.SubjectName),'відсутній',sj2.SubjectName)),
                IF(ISNULL(sj2.SubjectName),'',concat('; бал: ',docsj2.SubjectValue,
                  '; номер: ',d2.Numbers,
                  '; PIN: ',d2.ZNOPin))) from 
                documentsubject docsj2 
                join subjects sj2 on (docsj2.SubjectID=sj2.idSubjects)
                join documents d2 on (docsj2.DocumentID=d2.idDocuments)
                where docsj2.idDocumentSubject=t.DocumentSubject2 limit 1
              )),
              IF(ISNULL(t.DocumentSubject3),'',(select concat(concat('предмет3: ',
              IF(ISNULL(sj3.SubjectName),'відсутній',sj3.SubjectName)),
                IF(ISNULL(sj3.SubjectName),'',concat('; бал: ',docsj3.SubjectValue,
                  '; номер: ',d3.Numbers,
                  '; PIN: ',d3.ZNOPin))) from 
                documentsubject docsj3 
                join subjects sj3 on (docsj3.SubjectID=sj3.idSubjects)
                join documents d3 on (docsj3.DocumentID=d3.idDocuments)
                where docsj3.idDocumentSubject=t.DocumentSubject3 limit 1
              ))
            )";
          if ($to_select){
            array_push($select,new CDbExpression($ZNO_sql." AS ZNO"
            ));
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'ZNO', 
                        'header' => $header,
                        'value' => 
            function ($data){
              $zno_arr = array();
              $zno_nodes = explode('||',$data->ZNO);
              foreach ($zno_nodes as $zno_node){
                $zno_subjs = explode(';;',$zno_node);
                $is_first = true;
                foreach ($zno_subjs as $zno_subj){
                  if (isset($zno_arr[$zno_subj]) || !$zno_subj){
                    continue;
                  }
                  $zno_arr[$zno_subj] = true;
                  if (!$is_first){
                    echo '<br/>';
                  } else{
                    $is_first = false;
                  }
                  echo $zno_subj;
                }
              }
            }
                        );
          }
          if ($condition_type == 1 && $condition_value){
            $criteria->addCondition($ZNO_sql." LIKE '"
                    .$condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $denial = ($condition_type == 3)? "NOT":"";
            $db_field = $ZNO_sql;
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(t.DocumentSubject1)");
            $criteria->addCondition("ISNULL(t.DocumentSubject2)");
            $criteria->addCondition("ISNULL(t.DocumentSubject3)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(ISNULL(t.DocumentSubject1))");
            $criteria->addCondition("NOT(ISNULL(t.DocumentSubject2))");
            $criteria->addCondition("NOT(ISNULL(t.DocumentSubject3))");
          }
          break;
        case 16:
          $group = 't.idPersonSpeciality';
          $this->addRelationTo('exam1', $with_rel);
          $this->addRelationTo('exam2', $with_rel);
          $this->addRelationTo('exam3', $with_rel);
          array_push($keys,'EXAM');
          $EXAM_sql = "concat_ws(';;',
              IF(ISNULL(t.Exam1ID),'',
              concat('іспит1: ',exam1.SubjectName,'; бал: ',
              IF(ISNULL(t.Exam1Ball),'немає',t.Exam1Ball))),
              IF(ISNULL(t.Exam2ID),'',
              concat('іспит2: ',exam2.SubjectName,'; бал: ',
              IF(ISNULL(t.Exam2Ball),'немає',t.Exam2Ball))),
              IF(ISNULL(t.Exam3ID),'',
              concat('іспит3: ',exam3.SubjectName,'; бал: ',
              IF(ISNULL(t.Exam3Ball),'немає',t.Exam3Ball)))
            )";
          if ($to_select){
            array_push($select,new CDbExpression($EXAM_sql." AS EXAM"
            ));
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'EXAM', 
                        'header' => $header,
                        'value' => 
            function ($data){
              $exam_arr = array();
              $exam_nodes = explode('||',$data->EXAM);
              foreach ($exam_nodes as $exam_node){
                $exam_subjs = explode(';;',$exam_node);
                $is_first = true;
                foreach ($exam_subjs as $exam_subj){
                  if (isset($exam_arr[$exam_subj]) || !$exam_subj){
                    continue;
                  }
                  $exam_arr[$exam_subj] = true;
                  if (!$is_first){
                    echo '<br/>';
                  } else{
                    $is_first = false;
                  }
                  echo $exam_subj;
                }
              }
            }
                        );
          }
          if ($condition_type == 1 && $condition_value){
            $criteria->addCondition($EXAM_sql." LIKE '"
                    .$condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $denial = ($condition_type == 3)? "NOT":"";
            $db_field = $EXAM_sql;
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(t.Exam1ID)");
            $criteria->addCondition("ISNULL(t.Exam2ID)");
            $criteria->addCondition("ISNULL(t.Exam3ID)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(ISNULL(t.Exam1ID)) "
                    . "AND NOT(ISNULL(t.Exam2ID)) AND NOT(ISNULL(t.Exam3ID))");
          }
          break;
        case 18:
          $this->addRelationTo('person', $with_rel);
          $this->addRelationTo('person.docs', $with_rel, false);
          $this->addRelationTo('person.docs.type', $with_rel, false);
          array_push($keys,'DOCS');
          $DOCS_sql = "group_concat(
              concat(
                type.PersonDocumentTypesName,
                ': ',
                IF(ISNULL(docs.Series),'',docs.Series),' ',
                IF(ISNULL(docs.Numbers),'',concat(docs.Numbers,' ')),
                IF((ISNULL(docs.Issued) OR docs.Issued=''),'',concat('видано ',docs.Issued,', ')),
                IF((ISNULL(docs.DateGet) OR docs.DateGet LIKE '1970-01-01'),'',concat('дата видачі ',docs.DateGet,' ')),
                IF ((ISNULL(docs.AtestatValue) OR docs.AtestatValue = 0),'',
                concat('(значення: ',docs.AtestatValue, ')'))
              ) SEPARATOR ';;'
            )";
          if ($to_select){
            array_push($select,new CDbExpression($DOCS_sql." AS DOCS"
            ));
            $widget_columns[$field_num_indexes[$i]] =  
                    array('name' => 'DOCS', 
                        'header' => $header,
                        'value' => 
            function ($data){
              $docs_arr = array();
              $docs_nodes = explode('||',$data->DOCS);
              foreach ($docs_nodes as $docs_node){
                $docs_subjs = explode(';;',$docs_node);
                $is_first = true;
                foreach ($docs_subjs as $docs_subj){
                  if (isset($docs_arr[$docs_subj]) || !$docs_subj){
                    continue;
                  }
                  $docs_arr[$docs_subj] = true;
                  if (!$is_first){
                    echo '<br/>';
                  } else{
                    $is_first = false;
                  }
                  echo $docs_subj;
                }
              }
            }
                        );
          }
          if ($condition_type == 1 && $condition_value){
            $criteria->addCondition($DOCS_sql." LIKE '"
                    .$condition_value."'");
          }
          if (($condition_type == 2 || $condition_type == 3) && $condition_value){
            $denial = ($condition_type == 3)? "NOT":"";
            $db_field = $DOCS_sql;
            $add_criteria = $this->getConditionString($db_field, $condition_value);
            $criteria->addCondition($denial.'('.$add_criteria.')');
          }
          if ($condition_type == 4){
            $criteria->addCondition("ISNULL(docs.PersonID)");
          }
          if ($condition_type == 3 && !$condition_value){
            $criteria->addCondition("NOT(ISNULL(docs.PersonID))");
          }
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
                'idPersonSpeciality' => CSort::SORT_DESC,
            ),
            'attributes' => array(
                'NAME' => array(
                    'asc' => 'NAME',
                    'desc' => 'NAME DESC',
                ),
                'SPEC' => array(
                    'asc' => 'SPEC',
                    'desc' => 'SPEC DESC',
                ),
                'KOATUU' => array(
                    'asc' => 'KOATUU',
                    'desc' => 'KOATUU DESC',
                ),
                'ZNO' => array(
                    'asc' => 'ZNO',
                    'desc' => 'ZNO DESC',
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
            'pageSize'=>150,
        ),
    ));
    $dataProvider->setTotalItemCount(count($model->findAll($criteria)));
    $this->layout = '//layouts/main_noblock';
    $direct_widget_columns = array();
    for ($i = 0; $i < count($field_nums); $i++){
      foreach ($widget_columns as $key=>$value){
        if ($key == $i){
          $direct_widget_columns[]=$value;
        }
      }
    }
    
    $this->render('/statistic/rept',array(
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
  
  }
