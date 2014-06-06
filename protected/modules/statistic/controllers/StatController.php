<?php

class StatController extends Controller {

  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  //public $layout='//layouts/column2';
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
            'actions' => array('index', 'view', 
                "viewall","queryconstructor","qdata",
                'languages','reqstatuses','koatuus','zno',
                'doctypes','benefitgroups','eduforms','okr',
                'countries','schools'),
            'users' => array('@'),
        ),
        array('allow', 
            'actions' => array("contacts"),
            'roles' => array('Root','Admin'),),
        array('deny', // deny all users
            'users' => array('*'),
        ),
    );
  }
  
  public function actionIndex() {
    $this->layout = '//layouts/main_noblock';
    $this->render('/statistic/index');
  }
  
  /**
   * Метод формує дані для звіту і сам звіт про к-сть заявок абітурієнтів
   * для денної та заочної форми усіх спеціальностей
   * для конкретної дати і ОКР та за період від 01.07 поточного року.
   */
  public function actionView() {
    /* @var $reqQualifictionID integer */
    /* @var $reqEduFormID integer */
    $reqQualificationID = Yii::app()->request->getParam('QualificationID',1);
    $reqDate = Yii::app()->request->getParam('Date',date('d.m.Y'));
    
    $time = strtotime(str_replace('.','-',$reqDate));
    $date = date('Y-m-d',time());
    if ($time !== FALSE){
      $date = date('Y-m-d',$time);
    }
    $spec_ident = '6';
    switch ($reqQualificationID){
      case 1 : $spec_ident='6'; break;
      case 2 : $spec_ident='8'; break;
      case 3 : $spec_ident='7'; break;
    }
    $statuses = implode(',',
            array_flip(Personrequeststatustypes::model()->getStatusList()));
    $criteria = new CDbCriteria();
    $criteria->with = array(
        'facultet',
    );
    $criteria->addCondition('t.PersonEducationFormID IN(1,2)');
    $criteria->addCondition('SUBSTR(t.SpecialityClasifierCode,1,1) LIKE '
            . '"'.$spec_ident.'"');
    
    $criteria->select = array('*',
        new CDbExpression('((SELECT COUNT(ps.idPersonSpeciality) FROM personspeciality ps WHERE '
                . 'ps.SepcialityID=t.idSpeciality AND '
                . 'ps.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps.StatusID IN ('.$statuses.') AND '
                . 'ps.CreateDate BETWEEN '
                . '"' . $date . ' 00:00:00' . '" '
                . 'AND "' . $date . ' 23:59:59")) AS cnt_requests_per_day'),
        new CDbExpression('((SELECT COUNT(ps.idPersonSpeciality) FROM personspeciality ps WHERE '
                . 'ps.SepcialityID=t.idSpeciality AND '
                . 'ps.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps.StatusID IN ('.$statuses.') AND '
                . 'ps.CreateDate BETWEEN '
                //. '"'.date('Y').'-07-01 00:00:00' . '" '
                . '"2013-07-01 00:00:00' . '" '
                . 'AND "' . $date . ' 23:59:59")) AS cnt_requests'),
        new CDbExpression('((SELECT COUNT(DISTINCT ps.PersonID) FROM personspeciality ps WHERE '
                . 'ps.QualificationID IN ' . (($reqQualificationID == 1)? '(1)' : '(2,3)') . ' AND '
                . 'ps.CreateDate BETWEEN '
                . '"' . $date . ' 00:00:00' . '" '
                . 'AND "' . $date . ' 23:59:59")) AS cnt_persons_per_day'),
        new CDbExpression('((SELECT COUNT(DISTINCT ps.PersonID) FROM personspeciality ps WHERE '
                . 'ps.QualificationID IN ' . (($reqQualificationID == 1)? '(1)' : '(2,3)') . ' AND '
                . 'ps.CreateDate BETWEEN '
                //. '"'.date('Y').'-07-01 00:00:00' . '" '
                . '"2013-07-01 00:00:00' . '" '
                . 'AND "' . $date . ' 23:59:59")) AS cnt_persons'),
    );
    $criteria->group = 'idSpeciality';
    $criteria->order = 'facultet.FacultetFullName,SpecialityDirectionName,SpecialityName';
    $specs = Specialities::model()->findAll($criteria);
    
    $cnt_data = array();
    $counts_atall = array();
    
    $counts_atall[1]['per_day'] = 0;
    $counts_atall[1]['all'] = 0;
    
    $counts_atall[2]['per_day'] = 0;
    $counts_atall[2]['all'] = 0;
    
    $counts_atall['persons_per_day'] = 0;
    $counts_atall['persons_all'] = 0;
    $i=0;
    foreach ($specs as $spec){
      /* @var $spec Specialities */
      if (!isset($cnt_data[$spec->FacultetID])){
        $cnt_data[$spec->FacultetID] = array();
      }
      if (!isset($cnt_data[$spec->FacultetID]['name'])){
        $cnt_data[$spec->FacultetID]['name'] = $spec->facultet->FacultetFullName;
      }
      $lspec_ident = mb_substr($spec->SpecialityClasifierCode,0,1,'utf-8');
      $spec_name = $spec->SpecialityClasifierCode . ' '
            . (($lspec_ident == '6')?
                    $spec->SpecialityDirectionName : $spec->SpecialityName )
            . (($spec->SpecialitySpecializationName == '')? 
                    '' : ' ('.$spec->SpecialitySpecializationName. ')');
      $cnt_data[$spec->FacultetID][$spec_name][$spec->PersonEducationFormID] = array(
          'eduform' => ($spec->PersonEducationFormID == 1)? 'денна':"заочна",
          'cnt_requests_per_day' => $spec->cnt_requests_per_day,
          'cnt_requests' => $spec->cnt_requests,
      );
      $counts_atall[$spec->PersonEducationFormID]['per_day'] += $spec->cnt_requests_per_day;
      $counts_atall[$spec->PersonEducationFormID]['all'] += $spec->cnt_requests;
      if ($i == 0){
        $counts_atall['persons_per_day'] = $spec->cnt_persons_per_day;
        $counts_atall['persons_all'] = $spec->cnt_persons;
      }
      $i++;
    }
    
    $this->layout = '//layouts/clear';
    
    $this->render('/statistic/statistic', array(
        'cnt_data' => $cnt_data,
        'summary' => $counts_atall,
        'spec_ident' => $spec_ident,
        'date' => $reqDate
    ));
  }

  /**
   * Метод виводить кількісну статистику.
   * @todo Do it later. Str=>188
   */
  public function actionViewall() {
    /* @var $reqQualifictionID integer */
    /* @var $reqEduFormID integer */
    $reqQualificationID = Yii::app()->request->getParam('QualificationID',1);
    $reqDateFrom = Yii::app()->request->getParam('DateFrom',date('d.m.Y'));
    $reqDateTo = Yii::app()->request->getParam('DateTo',date('d.m.Y'));
    $reqSpecialities = Yii::app()->request->getParam('Specialities',null);
    $reqBudgetColumn = 0;
    $reqContractColumn = 0;
    $reqPvColumn = 0;
    $reqPzkColumn = 0;
    $reqElectroColumn = 0;
    $reqOriginalsColumn = 0;
    $statuses = implode(',',
            array_flip(Personrequeststatustypes::model()->getStatusList()));
    if (isset($reqSpecialities['modes'])){
      foreach ($reqSpecialities['modes'] as $val){
        switch ( $val ) {
          case 'budget':
            $reqBudgetColumn = 1;
            break;
          case 'contract':
            $reqContractColumn = 1;
            break;
          case 'pv':
            $reqPvColumn = 1;
            break;
          case 'pzk':
            $reqPzkColumn = 1;
            break;
          case 'electro':
            $reqElectroColumn = 1;
            break;
          case 'originals':
            $reqOriginalsColumn = 1;
            break;
        }
      }
    }
    if (isset($reqSpecialities['statuses']) && !empty($reqSpecialities['statuses'])){
      $statuses = implode(',',$reqSpecialities['statuses']);
    }
    if (!is_numeric($reqQualificationID)){
      $reqQualificationID = 1;
    }
    
    $timeFrom = strtotime(str_replace('.','-',$reqDateFrom));
    $dateFrom = date('Y-m-d',time());
    if ($timeFrom !== FALSE){
      $dateFrom = date('Y-m-d',$timeFrom);
    }
    $timeTo = strtotime(str_replace('.','-',$reqDateTo));
    $dateTo = date('Y-m-d',time());
    if ($timeTo !== FALSE){
      $dateTo = date('Y-m-d',$timeTo);
    }
    $spec_ident = '6';
    switch ($reqQualificationID){
      case 1 : $spec_ident='6'; break;
      case 2 : $spec_ident='8'; break;
      case 3 : $spec_ident='7'; break;
    }
    
    $criteria = new CDbCriteria();
    $criteria->with = array(
        'facultet',
    );
    $criteria->addCondition('t.PersonEducationFormID IN(1,2)');
    $criteria->addCondition('SUBSTR(t.SpecialityClasifierCode,1,1) LIKE '
            . '"'.$spec_ident.'"');
    
    $date_segment = '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59"';
    
    $criteria->select = array('*',
        new CDbExpression('((SELECT COUNT(ps5.idPersonSpeciality) FROM personspeciality ps5 WHERE '
                . 'ps5.SepcialityID=t.idSpeciality AND '
                . 'ps5.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps5.StatusID IN ('.$statuses.') AND '
                . 'ps5.CreateDate BETWEEN '
                . $date_segment
                . ')) AS cnt_requests'),
        (($reqBudgetColumn) ? new CDbExpression('((SELECT COUNT(ps1.idPersonSpeciality) FROM personspeciality ps1 WHERE '
                . 'ps1.SepcialityID=t.idSpeciality AND '
                . 'ps1.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps1.StatusID IN ('.$statuses.') AND '
                . 'ps1.isBudget = 1 AND '
                . 'ps1.CreateDate BETWEEN '
                . $date_segment
                . ')) AS cnt_req_budget') : 'idSpeciality' ),
        (($reqContractColumn) ? new CDbExpression('((SELECT COUNT(ps2.idPersonSpeciality) FROM personspeciality ps2 WHERE '
                . 'ps2.SepcialityID=t.idSpeciality AND '
                . 'ps2.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps2.StatusID IN ('.$statuses.') AND '
                . 'ps2.isContract = 1 AND '
                . 'ps2.CreateDate BETWEEN '
                . $date_segment
                . ')) AS cnt_req_contract') : 'idSpeciality' ),
        (($reqOriginalsColumn) ? new CDbExpression('((SELECT COUNT(ps3.idPersonSpeciality) FROM personspeciality ps3 WHERE '
                . 'ps3.SepcialityID=t.idSpeciality AND '
                . 'ps3.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps3.StatusID IN ('.$statuses.') AND '
                . 'ps3.isCopyEntrantDoc <> 1 AND '
                . 'ps3.CreateDate BETWEEN '
                . $date_segment
                . ')) AS cnt_req_original') : 'idSpeciality' ),
        (($reqElectroColumn) ? new CDbExpression('((SELECT COUNT(ps4.idPersonSpeciality) FROM personspeciality ps4 WHERE '
                . 'ps4.SepcialityID=t.idSpeciality AND '
                . 'ps4.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps4.StatusID IN ('.$statuses.') AND '
                . 'ps4.RequestFromEB = 1 AND '
                . 'ps4.CreateDate BETWEEN '
                . $date_segment
                . ')) AS cnt_req_electro') : 'idSpeciality' ),
        (($reqPvColumn) ? new CDbExpression('((SELECT COUNT(DISTINCT ps6.idPersonSpeciality) FROM personspeciality ps6 '
                . 'LEFT JOIN person ON ps6.PersonID=person.idPerson '
                . 'LEFT JOIN personbenefits psben ON psben.PersonID=person.idPerson '
                . 'LEFT JOIN benefit ON psben.BenefitID=benefit.idBenefit WHERE '
                . 'ps6.SepcialityID=t.idSpeciality AND '
                . 'ps6.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps6.StatusID IN ('.$statuses.') AND '
                . 'IF(ISNULL(benefit.isPV),0,(benefit.isPV = 1)) AND '
                . 'ps6.CreateDate BETWEEN '
                . $date_segment
                . ')) AS cnt_req_pv') : 'idSpeciality' ),
        (($reqPzkColumn) ? new CDbExpression('((SELECT COUNT(DISTINCT ps7.idPersonSpeciality) FROM personspeciality ps7 '
                . 'LEFT JOIN person ON ps7.PersonID=person.idPerson '
                . 'LEFT JOIN personbenefits psben ON psben.PersonID=person.idPerson '
                . 'LEFT JOIN benefit ON psben.BenefitID=benefit.idBenefit WHERE '
                . 'ps7.SepcialityID=t.idSpeciality AND '
                . 'ps7.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps7.StatusID IN ('.$statuses.') AND '
                . 'IF(ISNULL(benefit.isPZK),0,(benefit.isPZK = 1)) AND '
                . 'ps7.CreateDate BETWEEN '
                . $date_segment
                . ')) AS cnt_req_pzk') : 'idSpeciality' ),
    );
    $criteria->group = 'idSpeciality';
    $criteria->order = 'facultet.FacultetFullName,SpecialityDirectionName,SpecialityName';
    $specs = Specialities::model()->findAll($criteria);
    
    $cnt_data = array();
    $i=0;
    foreach ($specs as $spec){
      /* @var $spec Specialities */
      if (!isset($cnt_data[$spec->FacultetID])){
        $cnt_data[$spec->FacultetID] = array();
      }
      if (!isset($cnt_data[$spec->FacultetID]['name'])){
        $cnt_data[$spec->FacultetID]['name'] = $spec->facultet->FacultetFullName;
      }
      $lspec_ident = mb_substr($spec->SpecialityClasifierCode,0,1,'utf-8');
      $spec_name = $spec->SpecialityClasifierCode . ' '
            . (($lspec_ident == '6')?
                    $spec->SpecialityDirectionName : $spec->SpecialityName )
            . (($spec->SpecialitySpecializationName == '')? 
                    '' : ' ('.$spec->SpecialitySpecializationName. ')');
      $cnt_data[$spec->FacultetID][$spec_name][$spec->PersonEducationFormID] = array(
          'eduform' => ($spec->PersonEducationFormID == 1)? 'денна':"заочна",
          'cnt_req_budget' => $spec->cnt_req_budget,
          'cnt_req_contract' => $spec->cnt_req_contract,
          'cnt_req_electro' => $spec->cnt_req_electro,
          'cnt_req_originals' => $spec->cnt_req_original,
          'cnt_req_pv' => $spec->cnt_req_pv,
          'cnt_req_pzk' => $spec->cnt_req_pzk,
          'cnt_requests' => $spec->cnt_requests,
      );
      $i++;
    }
    $this->layout = '//layouts/clear';
    $this->render('/statistic/statdetail', array(
        'cnt_data' => $cnt_data,
        'spec_ident' => $spec_ident,
        'date_from' => $reqDateFrom,
        'date_to' => $reqDateTo,
        'cbudget' => $reqBudgetColumn,
        'ccontract' => $reqContractColumn,
        'cpv' => $reqPvColumn,
        'cpzk' => $reqPzkColumn,
        'celectro' => $reqElectroColumn,
        'coriginals' => $reqOriginalsColumn,
    ));
  }
  
  /**
   * @todo It's Hard
   */
  public function actionQueryconstructor(){
    
  }

  /**
   * Метод створює сторінку контактної інформації персон.
   * @todo YEAH!!!
   */
  public function actionContacts(){
    $reqFacultyID = Yii::app()->request->getParam('FacultyID',null);
    
    $criteria = new CDbCriteria();
    $criteria->with = array(
        'contacts' => array('select' => false),
        'contacts.contacttype' => array('select' => false),
        'specs.sepciality' => array('select' => false),
        'specs.sepciality.eduform' => array('select' => false),
        'specs' => array('select' => false),
        'specs.status' => array('select' => false),
    );
    $criteria->together = true;
    $criteria->select = array(
        '*',
        new CDbExpression("concat_ws(' ',trim(t.LastName),trim(t.FirstName),t.MiddleName) AS NAME"),
        new CDbExpression("GROUP_CONCAT(DISTINCT CONCAT(contacttype.PersonContactTypeName,': ',contacts.Value) SEPARATOR ';;') AS PsnContacts"),
        new CDbExpression("GROUP_CONCAT(DISTINCT concat_ws(' ',"
                . "sepciality.SpecialityClasifierCode,"
                . "(case substr(sepciality.SpecialityClasifierCode,1,1) when '6' then "
                . "sepciality.SpecialityDirectionName else sepciality.SpecialityName end),"
                . "(case sepciality.SpecialitySpecializationName when '' then '' "
                . " else concat('(',sepciality.SpecialitySpecializationName,')') end),"
                . "',',concat('форма: ',eduform.PersonEducationFormName)) SEPARATOR ';;') AS SPECS"),
        new CDbExpression('GROUP_CONCAT(specs.StatusID SEPARATOR ";;") AS idSTATUSES'),
        new CDbExpression('GROUP_CONCAT(status.PersonRequestStatusTypeName SEPARATOR ";;") AS STATUSES'),
    );
    if (is_numeric($reqFacultyID)){
      $criteria->compare('sepciality.FacultetID',$reqFacultyID);
    }
    $criteria->group = 't.idPerson';
    $criteria->order = 'NAME ASC, sepciality.SpecialityName, sepciality.SpecialityDirectionName, status.idPersonRequestStatusType';
    //$criteria->limit = '100';
    $models = Person::model()->findAll($criteria);
    $contact_data = array();
    foreach ($models as $model){
      $specs = explode(';;',$model->SPECS);
      $contacts = explode(';;',$model->PsnContacts);
      $_status_ids = explode(';;',$model->idSTATUSES);
      $_statuses = explode(';;',$model->STATUSES);
      
      $statuses = array();
      $status_ids = array();
      for ($i = 0; $i < count($_status_ids); $i++){
        if ($i%2){
          $status_ids[] = $_status_ids[$i];
          $statuses[] = $_statuses[$i];
        }
      }
      $contact_data[$model->idPerson] = array(
          'NAME' => $model->NAME,
          'PsnContacts' => $contacts,
          'SPECS' => $specs,
          'status_ids' => $status_ids,
          'statuses' => $statuses,
      ); 
    }
    $this->layout = '//layouts/clear';
    $this->render('//personcontactsview/print', array(
        'contact_data' => $contact_data
    ));
  }
  
  /**
   * Метод повертає JSON-укомплектовані дані для AJAX-запиту
   * вибірки усіх полів при формуванні звіту
   */
  public function actionQdata($q){
    $fields = array();
    $fields[] = array('text' => 'ПІБ персони', 'id' => 0);
    $fields[] = array('text' => 'Форма навчання', 'id' => 15);
    $fields[] = array('text' => 'ОКР', 'id' => 17);
    $fields[] = array('text' => 'Напрям', 'id' => 23);
    $fields[] = array('text' => 'Факультет', 'id' => 8);
    $fields[] = array('text' => 'На бюджет', 'id' => 9);
    $fields[] = array('text' => 'На контракт', 'id' => 10);
    $fields[] = array('text' => 'Потрібен гуртожиток', 'id' => 11);
    $fields[] = array('text' => 'Статус заявки', 'id' => 12);
    $fields[] = array('text' => 'Дата створення заявки', 'id' => 13);
    $fields[] = array('text' => 'Спеціальність', 'id' => 7);
    $fields[] = array('text' => 'Дата народження', 'id' => 1);
    $fields[] = array('text' => 'Адреса КОАТУУ', 'id' => 2);
    $fields[] = array('text' => 'Країна громадянства', 'id' => 3);
    $fields[] = array('text' => 'Закінчено навчальний заклад', 'id' => 4);
    $fields[] = array('text' => 'Місце народження', 'id' => 5);
    $fields[] = array('text' => 'Іноземна мова', 'id' => 6);
    $fields[] = array('text' => 'ЗНО (інформація)', 'id' => 14);
    $fields[] = array('text' => 'Іспити (інформація)', 'id' => 16);
    $fields[] = array('text' => 'Документи', 'id' => 18);
    $fields[] = array('text' => 'Пільги', 'id' => 19);
    $fields[] = array('text' => 'Тип пільги', 'id' => 20);
    $fields[] = array('text' => 'Першочергово', 'id' => 21);
    $fields[] = array('text' => 'Поза конкурсом', 'id' => 22);
    
    if (!$q){
      $result = $fields;
    } else {
      $result = array();
      foreach($fields as $f){
        if (strstr($f['text'],$q) !== FALSE){
          $result[] = $f;
        }
      }
    }
    echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає усі іноземні мови
   */
  public function actionLanguages(){
      $models = Languages::model()->findAll();
      $result = array();
      foreach ($models as $model){
          /* @var $model Languages */
          $result[] = array('text' => $model->LanguagesName, 'id' => $model->idLanguages);
      }
      echo CJSON::encode($result);
  }

  /**
   * Метод асинхронно повертає усі статуси заявок
   */
  public function actionReqstatuses(){
      $models = Personrequeststatustypes::model()->findAll();
      $result = array();
      foreach ($models as $model){
          /* @var $model Personrequeststatustypes */
          $result[] = array('text' => $model->PersonRequestStatusTypeName, 
              'id' => $model->idPersonRequestStatusType);
      }
      echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає знайдені дані КОАТУУ
   */
  public function actionKoatuus($q){
    $result = array();
    $koatuu_keys = explode(' ',$q);
    $kriteria1 = new CDbCriteria();
    $kriteria2 = new CDbCriteria();
    $kriteria3 = new CDbCriteria();
    foreach ($koatuu_keys as $koatuu_key){
      $kriteria3->compare("concat(KOATUULevel3FullName,"
              . "' (тип: ',KOATUULevel3Type,')')",
              $koatuu_key,true);
      $kriteria2->compare("KOATUULevel2FullName",
              $koatuu_key,true);
      $kriteria1->compare("KOATUULevel1FullName",
              $koatuu_key,true);
    }
    $k3models_count = KoatuuLevel3::model()->count($kriteria3);
    $k2models_count = KoatuuLevel2::model()->count($kriteria2);
    $k1models_count = KoatuuLevel1::model()->count($kriteria1);

    if ($k3models_count + $k2models_count + $k1models_count > 50){
      $result = array();
    } else {
      $k3models = KoatuuLevel3::model()->findAll($kriteria3);
      foreach ($k3models as $model){
        /* @var $model KoatuuLevel3 */
        $result[] = array('text' => $model->KOATUULevel3FullName, 
            'id' => $model->idKOATUULevel3);
      }
      $k2models = KoatuuLevel2::model()->findAll($kriteria2);
      foreach ($k2models as $model){
        /* @var $model KoatuuLevel2 */
        $result[] = array('text' => $model->KOATUULevel2FullName, 
            'id' => $model->idKOATUULevel2);
      }
      $k1models = KoatuuLevel1::model()->findAll($kriteria1);
      foreach ($k1models as $model){
        /* @var $model KoatuuLevel1 */
        $result[] = array('text' => $model->KOATUULevel1FullName, 
            'id' => $model->idKOATUULevel1);
      }
    }
    echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає список предметів ЗНО
   */
  public function actionZno(){
      $models = Subjects::model()->findAll('idZNOSubject>0 ORDER BY SubjectName ASC');
      $result = array();
      foreach ($models as $model){
          /* @var $model Subjects */
          $result[] = array('text' => $model->SubjectName, 
              'id' => $model->idSubjects);
      }
      echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає список типів документів
   */
  public function actionDoctypes(){
      $models = PersonDocumentTypes::model()->findAll('1 ORDER BY PersonDocumentTypesName ASC');
      $result = array();
      foreach ($models as $model){
          /* @var $model PersonDocumentTypes */
          $result[] = array('text' => $model->PersonDocumentTypesName, 
              'id' => $model->idPersonDocumentTypes);
      }
      echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає список типів пільг
   */
  public function actionBenefitgroups(){
      $models = Benefit::model()->findAll('1 ORDER BY BenefitName ASC');
      $result = array();
      foreach ($models as $model){
          /* @var $model Benefit */
          $result[] = array('text' => str_replace('"', "'", $model->BenefitName), 
              'id' => $model->idBenefit);
      }
      echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає список форм навчання
   */
  public function actionEduforms(){
      $models = Personeducationforms::model()->findAll('1 ORDER BY PersonEducationFormName ASC');
      $result = array();
      foreach ($models as $model){
          /* @var $model Personeducationforms */
          $result[] = array('text' => str_replace('"', "'", $model->PersonEducationFormName), 
              'id' => $model->idPersonEducationForm);
      }
      echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає список ОКР
   */
  public function actionOkr(){
      $models = Qualifications::model()->findAll('1 ORDER BY QualificationName ASC');
      $result = array();
      foreach ($models as $model){
          /* @var $model Qualifications */
          $result[] = array('text' => str_replace('"', "'", $model->QualificationName), 
              'id' => $model->idQualification);
      }
      echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає список країн громадянства персон
   */
  public function actionCountries(){
      $models = Country::model()->findAll('1 ORDER BY CountryName ASC');
      $result = array();
      foreach ($models as $model){
          /* @var $model Country */
          $result[] = array('text' => str_replace('"', "'", $model->CountryName), 
              'id' => $model->idCountry);
      }
      echo CJSON::encode($result);
  }
  
  /**
   * Метод асинхронно повертає список НЗ, що закінчили персони
   */
  public function actionSchools(){
      $models = Schools::model()->findAll('1 ORDER BY SchoolName ASC');
      $result = array();
      foreach ($models as $model){
          /* @var $model Schools */
          $result[] = array('text' => str_replace('"', "'", $model->SchoolName), 
              'id' => $model->idSchool);
      }
      echo CJSON::encode($result);
  }
}
