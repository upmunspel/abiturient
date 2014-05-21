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
                "viewall"),
            'users' => array('@'),
        ),

        array('deny', // deny all users
            'users' => array('*'),
        ),
    );
  }
  
  public function actionIndex() {
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
                . 'ps.StatusID NOT IN (10) AND '
                . 'ps.CreateDate BETWEEN '
                . '"' . $date . ' 00:00:00' . '" '
                . 'AND "' . $date . ' 23:59:59")) AS cnt_requests_per_day'),
        new CDbExpression('((SELECT COUNT(ps.idPersonSpeciality) FROM personspeciality ps WHERE '
                . 'ps.SepcialityID=t.idSpeciality AND '
                . 'ps.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps.StatusID NOT IN (10) AND '
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
    $reqMode = Yii::app()->request->getParam('mode',0);
    $modes = explode(';',$reqMode);
    
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
    
    $criteria->select = array('*',
        new CDbExpression('((SELECT COUNT(ps1.idPersonSpeciality) FROM personspeciality ps1 WHERE '
                . 'ps1.SepcialityID=t.idSpeciality AND '
                . 'ps1.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps1.StatusID NOT IN (10) AND '
                . 'ps1.isBudget = 1 AND '
                . 'ps1.CreateDate BETWEEN '
                . '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59")) AS cnt_req_budget'),
        new CDbExpression('((SELECT COUNT(ps2.idPersonSpeciality) FROM personspeciality ps2 WHERE '
                . 'ps2.SepcialityID=t.idSpeciality AND '
                . 'ps2.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps2.StatusID NOT IN (10) AND '
                . 'ps2.isContract = 1 AND '
                . 'ps2.CreateDate BETWEEN '
                . '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59")) AS cnt_req_contract'),
        new CDbExpression('((SELECT COUNT(ps3.idPersonSpeciality) FROM personspeciality ps3 WHERE '
                . 'ps3.SepcialityID=t.idSpeciality AND '
                . 'ps3.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps3.StatusID NOT IN (10) AND '
                . 'ps3.isCopyEntrantDoc <> 1 AND '
                . 'ps3.CreateDate BETWEEN '
                . '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59")) AS cnt_req_original'),
        new CDbExpression('((SELECT COUNT(ps4.idPersonSpeciality) FROM personspeciality ps4 WHERE '
                . 'ps4.SepcialityID=t.idSpeciality AND '
                . 'ps4.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps4.StatusID NOT IN (10) AND '
                . 'ps4.RequestFromEB = 1 AND '
                . 'ps4.CreateDate BETWEEN '
                . '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59")) AS cnt_req_electro'),
        new CDbExpression('((SELECT COUNT(ps5.idPersonSpeciality) FROM personspeciality ps5 WHERE '
                . 'ps5.SepcialityID=t.idSpeciality AND '
                . 'ps5.QualificationID = ' . $reqQualificationID . ' AND '
                . 'ps5.StatusID NOT IN (10) AND '
                . 'ps5.CreateDate BETWEEN '
                . '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59")) AS cnt_requests'),
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
          'cnt_req_originals' => $spec->cnt_req_electro,
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
    ));
  }

}
