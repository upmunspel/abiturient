<?php

class StatController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public $defaultAction = 'index';
    public $ip = '10.1.100.10';

    public function init() {
        parent::init();
        if (!Yii::app()->user->isGuest) {
            $this->ip = Yii::app()->user->userModel->syspk->printIP;
        }
    }

    protected function getKoatuuComparatorQuery($token, $QualificationID, $statuses, $date_segment, $sql_as) {
        $sql_str = '((SELECT COUNT(DISTINCT ps8.idPersonSpeciality) FROM personspeciality ps8 '
                . 'LEFT JOIN person ON ps8.PersonID=person.idPerson '
                . 'LEFT JOIN koatuulevel3 k3 ON k3.idKOATUULevel3=person.KOATUUCodeID '
                . 'LEFT JOIN koatuulevel2 k2 ON k2.idKOATUULevel2=person.KOATUUCodeID '
                . 'LEFT JOIN koatuulevel1 k1 ON k1.idKOATUULevel1=person.KOATUUCodeID '
                . ' WHERE '
                . 'ps8.SepcialityID=t.idSpeciality AND '
                . 'ps8.QualificationID = ' . $QualificationID . ' AND '
                . 'ps8.StatusID IN (' . $statuses . ') AND '
                . 'IF('
                . 'ISNULL(person.KOATUUCodeID),0,'
                . '(IF(k3.KOATUULevel3FullName IS NOT NULL,k3.KOATUULevel3FullName LIKE "%' . $token . '%",0) OR '
                . 'IF(k2.KOATUULevel2FullName IS NOT NULL,k2.KOATUULevel2FullName LIKE "%' . $token . '%",0) OR '
                . 'IF(k1.KOATUULevel1FullName IS NOT NULL,k1.KOATUULevel1FullName LIKE "%' . $token . '%",0)'
                . ')'
                . ') AND '
                . 'ps8.CreateDate BETWEEN '
                . $date_segment
                . ')) AS ' . $sql_as;
        return $sql_str;
    }

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
                'actions' =>
                array('index', 'view',
                    "viewall", "queryconstructor", "qdata",
                    'languages', 'reqstatuses', 'koatuus', 'zno',
                    'doctypes', 'benefitgroups', 'eduforms', 'okr',
                    'countries', 'schools',
                    "statgraduated", 'awards', 'personstatgraduated', 'exlanguages',
                    "SpecMagContracts", "Acts", "CreateActs", "basespecs", "getphotozip", "Operators",
                    'crossentrant'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array("contacts", "sysreport", "deletesysreport",
                    'graduated', 'deletegraduated'),
                'roles' => array('Root', 'Admin'),),
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
        $reqQualificationID = Yii::app()->request->getParam('QualificationID', 1);
        $reqDate = Yii::app()->request->getParam('Date', date('d.m.Y'));
        $secname = Yii::app()->request->getParam('secname', '_');

        $time = strtotime(str_replace('.', '-', $reqDate));
        $date = date('Y-m-d', time());
        if ($time !== FALSE) {
            $date = date('Y-m-d', $time);
        }
        $spec_ident = '6';
        switch ($reqQualificationID) {
            case 1 : $spec_ident = '6';
                break;
            case 2 : $spec_ident = '8';
                break;
            case 3 : $spec_ident = '7';
                break;
        }
        $statuses = '1,2,4,5,6,7,8,9';
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'facultet',
        );
        $criteria->addCondition('t.PersonEducationFormID IN(1,2)');
        $criteria->addCondition('t.idSpeciality NOT IN(162738)');
        $criteria->addCondition('SUBSTR(t.SpecialityClasifierCode,1,1) LIKE '
                . '"' . $spec_ident . '"');

        $criteria->select = array('*',
            new CDbExpression('((SELECT COUNT(ps.idPersonSpeciality) FROM personspeciality ps WHERE '
                    . 'ps.SepcialityID=t.idSpeciality AND '
                    . 'ps.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps.StatusID IN (' . $statuses . ') AND '
                    . 'ps.CreateDate BETWEEN '
                    . '"' . $date . ' 00:00:00' . '" '
                    . 'AND "' . $date . ' 23:59:59")) AS cnt_requests_per_day'),
            new CDbExpression('((SELECT COUNT(ps.idPersonSpeciality) FROM personspeciality ps WHERE '
                    . 'ps.SepcialityID=t.idSpeciality AND '
                    . 'ps.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps.StatusID IN (' . $statuses . ') AND '
                    . 'ps.CreateDate BETWEEN '
                    //. '"'.date('Y').'-07-01 00:00:00' . '" '
                    . '"2014-07-01 00:00:00' . '" '
                    . 'AND "' . $date . ' 23:59:59")) AS cnt_requests'),
            new CDbExpression('((SELECT COUNT(DISTINCT ps.PersonID) FROM personspeciality ps WHERE '
                    . 'ps.QualificationID IN ' . (($reqQualificationID == 1) ? '(1)' : '(2,3)') . ' AND '
                    . 'ps.StatusID IN (' . $statuses . ') AND '
                    . 'ps.CreateDate BETWEEN '
                    . '"' . $date . ' 00:00:00' . '" '
                    . 'AND "' . $date . ' 23:59:59")) AS cnt_persons_per_day'),
            new CDbExpression('((SELECT COUNT(DISTINCT ps.PersonID) FROM personspeciality ps WHERE '
                    . 'ps.QualificationID IN ' . (($reqQualificationID == 1) ? '(1)' : '(2,3)') . ' AND '
                    . 'ps.StatusID IN (' . $statuses . ') AND '
                    . 'ps.CreateDate BETWEEN '
                    //. '"'.date('Y').'-07-01 00:00:00' . '" '
                    . '"2014-07-01 00:00:00' . '" '
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
        $i = 0;
        foreach ($specs as $spec) {
            /* @var $spec Specialities */
            if (!isset($cnt_data[$spec->FacultetID])) {
                $cnt_data[$spec->FacultetID] = array();
            }
            if (!isset($cnt_data[$spec->FacultetID]['name'])) {
                $cnt_data[$spec->FacultetID]['name'] = $spec->facultet->FacultetFullName;
            }

            $lspec_ident = mb_substr($spec->SpecialityClasifierCode, 0, 1, 'utf-8');
            $idOKR = 1;
            if ($lspec_ident == '7')
                $idOKR = 3;
            if ($lspec_ident == '8')
                $idOKR = 2;
            $spec_name = $spec->SpecialityClasifierCode . ' '
                    . (($lspec_ident == '6') ?
                            $spec->SpecialityDirectionName : $spec->SpecialityName )
                    . (($spec->SpecialitySpecializationName == '') ?
                            '' : ' (' . $spec->SpecialitySpecializationName . ')');

            $sql_cnt_requests_per_day = Yii::app()->db->createCommand('(SELECT COUNT(ps.idPersonSpeciality)AS coun FROM personspeciality ps WHERE '
                            . 'ps.SepcialityID= ' . $spec->idSpeciality . ' AND '
                            . 'ps.EducationFormID= ' . $spec->PersonEducationFormID . ' AND '
                            . 'ps.QualificationID = ' . $idOKR . ' AND '
                            //  . 'ps.StatusID IN ('.$statuses.') AND '
                            . 'ps.CreateDate BETWEEN '
                            . '"' . $date . ' 00:00:00' . '" '
                            . 'AND "' . $date . ' 23:59:59")')->queryRow();
            $cnt_data[$spec->FacultetID][$spec_name][$spec->PersonEducationFormID] = array(
                'eduform' => ($spec->PersonEducationFormID == 1) ? 'денна' : "заочна",
                // 'cnt_requests_per_day' => ($spec->cnt_requests_per_day)? 
                'cnt_requests_per_day' => ($sql_cnt_requests_per_day['coun'] > 0) ?
                        '<a href="http://' . $this->ip . ':8080/request_report-1.0/journal.jsp?'
                        . 'SpecialityID=' . $spec->idSpeciality
                        . '&idOKR=' . (($idOKR))
                        . '&eduFormID=' . $spec->PersonEducationFormID
                        . '&date=' . $date
                        . '&secname=' . urlencode($secname) . '">'
                        . $spec->cnt_requests_per_day . '</a>' : '0',
                'cnt_requests' => $spec->cnt_requests,
            );
            $counts_atall[$spec->PersonEducationFormID]['per_day'] += $spec->cnt_requests_per_day;
            $counts_atall[$spec->PersonEducationFormID]['all'] += $spec->cnt_requests;
            if ($i == 0) {
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
        $reqQualificationID = Yii::app()->request->getParam('QualificationID', 1);
        $reqDateFrom = Yii::app()->request->getParam('DateFrom', date('d.m.Y'));
        $reqDateTo = Yii::app()->request->getParam('DateTo', date('d.m.Y'));
        $reqSpecialities = Yii::app()->request->getParam('Specialities', null);
        $reqBudgetColumn = 0;
        $reqContractColumn = 0;
        $reqPvColumn = 0;
        $reqPzkColumn = 0;
        $reqElectroColumn = 0;
        $reqOriginalsColumn = 0;
        $reqDonetskColumn = 0;
        $reqLuganskColumn = 0;
        $reqCrimeaColumn = 0;
        $statuses = implode(',', array_flip(Personrequeststatustypes::model()->getStatusList()));
        if (isset($reqSpecialities['modes']) && !empty($reqSpecialities['modes'])) {
            foreach ($reqSpecialities['modes'] as $val) {
                switch ($val) {
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
                    case 'Donetsk':
                        $reqDonetskColumn = 1;
                        break;
                    case 'Lugansk':
                        $reqLuganskColumn = 1;
                        break;
                    case 'Crimea':
                        $reqCrimeaColumn = 1;
                        break;
                }
            }
        }
        if (isset($reqSpecialities['statuses']) && !empty($reqSpecialities['statuses'])) {
            $statuses = implode(',', $reqSpecialities['statuses']);
        }
        if (!is_numeric($reqQualificationID)) {
            $reqQualificationID = 1;
        }

        $timeFrom = strtotime(str_replace('.', '-', $reqDateFrom));
        $dateFrom = date('Y-m-d', time());
        if ($timeFrom !== FALSE) {
            $dateFrom = date('Y-m-d', $timeFrom);
        }
        $timeTo = strtotime(str_replace('.', '-', $reqDateTo));
        $dateTo = date('Y-m-d', time());
        if ($timeTo !== FALSE) {
            $dateTo = date('Y-m-d', $timeTo);
        }
        $spec_ident = '6';
        switch ($reqQualificationID) {
            case 1 : $spec_ident = '6';
                break;
            case 2 : $spec_ident = '8';
                break;
            case 3 : $spec_ident = '7';
                break;
        }

        $criteria = new CDbCriteria();
        $criteria->with = array(
            'facultet',
        );
        $criteria->addCondition('t.PersonEducationFormID IN(1,2)');
        $criteria->addCondition('t.idSpeciality NOT IN(162738)');
        $criteria->addCondition('SUBSTR(t.SpecialityClasifierCode,1,1) LIKE '
                . '"' . $spec_ident . '"');

        $date_segment = '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59"';

        $criteria->select = array('*',
            new CDbExpression('((SELECT COUNT(ps5.idPersonSpeciality) FROM personspeciality ps5 WHERE '
                    . 'ps5.SepcialityID=t.idSpeciality AND '
                    . 'ps5.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps5.StatusID IN (' . $statuses . ') AND '
                    . 'ps5.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_requests'),
            (($reqBudgetColumn) ? new CDbExpression('((SELECT COUNT(ps1.idPersonSpeciality) FROM personspeciality ps1 WHERE '
                    . 'ps1.SepcialityID=t.idSpeciality AND '
                    . 'ps1.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps1.StatusID IN (' . $statuses . ') AND '
                    . 'ps1.isBudget = 1 AND '
                    . 'ps1.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_req_budget') : 'idSpeciality' ),
            (($reqContractColumn) ? new CDbExpression('((SELECT COUNT(ps2.idPersonSpeciality) FROM personspeciality ps2 WHERE '
                    . 'ps2.SepcialityID=t.idSpeciality AND '
                    . 'ps2.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps2.StatusID IN (' . $statuses . ') AND '
                    . 'ps2.isContract = 1 AND '
                    . 'ps2.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_req_contract') : 'idSpeciality' ),
            (($reqOriginalsColumn) ? new CDbExpression('((SELECT COUNT(ps3.idPersonSpeciality) FROM personspeciality ps3 WHERE '
                    . 'ps3.SepcialityID=t.idSpeciality AND '
                    . 'ps3.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps3.StatusID IN (' . $statuses . ') AND '
                    . 'ps3.isCopyEntrantDoc <> 1 AND '
                    . 'ps3.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_req_original') : 'idSpeciality' ),
            (($reqElectroColumn) ? new CDbExpression('((SELECT COUNT(ps4.idPersonSpeciality) FROM personspeciality ps4 WHERE '
                    . 'ps4.SepcialityID=t.idSpeciality AND '
                    . 'ps4.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps4.StatusID IN (' . $statuses . ') AND '
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
                    . 'ps6.StatusID IN (' . $statuses . ') AND '
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
                    . 'ps7.StatusID IN (' . $statuses . ') AND '
                    . 'IF(ISNULL(benefit.isPZK),0,(benefit.isPZK = 1)) AND '
                    . 'ps7.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_req_pzk') : 'idSpeciality' ),
            new CDbExpression('((SELECT COUNT(DISTINCT ps.PersonID) FROM personspeciality ps WHERE '
                    . 'ps.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps.StatusID IN (' . $statuses . ') AND '
                    . 'ps.CreateDate BETWEEN '
                    . $date_segment . ')) AS cnt_persons'),
            (($reqDonetskColumn) ? new CDbExpression(
                    $this->getKoatuuComparatorQuery("ДОНЕЦЬК", $reqQualificationID, $statuses, $date_segment, 'cnt_req_Donetsk')) : 'idSpeciality' ),
            (($reqLuganskColumn) ? new CDbExpression(
                    $this->getKoatuuComparatorQuery("ЛУГАНСЬК", $reqQualificationID, $statuses, $date_segment, 'cnt_req_Lugansk')) : 'idSpeciality' ),
            (($reqCrimeaColumn) ? new CDbExpression(
                    $this->getKoatuuComparatorQuery("КРИМ", $reqQualificationID, $statuses, $date_segment, 'cnt_req_Crimea')) : 'idSpeciality' ),
        );
        $criteria->group = 'idSpeciality';
        $criteria->order = 'facultet.FacultetFullName,SpecialityDirectionName,SpecialityName';
        $specs = Specialities::model()->findAll($criteria);

        $cnt_data = array();
        $i = 0;
        $cnt_atall = array();
        $cnt_atall[1] = array(
            'cnt_req_budget' => 0,
            'cnt_req_contract' => 0,
            'cnt_req_electro' => 0,
            'cnt_req_originals' => 0,
            'cnt_req_pv' => 0,
            'cnt_req_pzk' => 0,
            'cnt_req_Donetsk' => 0,
            'cnt_req_Lugansk' => 0,
            'cnt_req_Crimea' => 0,
            'cnt_requests' => 0,
        );
        $cnt_atall[2] = array(
            'cnt_req_budget' => 0,
            'cnt_req_contract' => 0,
            'cnt_req_electro' => 0,
            'cnt_req_originals' => 0,
            'cnt_req_pv' => 0,
            'cnt_req_pzk' => 0,
            'cnt_req_Donetsk' => 0,
            'cnt_req_Lugansk' => 0,
            'cnt_req_Crimea' => 0,
            'cnt_requests' => 0,
        );
        foreach ($specs as $spec) {
            /* @var $spec Specialities */
            if (!isset($cnt_data[$spec->FacultetID])) {
                $cnt_data[$spec->FacultetID] = array();
            }
            if (!isset($cnt_data[$spec->FacultetID]['name'])) {
                $cnt_data[$spec->FacultetID]['name'] = $spec->facultet->FacultetFullName;
            }
            $lspec_ident = mb_substr($spec->SpecialityClasifierCode, 0, 1, 'utf-8');
            $spec_name = $spec->SpecialityClasifierCode . ' '
                    . (($lspec_ident == '6') ?
                            $spec->SpecialityDirectionName : $spec->SpecialityName )
                    . (($spec->SpecialitySpecializationName == '') ?
                            '' : ' (' . $spec->SpecialitySpecializationName . ')');
            $cnt_data[$spec->FacultetID][$spec_name][$spec->PersonEducationFormID] = array(
                'eduform' => ($spec->PersonEducationFormID == 1) ? 'денна' : "заочна",
                'cnt_req_budget' => $spec->cnt_req_budget,
                'cnt_req_contract' => $spec->cnt_req_contract,
                'cnt_req_electro' => $spec->cnt_req_electro,
                'cnt_req_originals' => $spec->cnt_req_original,
                'cnt_req_pv' => $spec->cnt_req_pv,
                'cnt_req_pzk' => $spec->cnt_req_pzk,
                'cnt_req_Donetsk' => $spec->cnt_req_Donetsk,
                'cnt_req_Lugansk' => $spec->cnt_req_Lugansk,
                'cnt_req_Crimea' => $spec->cnt_req_Crimea,
                'cnt_requests' => $spec->cnt_requests,
            );
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_budget'] += $spec->cnt_req_budget;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_contract'] += $spec->cnt_req_contract;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_electro'] += $spec->cnt_req_electro;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_originals'] += $spec->cnt_req_original;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_pv'] += $spec->cnt_req_pv;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_pzk'] += $spec->cnt_req_pzk;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_Donetsk'] += $spec->cnt_req_Donetsk;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_Lugansk'] += $spec->cnt_req_Lugansk;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_req_Crimea'] += $spec->cnt_req_Crimea;
            $cnt_atall[$spec->PersonEducationFormID]['cnt_requests'] += $spec->cnt_requests;
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
            'cDonetsk' => $reqDonetskColumn,
            'cLugansk' => $reqLuganskColumn,
            'cCrimea' => $reqCrimeaColumn,
            'cnt_person' => isset($specs[0]) ? $specs[0]->cnt_persons : 0,
            'cnt_atall' => $cnt_atall,
        ));
    }

    /**
     * @todo It's Hard
     */
    public function actionQueryconstructor() {
        
    }

    /**
     * Метод створює сторінку контактної інформації персон.
     * @todo YEAH!!!
     */
    public function actionContacts() {
        $reqFacultyID = Yii::app()->request->getParam('FacultyID', null);

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
        if (is_numeric($reqFacultyID)) {
            $criteria->compare('sepciality.FacultetID', $reqFacultyID);
        }
        $criteria->group = 't.idPerson';
        $criteria->order = 'sepciality.SpecialityName, sepciality.SpecialityDirectionName, NAME ASC'; //, status.idPersonRequestStatusType';
        //$criteria->limit = '100';
        $models = Person::model()->findAll($criteria);
        $contact_data = array();
        foreach ($models as $model) {
            $specs = explode(';;', $model->SPECS);
            $contacts = explode(';;', $model->PsnContacts);
            $_status_ids = explode(';;', $model->idSTATUSES);
            $_statuses = explode(';;', $model->STATUSES);

            $statuses = array();
            $status_ids = array();
            for ($i = 0; $i < count($_status_ids); $i++) {
                if ($i % 2) {
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
    public function actionQdata($q) {
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
        $fields[] = array('text' => 'Номер справи', 'id' => 26);
        $fields[] = array('text' => 'Номер заяви', 'id' => 29);
        $fields[] = array('text' => 'Дата створення заявки', 'id' => 13);
        $fields[] = array('text' => 'Спеціальність', 'id' => 7);
        $fields[] = array('text' => 'Дата народження', 'id' => 1);
        $fields[] = array('text' => 'Адреса КОАТУУ', 'id' => 2);
        $fields[] = array('text' => 'Країна громадянства', 'id' => 3);
        //$fields[] = array('text' => 'Закінчено навчальний заклад', 'id' => 4);
        $fields[] = array('text' => 'Курси ДП', 'id' => 25);
        $fields[] = array('text' => 'Місце народження', 'id' => 5);
        $fields[] = array('text' => 'Іноземна мова', 'id' => 6);
        $fields[] = array('text' => 'Іноземна мова заяви', 'id' => 30);
        $fields[] = array('text' => 'ЗНО (інформація)', 'id' => 14);
        $fields[] = array('text' => 'Іспити (інформація)', 'id' => 16);
        $fields[] = array('text' => 'Документи', 'id' => 18);
        $fields[] = array('text' => 'Тип документа', 'id' => 24);
        $fields[] = array('text' => 'Пільги', 'id' => 19);
        $fields[] = array('text' => 'Тип пільги', 'id' => 20);
        $fields[] = array('text' => 'Першочергово', 'id' => 21);
        $fields[] = array('text' => 'Поза конкурсом', 'id' => 22);
        $fields[] = array('text' => 'Копія', 'id' => 27);
        $fields[] = array('text' => 'Відзнака', 'id' => 28);
        $fields[] = array('text' => 'Базова спеціальність', 'id' => 31);
        $fields[] = array('text' => 'Додатковий балл', 'id' => 32);
        $fields[] = array('text' => 'Приорітет', 'id' => 33);

        if (!$q) {
            $result = $fields;
        } else {
            $result = array();
            foreach ($fields as $f) {
                if (strstr($f['text'], $q) !== FALSE) {
                    $result[] = $f;
                }
            }
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає усі іноземні мови
     */
    public function actionLanguages() {
        $models = Languages::model()->findAll();
        $result = array();
        foreach ($models as $model) {
            /* @var $model Languages */
            $result[] = array('text' => $model->LanguagesName, 'id' => $model->idLanguages);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає усі іноземні мови заяви
     */
    public function actionExlanguages() {
        $models = Languagesex::model()->findAll('1 ORDER BY LanguageExName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Languages */
            $result[] = array('text' => $model->LanguageExName, 'id' => $model->idLanguageEx);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає усі статуси заявок
     */
    public function actionReqstatuses() {
        $models = Personrequeststatustypes::model()->findAll();
        $result = array();
        foreach ($models as $model) {
            /* @var $model Personrequeststatustypes */
            $result[] = array('text' => $model->PersonRequestStatusTypeName,
                'id' => $model->idPersonRequestStatusType);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає знайдені дані КОАТУУ
     */
    public function actionKoatuus($q) {
        $result = array();
        $koatuu_keys = explode(' ', $q);
        $kriteria1 = new CDbCriteria();
        $kriteria2 = new CDbCriteria();
        $kriteria3 = new CDbCriteria();
        foreach ($koatuu_keys as $koatuu_key) {
            $kriteria3->compare("concat(KOATUULevel3FullName,"
                    . "' (тип: ',KOATUULevel3Type,')')", $koatuu_key, true);
            $kriteria2->compare("KOATUULevel2FullName", $koatuu_key, true);
            $kriteria1->compare("KOATUULevel1FullName", $koatuu_key, true);
        }
        $k3models_count = KoatuuLevel3::model()->count($kriteria3);
        $k2models_count = KoatuuLevel2::model()->count($kriteria2);
        $k1models_count = KoatuuLevel1::model()->count($kriteria1);

        if ($k3models_count + $k2models_count + $k1models_count > 50) {
            $result = array();
        } else {
            $k3models = KoatuuLevel3::model()->findAll($kriteria3);
            foreach ($k3models as $model) {
                /* @var $model KoatuuLevel3 */
                $result[] = array('text' => $model->KOATUULevel3FullName,
                    'id' => $model->idKOATUULevel3);
            }
            $k2models = KoatuuLevel2::model()->findAll($kriteria2);
            foreach ($k2models as $model) {
                /* @var $model KoatuuLevel2 */
                $result[] = array('text' => $model->KOATUULevel2FullName,
                    'id' => $model->idKOATUULevel2);
            }
            $k1models = KoatuuLevel1::model()->findAll($kriteria1);
            foreach ($k1models as $model) {
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
    public function actionZno() {
        $models = Subjects::model()->findAll('idZNOSubject>0 ORDER BY SubjectName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Subjects */
            $result[] = array('text' => $model->SubjectName,
                'id' => $model->idSubjects);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає список типів документів
     */
    public function actionDoctypes() {
        $models = PersonDocumentTypes::model()->findAll('1 ORDER BY PersonDocumentTypesName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model PersonDocumentTypes */
            $result[] = array('text' => $model->PersonDocumentTypesName,
                'id' => $model->idPersonDocumentTypes);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає список типів пільг
     */
    public function actionBenefitgroups() {
        $models = Benefit::model()->findAll('1 ORDER BY BenefitName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Benefit */
            $result[] = array('text' => str_replace('"', "'", $model->BenefitName),
                'id' => $model->idBenefit);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає список форм навчання
     */
    public function actionEduforms() {
        $models = Personeducationforms::model()->findAll('1 ORDER BY PersonEducationFormName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Personeducationforms */
            $result[] = array('text' => str_replace('"', "'", $model->PersonEducationFormName),
                'id' => $model->idPersonEducationForm);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає список ОКР
     */
    public function actionOkr() {
        $models = Qualifications::model()->findAll('1 ORDER BY QualificationName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Qualifications */
            $result[] = array('text' => str_replace('"', "'", $model->QualificationName),
                'id' => $model->idQualification);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає список країн громадянства персон
     */
    public function actionCountries() {
        $models = Country::model()->findAll('1 ORDER BY CountryName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Country */
            $result[] = array('text' => str_replace('"', "'", $model->CountryName),
                'id' => $model->idCountry);
        }
        echo CJSON::encode($result);
    }

    /**
     * Метод асинхронно повертає список НЗ, що закінчили персони
     */
    public function actionSchools() {
        $models = Schools::model()->findAll('1 ORDER BY SchoolName ASC');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Schools */
            $result[] = array('text' => str_replace('"', "'", $model->SchoolName),
                'id' => $model->idSchool);
        }
        echo CJSON::encode($result);
    }

    public function actionAwards() {
        $models = Persondocumentsawardstypes::model()->findAll('1 ORDER BY PersonDocumentsAwardsTypesName');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Schools */
            $result[] = array('text' => str_replace('"', "'", $model->PersonDocumentsAwardsTypesName),
                'id' => $model->idPersonDocumentsAwardsTypes);
        }
        echo CJSON::encode($result);
    }

    public function actionBasespecs() {
        $models = Personbasespeciality::model()->findAll('1 ORDER BY PersonBaseSpecialityName');
        $result = array();
        foreach ($models as $model) {
            /* @var $model Personbasespeciality */
            $result[] = array('text' => str_replace('"', "'", implode(' ', array($model->PersonBaseSpecialityClasifierCode,
                    $model->PersonBaseSpecialityName))),
                'id' => $model->idPersonBaseSpeciality);
        }
        echo CJSON::encode($result);
    }

    /**
     * Статистика заяв на старші курси.
     */
    public function actionStatgraduated() {
        /* @var $reqQualifictionID integer */
        $reqQualificationID = Yii::app()->request->getParam('QualificationID', 1);
        $reqDateFrom = Yii::app()->request->getParam('DateFrom', date('d.m.Y'));
        $reqDateTo = Yii::app()->request->getParam('DateTo', date('d.m.Y'));


        $statuses = '1,2,4,5,6,7,8,9';
        if (isset($reqSpecialities['statuses']) && !empty($reqSpecialities['statuses'])) {
            $statuses = implode(',', $reqSpecialities['statuses']);
        }
        if (!is_numeric($reqQualificationID)) {
            $reqQualificationID = 3;
        }

        $timeFrom = strtotime(str_replace('.', '-', $reqDateFrom));
        $dateFrom = date('Y-m-d', time());
        if ($timeFrom !== FALSE) {
            $dateFrom = date('Y-m-d', $timeFrom);
        }
        $timeTo = strtotime(str_replace('.', '-', $reqDateTo));
        $dateTo = date('Y-m-d', time());
        if ($timeTo !== FALSE) {
            $dateTo = date('Y-m-d', $timeTo);
        }
        $spec_ident = '7';
        switch ($reqQualificationID) {
            case 2 : $spec_ident = '8';
                break;
            case 3 : $spec_ident = '7';
                break;
        }

        $criteria = new CDbCriteria();
        $criteria->with = array(
            'facultet',
            'eduform'
        );

        $criteria->addCondition('t.PersonEducationFormID IN(1,2)');
        $criteria->addCondition('SUBSTR(t.SpecialityClasifierCode,1,1) LIKE '
                . '"' . $spec_ident . '"');
        $date_segment = '"' . $dateFrom . ' 00:00:00' . '" '
                . 'AND "' . $dateTo . ' 23:59:59"';
        $ZNU = "Запорізький національний університет";
        $ZNU1 = "Запорізьким національним університетом";
        $ZNU2 = "Запорізького національного університету";
        $ZNUshort = "ЗНУ";
        $criteria->select = array('*',
            new CDbExpression('((SELECT COUNT(DISTINCT ps5.idPersonSpeciality) FROM personspeciality ps5'
                    . ' WHERE '
                    . 'ps5.SepcialityID=t.idSpeciality AND '
                    . 'ps5.QualificationID =' . $reqQualificationID . ' AND '
                    . 'ps5.StatusID IN (' . $statuses . ') AND '
                    . 'ps5.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_requests_from_aliens'),
            new CDbExpression('((SELECT COUNT(DISTINCT ps4.idPersonSpeciality)'
                    . ' FROM personspeciality ps4'
                    . ' LEFT OUTER JOIN documents docs4 ON ps4.PersonID = docs4.PersonID WHERE '
                    . 'ps4.SepcialityID=t.idSpeciality AND '
                    . 'ps4.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps4.StatusID IN (' . $statuses . ') AND '
                    . '(docs4.Issued LIKE "%' . $ZNU . '%" OR '
                    . 'docs4.Issued LIKE "%' . $ZNU1 . '%" OR '
                    . 'docs4.Issued LIKE "%' . $ZNU2 . '%" OR '
                    . 'docs4.Issued LIKE "%' . $ZNUshort . '%") AND '
                    . 'docs4.TypeID IN (11,12) AND '
                    . 'ps4.CreateDate BETWEEN '
                    . $date_segment
                    . ' )) AS cnt_requests_from_us'),
            new CDbExpression('((SELECT COUNT(ps1.idPersonSpeciality) FROM personspeciality ps1 WHERE '
                    . 'ps1.SepcialityID=t.idSpeciality AND '
                    . 'ps1.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps1.StatusID IN (' . $statuses . ') AND '
                    . 'ps1.isBudget = 1 AND '
                    . 'ps1.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_req_budget'),
            new CDbExpression('((SELECT COUNT(ps3.idPersonSpeciality) FROM personspeciality ps3 WHERE '
                    . 'ps3.SepcialityID=t.idSpeciality AND '
                    . 'ps3.QualificationID = ' . $reqQualificationID . ' AND '
                    . 'ps3.StatusID IN (' . $statuses . ') AND '
                    . 'ps3.isCopyEntrantDoc <> 1 AND '
                    . 'ps3.CreateDate BETWEEN '
                    . $date_segment
                    . ')) AS cnt_req_original')
        );
        $criteria->addCondition('t.idSpeciality NOT IN(162738)');
        $criteria->group = 'idSpeciality';
        $criteria->order = 'facultet.FacultetFullName,SpecialityDirectionName,SpecialityName';
        $specs = Specialities::model()->findAll($criteria);

        $cnt_data = array();
        $i = 0;
        $gmodels = Graduated::model()->findAll('Year = ' . date('Y'));
        $gnums = array();
        foreach ($gmodels as $gmodel) {
            $_info = array();
            $_info['num'] = $gmodel->Number;
            $_info['spec_tokens'] = array();
            $tokens = explode(' ', $gmodel->Speciality);
            foreach ($tokens as $toks) {
                foreach (explode('(', $toks) as $_toks) {
                    foreach (explode(')', $_toks) as $tok) {
                        if ($tok) {
                            $_info['spec_tokens'][] = $tok;
                        }
                    }
                }
            }
            $gnums[] = $_info;
        }
        $cnt_atall = array();
        $cnt_atall[1] = array();
        $cnt_atall[2] = array();
        $cnt_atall[1][0] = 0;
        $cnt_atall[1][1] = 0;
        $cnt_atall[1][2] = 0;
        $cnt_atall[1][3] = 0;
        $cnt_atall[1][4] = 0;
        $cnt_atall[2][0] = 0;
        $cnt_atall[2][1] = 0;
        $cnt_atall[2][2] = 0;
        $cnt_atall[2][3] = 0;
        $cnt_atall[2][4] = 0;
        foreach ($specs as $spec) {
            /* @var $spec Specialities */
            if (!isset($cnt_data[$spec->FacultetID])) {
                $cnt_data[$spec->FacultetID] = array();
            }
            if (!isset($cnt_data[$spec->FacultetID]['name'])) {
                $cnt_data[$spec->FacultetID]['name'] = $spec->facultet->FacultetFullName;
            }
            $lspec_ident = mb_substr($spec->SpecialityClasifierCode, 0, 1, 'utf-8');
            $spec_name = $spec->SpecialityClasifierCode . ' ' . (($lspec_ident == '6') ?
                            $spec->SpecialityDirectionName : $spec->SpecialityName )
                    . (($spec->SpecialitySpecializationName == '') ?
                            '' : ' (' . $spec->SpecialitySpecializationName . ')');
            $edu_form = $spec->eduform->PersonEducationFormName;
            $search_spec_name = $spec_name . ' , форма: ' . $edu_form;
            $graduated_num = 0;
            $num_for_this_spec = true;
            foreach ($gnums as $gindex => $gnum) {
                $is_prykladn = false;
                $num_for_this_spec = true;
                foreach ($gnum['spec_tokens'] as $tok) {
                    if (strstr($tok, "прикладн") !== FALSE) {
                        $is_prykladn = true;
                    }
                    if (strstr($search_spec_name, trim($tok)) === FALSE && $tok !== 'Екстернат') {
                        $num_for_this_spec = false;
                        break;
                    }
                }
                if (strstr($search_spec_name, "прикладн") !== FALSE && !$is_prykladn) {
                    continue;
                }
                if ($num_for_this_spec) {
                    $graduated_num += $gnum['num'];
                    unset($gnums[$gindex]);
                    continue;
                }
            }
            $cnt_requests_from_us = $spec->cnt_requests_from_us;
            $cnt_requests_from_aliens = $spec->cnt_requests_from_aliens - $spec->cnt_requests_from_us;
            $ngrauated = $graduated_num;
            $cnt_atall[$spec->PersonEducationFormID][0] += $cnt_requests_from_us;
            $cnt_atall[$spec->PersonEducationFormID][1] += $cnt_requests_from_aliens;
            $cnt_atall[$spec->PersonEducationFormID][2] += $spec->cnt_requests_from_aliens;
            $cnt_atall[$spec->PersonEducationFormID][3] += $spec->SpecialityBudgetCount;
            $cnt_atall[$spec->PersonEducationFormID][4] += $spec->cnt_req_original;
            // if (isset($cnt_data[$spec->FacultetID][trim($spec_name)][$spec->PersonEducationFormID])){
            // $cnt_requests_from_us += $cnt_data[$spec->FacultetID][trim($spec_name)][$spec->PersonEducationFormID]['cnt_requests_from_us'];
            // $cnt_requests_from_aliens += $cnt_data[$spec->FacultetID][trim($spec_name)][$spec->PersonEducationFormID]['cnt_requests_from_aliens'];
            // $ngrauated = $cnt_data[$spec->FacultetID][trim($spec_name)][$spec->PersonEducationFormID]['graduated'];
            // }
            $cnt_data[$spec->FacultetID][trim($spec_name)][$spec->PersonEducationFormID] = array(
                'eduform' => $edu_form,
                'idSpec' => $spec->idSpeciality,
                'cnt_requests_from_us' => $cnt_requests_from_us,
                'cnt_requests_from_aliens' => $cnt_requests_from_aliens,
                'graduated' => $ngrauated,
                'cnt_req_budget' => $spec->SpecialityBudgetCount,
                'cnt_req_originals' => $spec->cnt_req_original,
            );
            $i++;
        }
        $this->layout = '//layouts/clear';
        $this->render('/statistic/statgraduated', array(
            'cnt_data' => $cnt_data,
            'cnt_atall' => $cnt_atall,
            'DateFrom' => $reqDateFrom,
            'DateTo' => $reqDateTo,
            'Qualification' => ($reqQualificationID == 2) ? 'Магістр' : 'Спеціаліст',
        ));
    }

    /**
     * Метод формує статистику формату: 
     * Факультет; К-сть випускників; К-сть заяв із ЗНУ на спеціаліста/магістра із дипломом ЗНУ, виданим цього року
     */
    public function actionPersonstatgraduated() {
        Yii::import('application.models.Qualifications');

        $criteria = new CDbCriteria();
        $criteria->with = array(
            'facultet',
        );
        $criteria->addCondition('t.SpecialityClasifierCode LIKE "%7.%" OR '
                . 't.SpecialityClasifierCode LIKE "%8.%"');
        $ZNU = "Запорізький національний університет";
        $ZNU1 = "Запорізьким національним університетом";
        $ZNU2 = "Запорізького національного університету";
        $ZNUshort = "ЗНУ";
        $statuses = '1,4,5,7,8,9';
        $criteria->select = array('*',
            new CDbExpression('(SELECT SUM(gr.Number) FROM graduated gr WHERE `year`=' . date('Y') . ' AND  gr.FacultyID = t.FacultetID ) AS cnt_grad'),
            new CDbExpression('0+(('
                    . 'SELECT COUNT(DISTINCT ps4.PersonID) '
                    . 'FROM personspeciality ps4 '
                    . '     INNER JOIN documents docs4 ON ps4.EntrantDocumentID = docs4.idDocuments '
                    . 'WHERE ps4.SepcialityID IN (SELECT spc.idSpeciality FROM specialities spc WHERE t.FacultetID = spc.FacultetID) '
                    . ' AND  ps4.StatusID IN (' . $statuses . ') ' // враховуємо тільки не відкликані заяви
                    . ' AND  ps4.QualificationID IN ('.Qualifications::$specialist.','.Qualifications::$magistr.') ' // враховуємо лише вступників на спеціалістів, магістрів
                    . ' AND (docs4.Issued LIKE "%' . $ZNU . '%" OR docs4.Issued LIKE "%' . $ZNU1 . '%" OR  docs4.Issued LIKE "%' . $ZNU2 . '%" OR  docs4.Issued LIKE "%' . $ZNUshort . '%") '
                    . ' AND docs4.TypeID IN(11,12,13) '  // враховуємо дипломи бакалаврів, спеціалістів, магістрів
                    . ' AND (year(docs4.DateGet) =' . date('Y') . ') '
                    . ')) AS cnt_requests_from_us'),
        );
        $criteria->group = 't.FacultetID';
        $criteria->order = 'facultet.FacultetFullName';
        $criteria->together = true;
        $models = Specialities::model()->findAll($criteria);
        
        //        echo "<pre>";
        //        foreach ($models as $model) {
        //            echo $model->facultet->FacultetFullName."\t".$model->cnt_grad."\t".$model->cnt_requests_from_us."<br>";
        //        }
        //        echo "</pre>";
        //        return;
        
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=file.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $output = fopen("php://output", "w");
        fputcsv($output, array(iconv('UTF-8', 'Windows-1251', 'Факультет'),
            iconv('UTF-8', 'Windows-1251', "Випуск " . date('Y')),
            iconv('UTF-8', 'Windows-1251', "ЗНУ " . date('Y'))), ';');
        foreach ($models as $model) {
            fputcsv($output, array(iconv('UTF-8', 'Windows-1251', $model->facultet->FacultetFullName),
                iconv('UTF-8', 'Windows-1251', $model->cnt_grad),
                iconv('UTF-8', 'Windows-1251', $model->cnt_requests_from_us)), ';');
        }
        fclose($output);
    }

    /**
     * Метод формує статистику формату: 
     * ЄДЕБО( ПІБ; код. спеціальності; форма; статус  ) ; Абітурієнт(дата оплати за навчання/ "НЕ СПЛАЧЕНО")
     */
    public function actionSpecMagContracts() {
        $ReqSelectModes = Yii::app()->request->getParam('select_modes');
        $ReqSelectMode = Yii::app()->request->getParam('select_mode');
        //var_dump($_GET);exit();
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'edbo',
        );
        $criteria->select = array(
            't.idPersonSpeciality',
            't.edboID',
            new CDbExpression('edbo.ID AS ID'),
            new CDbExpression('edbo.PIB AS PIB'),
            new CDbExpression('edbo.Speciality AS Speciality'),
            new CDbExpression('edbo.Specialization AS Specialization'),
            new CDbExpression('edbo.Status AS Status'),
            new CDbExpression('edbo.EduForm AS EduForm'),
            new CDbExpression("(SELECT IF(contracts.PaymentDate LIKE '0000-00-00','НЕ СПЛАЧЕНО',contracts.PaymentDate) 
          FROM contracts 
          WHERE contracts.PersonSpecialityID=t.idPersonSpeciality) AS _PaymentDate"),
            new CDbExpression("(SELECT contracts.ContractDate 
          FROM contracts 
          WHERE contracts.PersonSpecialityID=t.idPersonSpeciality) AS _ContractDate")
        );
        $criteria->addCondition("edbo.ID IS NOT NULL");
        $criteria->addCondition("IF(
        (edbo.Status LIKE 'Рекомендовано' OR edbo.Status LIKE 'До наказу'),
        edbo.K=1,
        TRUE)");
        $criteria->addCondition("edbo.Status LIKE 'Рекомендовано' 
        OR edbo.Status LIKE 'Допущено' 
        OR edbo.Status LIKE 'До наказу'");
        if (!isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.EduQualification NOT LIKE '%бакалавр%'");
        }

        // if (isset($ReqSelectModes[0]) && isset($ReqSelectMode)){
        // $criteria->addCondition("LENGTH((SELECT contracts.ContractDate 
        // FROM contracts 
        // WHERE contracts.PersonSpecialityID=t.idPersonSpeciality LIMIT 1)) > 4");
        // } 
        // if (!isset($ReqSelectModes[0]) && isset($ReqSelectMode)) {
        // $criteria->addCondition("LENGTH((SELECT contracts.ContractDate 
        // FROM contracts 
        // WHERE contracts.PersonSpecialityID=t.idPersonSpeciality LIMIT 1)) = 0 OR
        // ISNULL((SELECT contracts.ContractDate 
        // FROM contracts 
        // WHERE contracts.PersonSpecialityID=t.idPersonSpeciality LIMIT 1))");
        // }
        // if (isset($ReqSelectModes[1]) && isset($ReqSelectMode)){
        // $criteria->addCondition("LENGTH((SELECT contracts.PaymentDate 
        // FROM contracts 
        // WHERE contracts.PersonSpecialityID=t.idPersonSpeciality LIMIT 1)) > 4");
        // }
        // if (!isset($ReqSelectModes[1]) && isset($ReqSelectMode)){
        // $criteria->addCondition("LENGTH((SELECT contracts.PaymentDate 
        // FROM contracts 
        // WHERE contracts.PersonSpecialityID=t.idPersonSpeciality LIMIT 1)) = 0 OR
        // ISNULL((SELECT contracts.PaymentDate 
        // FROM contracts 
        // WHERE contracts.PersonSpecialityID=t.idPersonSpeciality LIMIT 1))");
        // }

        if (!isset($ReqSelectModes[2]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.Status NOT LIKE 'Допущено'");
        }
        if (!isset($ReqSelectModes[3]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.Status NOT LIKE 'Рекомендовано'");
        }
        if (!isset($ReqSelectModes[4]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.Status NOT LIKE 'До наказу'");
        }
        if (!isset($ReqSelectModes[5]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.EduQualification NOT LIKE '%бакалавр%'");
        }
        if (!isset($ReqSelectModes[6]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.EduQualification NOT LIKE '%спеціаліст%'");
        }
        if (!isset($ReqSelectModes[7]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.EduQualification NOT LIKE '%магістр%'");
        }
        if (!isset($ReqSelectModes[8]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.EduForm NOT LIKE 'Денна'");
        }
        if (!isset($ReqSelectModes[9]) && isset($ReqSelectMode)) {
            $criteria->addCondition("edbo.EduForm NOT LIKE 'Заочна'");
        }
        $criteria->group = 't.idPersonSpeciality';
        $criteria->order = 'edbo.PIB ASC';
        $criteria->together = true;
        $models = Personspeciality::model()->findAll($criteria);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=SpecMagContracts.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $output = fopen("php://output", "w");
        fputcsv($output, array(
            iconv('UTF-8', 'Windows-1251', 'Прізвище, ім`я, по-батькові'),
            iconv('UTF-8', 'Windows-1251', "Код"),
            iconv('UTF-8', 'Windows-1251', "Назва спеціальності"),
            iconv('UTF-8', 'Windows-1251', "Форма"),
            iconv('UTF-8', 'Windows-1251', "Статус заяви"),
            iconv('UTF-8', 'Windows-1251', "Дата контракту"),
            iconv('UTF-8', 'Windows-1251', "Дата оплати")), ';');
        foreach ($models as $model) {
            fputcsv($output, array(
                iconv('UTF-8', 'Windows-1251', $model->edbo->PIB),
                iconv('UTF-8', 'Windows-1251', $model->edbo->SpecialCode),
                iconv('UTF-8', 'Windows-1251', $model->edbo->Speciality .
                        ((empty($model->edbo->Specialization)) ? "" : " " . $model->edbo->Specialization)),
                iconv('UTF-8', 'Windows-1251', $model->edbo->EduForm),
                iconv('UTF-8', 'Windows-1251', $model->edbo->Status),
                iconv('UTF-8', 'Windows-1251', (empty($model->_ContractDate) ? "-/-" : $model->_ContractDate)),
                iconv('UTF-8', 'Windows-1251', (empty($model->_PaymentDate) ? "-/-" : $model->_PaymentDate))), ';');
        }
        fclose($output);
    }

    /* Далі - методи для введення і редагування деяких статистичних та системних даних. */

    /**
     * Метод відображення і введення системних даних для формування звітів.
     */
    public function actionSysreport() {
        $model = new SysReport();
        $reqSysReport = Yii::app()->request->getParam('SysReport', null);
        if ($reqSysReport) {
            $model->compar_type = $reqSysReport['compar_type'];
            $model->name = $reqSysReport['name'];
            $model->db_rels = $reqSysReport['db_rels'];
            $model->db_attrname = $reqSysReport['db_attrname'];
            $model->db_alterattr = $reqSysReport['db_alterattr'];
            $model->db_attr = $reqSysReport['db_attr'];
            $model->db_group_concat = $reqSysReport['db_group_concat'];
            $model->view_value = $reqSysReport['view_value'];
            if ($model->save()) {
                $this->redirect(Yii::app()->CreateUrl('/statistic/stat/sysreport'));
            }
        }

        $this->render('/statistic/sysreport', array(
            'model' => $model,
            'data' => SysReport::model()->search(),
        ));
    }

    /**
     * Метод видалення запису системних даних для формування звітів.
     */
    public function actionDeletesysreport($id) {
        $model = SysReport::model()->findByPk($id);
        if ($model) {
            $model->delete();
        }
    }

    /**
     * Метод відображення і введення статистичних даних про кількість випускників бакалаврату.
     */
    public function actionGraduated() {
        $model = new Graduated();
        $reqGraduated = Yii::app()->request->getParam('Graduated', null);
        if ($reqGraduated) {
            $model->Speciality = $reqGraduated['Speciality'];
            $model->Year = $reqGraduated['Year'];
            $model->Number = $reqGraduated['Number'];
            if ($model->save()) {
                $this->redirect(Yii::app()->CreateUrl('/statistic/stat/graduated'));
            }
        }
        $criteria = new CDbCriteria();

        $criteria->group = 'idGraduated';
        $data = new CActiveDataProvider($model, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10000
            ),
        ));
        $model->Year = 2014;
        $this->render('/statistic/graduated', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    /**
     * Метод видалення запису статистичних даних про кількість випускників бакалаврату.
     */
    public function actionDeletegraduated($id) {
        $model = Graduated::model()->findByPk($id);
        if ($model) {
            $model->delete();
        }
    }

    /**
     * Метод повертає архів із фото усіх зарахованих персон для факультету з ID = $id
     */
    public function actionGetphotozip() {
        $id = Yii::app()->request->getParam('id', 0);
        if (!is_numeric($id)) {
            throw new CHttpException(400, 'Помилка: ID має бути цілим числом.');
        }
        $faculty = Facultets::model()->findByPk($id);
        if (!$faculty) {
            throw new CHttpException(400, 'Факультет з ID=' . $id . ' не знайдено.');
        }
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'person',
            'sepciality',
            'sepciality.facultet'
        );
        $criteria->compare('sepciality.FacultetID', $id);
        $criteria->compare('StatusID', 7);
        $criteria->together = true;
        $models = Personspeciality::model()->findAll($criteria);
        if (count($models) == 0) {
            throw new CHttpException(400, 'Помилка: немає даних.');
        }
        $zipname = //iconv('utf-8','windows-1251',$models[0]->sepciality->facultet->FacultetFullName)
                'Facultet_' . $models[0]->sepciality->FacultetID
                . '.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        $def_path = Yii::app()->getBasePath() . '/../images/Photos/';
        $count = 0;
        foreach ($models as $model) {
            $file_entity = $def_path . $model->person->PhotoName;
            if (file_exists($file_entity)) {
                $file_ext = substr(strrchr($file_entity, '.'), 1);
                $res = $zip->addFile($file_entity, $model->PersonID . '.' . $file_ext);
                if ($res) {
                    $count++;
                }
            }
        }
        $zip->close();
        if ($count > 0) {
            $this->redirect(Yii::app()->CreateUrl($zipname));
        } else {
            throw new CHttpException(400, 'Помилка: не знайдено жодного файлу фотографії.');
        }
    }

    /////////////////акти  
    public function actionActs() {
        $this->layout = '//layouts/clear';
        $this->render('/statistic/acts/index');
    }

// Перехресний вступ
    public function actionCrossentrant() {
        //      SELECT 
        //person.idPerson, person.LastName, person.FirstName, person.MiddleName,
        //personeducationforms.PersonEducationFormName, qualifications.QualificationName,
        //facultets.FacultetFullName,
        //specialities.SpecialityClasifierCode,
        //TRIM( CONCAT_WS(' ', specialities.SpecialityDirectionName, specialities.SpecialitySpecializationName,specialities.SpecialityName))  SpecialityTitle
        //FROM personspeciality
        //     INNER JOIN person ON personspeciality.PersonID=person.idPerson
        //     INNER JOIN personeducationforms ON personspeciality.EducationFormID=personeducationforms.idPersonEducationForm
        //     INNER JOIN specialities ON specialities.idSpeciality=personspeciality.SepcialityID
        //     INNER JOIN facultets ON facultets.idFacultet=specialities.FacultetID
        //     INNER JOIN qualifications ON personspeciality.QualificationID=qualifications.idQualification
        //WHERE personspeciality.isCrossEntrant
        //ORDER BY FacultetFullName ASC, QualificationName ASC , SpecialityTitle

        $list = Yii::app()->db->createCommand()
                ->select("
                        person.idPerson, person.LastName, person.FirstName, person.MiddleName,
                        personeducationforms.PersonEducationFormName, qualifications.QualificationName,
                        facultets.FacultetFullName,
                        specialities.SpecialityClasifierCode,
                        TRIM( CONCAT_WS(' ', specialities.SpecialityDirectionName, specialities.SpecialitySpecializationName,specialities.SpecialityName))  SpecialityTitle")
                ->from('personspeciality')
                ->join('person', 'personspeciality.PersonID=person.idPerson')
                ->join('personeducationforms', 'personspeciality.EducationFormID=personeducationforms.idPersonEducationForm')
                ->join('specialities', 'specialities.idSpeciality=personspeciality.SepcialityID')
                ->join('facultets', 'facultets.idFacultet=specialities.FacultetID')
                ->join('qualifications', 'personspeciality.QualificationID=qualifications.idQualification')
                ->where('personspeciality.isCrossEntrant', array())
                ->order('FacultetFullName ASC, QualificationName ASC , SpecialityTitle')
                ->queryAll();
        // print_r($list);

        $this->layout = '//layouts/clear';

        $this->render('/statistic/crossentrant', array(
            'list' => $list
                //        'cnt_data' => $cnt_data,
                //        'summary' => $counts_atall,
                //        'spec_ident' => $spec_ident,
                //        'date' => $reqDate
        ));
    }

    public function actionCreateActs() {
        $this->layout = '//layouts/clear';
        $this->render('/statistic/acts/select');
    }

    /**
     * Operators statistic
     */
    public function actionOperators() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];
        
        $this->render('/statistic/operators', array(
            'model' => $model,
        ));
    }

}
