    <?php
    
    include_once 'print_template.php';
    
    
/* @var $model AllCounts */

    function get_SepcialityID($sid, $form){
        $ids = explode(",",$sid);
        foreach ($ids as $val){
            $var = explode('_',$val);
            $_id = $var[0];
            $_form = 1;
            if (count($var)>1){
                $_form = $var[1];
            }
            if ($form == $_form){
                return $_id;
            }
        }
        return 0;
    }
    
    function get_QualificationID($okr){
        switch ($okr){
            case '6':
                return 1;
            case '7':
                return 3;
            case '8':
                return 2;
        }
        return 0;
    }
    
    function create_link($column, $params, $date = ""){
        $spec = "";
        if (isset($params['Specialnost'])){
            $arr = explode('_',$params['Specialnost']);
            $spec = $arr[0];
        }
        switch ($column){
            case 'dnevn':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Денна';
                if (!empty($date)){
                    $link .= "&date=".$date;
                }
                return $link;
            case 'zaoch':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Заочна';
                if (!empty($date)){
                    $link .= "&date=".$date;
                }
                return $link;
             case 'dnevn_budget':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Денна&isBudget=1';
                return $link;
             case 'zaoch_budget':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Заочна&isBudget=1';
                return $link;
             case 'dnevn_contract':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Денна&isContract=1';
                return $link;
             case 'zaoch_contract':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Заочна&isContract=1';
                return $link;
             case 'dnevn_originals':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Денна&isCopyEntrantDoc=0';
                return $link;
             case 'zaoch_originals':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Заочна&isCopyEntrantDoc=0';
                return $link;
             case 'dnevn_pv':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Денна&isPV=1';
                return $link;
             case 'zaoch_pv':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Заочна&isPV=1';
                return $link;
             case 'dnevn_pzk':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Денна&isPZK=1';
                return $link;
             case 'zaoch_pzk':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Заочна&isPZK=1';
                return $link;
             case 'dnevn_electro':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Денна&RequestFromEB=1';
                return $link;
             case 'zaoch_electro':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&form=Заочна&RequestFromEB=1';
                return $link;
             case 'medals':
                $link = Yii::app()->createUrl('statistic/verify');
                $link .= '?spec='.urlencode($spec).'&medal=1';
                return $link;
        }
        return 0;
    }
//-----------------------------------------------------------------------
    //-----------------------------------------------------------------------//
//-----------------------------------------------------------------------
    
    
$Date = "";
if (isset($_GET['date']) && !empty($_GET['date'])){
    $model = AllCountsPerDates::model();
    $Date = $_GET['date'];
    if (preg_match("/([0-9]{2,2})\.([0-9]{2,2})\.([0-9]{4,4})/",$Date)){
        $d = explode('.',$Date);
        $Date = $d[2].'-'.$d[1].'-'.$d[0];
    }
}
    
    
if (!isset($_GET['okr']) || !is_numeric($_GET['okr'])){
    $Data = $model->search($Date);
    //array_push($columns,array('name'=>'medals'));
}


if (isset($_GET['okr']) && $_GET['okr']==6){
    
    $Data = $model->searchBachelors($Date);
}

if (isset($_GET['okr']) && $_GET['okr']==7){
    $Data = $model->searchSpecialists($Date);
}

if (isset($_GET['okr']) && $_GET['okr']==8){
    $Data = $model->searchMagisters($Date);
}

$mode =0;
if (isset($_GET['mode'])){
	$mode = $_GET['mode'];
}
if (!$mode){
        $mode = 0;
}

if (!empty($_GET['date'])){
        $mode = -1;
}

switch ($mode){
    case 0:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:60px;"),
              'value'=> "CHtml::link(".'$Data->dnevn'.",Yii::app()->createUrl(\"statistic/print\",array(\"SepcialityID\"=>get_SepcialityID(".'$Data->ID'.",1))  ))",
              'type'  => 'raw',),
        array('name'=>'cnt_dnevn_budgetcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'cnt_dnevn_contractcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_budget', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_contract', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_pv', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_pzk', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_originals', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_electro', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:75px;border-left:4px solid green;")),
        array('name'=>'cnt_zaoch_budgetcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'cnt_zaoch_contractcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_budget', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_contract', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_pv', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_pzk', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_originals', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_electro', 'htmlOptions'=>array('style'=>"width:60px;")),
    ); break;
    case 1:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:75px;border-left:4px solid green;")),
    ); break;
    case 2:    
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_budget', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_contract', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:75px;border-left:4px solid green;")),
        array('name'=>'zaoch_budget', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_contract', 'htmlOptions'=>array('style'=>"width:60px;")),
    ); break;
    case 3:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_pv', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_pzk', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:75px;border-left:4px solid green;")),
        array('name'=>'zaoch_pv', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_pzk', 'htmlOptions'=>array('style'=>"width:60px;")),
    ); break;
    case 4:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_electro', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:75px;border-left:4px solid green;")),
        array('name'=>'zaoch_electro', 'htmlOptions'=>array('style'=>"width:60px;")),
    ); break;
    case 5:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'medals', 'htmlOptions'=>array('style'=>"width:60px;"))
    ); break;
    case 6:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'cnt_dnevn_budgetcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'cnt_dnevn_contractcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'dnevn_originals', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:75px;border-left:4px solid green;")),
        array('name'=>'cnt_zaoch_budgetcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'cnt_zaoch_contractcount_view', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch_originals', 'htmlOptions'=>array('style'=>"width:60px;")),
    ); break;
    
    case -1:
    $columns = array(
        array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
        array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:320px;")),
        array('name'=>'dnevn', 'htmlOptions'=>array('style'=>"width:60px;")),
        array('name'=>'zaoch', 'htmlOptions'=>array('style'=>"width:60px;")),
    ); break;
}


    $data = $Data->getData();
    $N = count($data);
    $own_data = array();
    $own_data['totals'] = array();
    for ($i = 0; $i < $N; $i++){
        foreach ($columns as $col){
            $val = $data[$i]->getAttribute($col['name']);
            if (is_numeric($val)){
                $cnt = $val;
                if (!$i){
                    $own_data['totals'][$col['name']] = 0;
                }
                $own_data['totals'][$col['name']] += $cnt;
            }
            $params = array(
                'Specialnost' => $data[$i]->getAttribute('Specialnost'),
            );
            $link = create_link($col['name'], $params, $Date);
            if ($link && $val > 0){
                $val = '<a href="'.$link.'">'.$val.'</a>';
            }
            $own_data[$i][$col['name']] = $val;
        }
    }
    $labels = array();
    foreach ($columns as $col){
        $labels[$col['name']] = $model->getAttributeLabel($col['name']);
    }
    $title = "АБІТУРІЄНТ : ЗАГАЛЬНА СТАТИСТИКА";
    $group_field_name = "Fakultet";
    print_template($own_data,$columns,$labels,$title,$group_field_name);
?>

