    <?php
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
$fk = "";
$rowspan[0] = 1;
$table_row = array();
$j = 0;
$N = count($data);
for ($i = 0; $i < $N; $i++){
    if ((($data[$i]->getAttribute('Fakultet') != $fk) && ($fk != ""))){
       $table_row[$j++] = "<tr><td rowspan='".($rowspan[$j-1]-1)."' style='vertical-align:center;width:150px;'>".$fk."</td>"; 
       $rowspan[$j] = 1;
    }
    if ($i == $N-1 && ($data[$i]->getAttribute('Fakultet') != $fk)){
       $fk = $data[$i]->getAttribute('Fakultet');
       $table_row[$j++] = "<tr><td rowspan='".$rowspan[$j-1]."' style='vertical-align:center;width:150px;'>".$fk."</td>"; 
       $rowspan[$j] = 1;
    }
    if ($i == $N-1 && ($data[$i]->getAttribute('Fakultet') == $fk)){
       $table_row[$j++] = "<tr><td rowspan='".($rowspan[$j-1]+1)."' style='vertical-align:center;width:150px;'>".$fk."</td>"; 
       $rowspan[$j-1] += 1;
       break;
    }
    $fk = $data[$i]->getAttribute('Fakultet');
    //echo  $fk."<br/>";
    $rowspan[$j]++;
}

?>

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>АБІТУРІЄНТ :: СТАТИСТИКА</title>
<style media="print">
TD {
	font-size: 7pt;
	border: 1px solid black;
        font-family: 'Tahoma';
}
TH {
	font-size: 7pt;
	border: 1px solid black;
        font-family: 'Tahoma';
}
H1 {
	font-size: 12pt;
        font-family: 'Tahoma';
}

A {
	text-decoration: none;
	color: black;
        font-family: 'Tahoma';
}
</style>
<style media="screen">
TD {
	font-size: 10pt;
	/* border: 1px solid black; */
        padding: 5px;
        font-family: 'Tahoma';
}
TH {
	font-size: 8pt;
	/* border: 1px solid black; */
        padding: 3px;
        font-family: 'Tahoma';
        
}
H1 {
	font-size: 16pt;
}


</style>
</head>
<body>

<center><h1>
<?php
  if (isset($_GET['date']) && !empty($_GET['date'])){
    $d = explode('-',$Date);
    echo "".$d[2].".".$d[1].".".$d[0]."";
  }
?>
</h1>
        
    <table border="1" cellspacing="0">
<?php
   // var_dump($table_row);
    $labels = $model->AttributeLabels();
    $j = 0;
    $r = 1;
    
    $totals = array();
    
    $table_header = "<tr>";
    foreach ($columns as $col){
        if ($col['htmlOptions']){
            $table_header .= "<th style='".$col['htmlOptions']['style']."'>";
        } else {
            $table_header .=  "<th>";
        }
        $table_header .= $labels[$col['name']]."</th>";
        $totals[$col['name']] =0;
    }
    
    $table_header .= "</tr>";
    
    echo $table_header;
    
    for ($i = 0; $i < count($data); $i++){
        if ($r == $rowspan[$j]){
            $table_row[$j++] .= "</tr>\n";
            echo $table_row[$j-1];
            if ($i == count($data)-1){
                foreach ($columns as $col){
                    if ($col['name'] == 'Fakultet'){
                        continue;
                    }
                    if ($col['htmlOptions']){
                        $table_row[$j] .= "<td style='".$col['htmlOptions']['style']."'>";
                    } else {
                        $table_row[$j] .=  "<td>";
                    }
                    if ($col['name'] == 'Specialnost'){
                        $var = $data[$i]->getAttribute($col['name']);
                        $arr = explode('_',$var);
                        $spec = $arr[0];
                        $table_row[$j] .= $spec."</td>";
                        continue;
                    }
                    $table_row[$j] .= $data[$i]->getAttribute($col['name'])."</td>";
                    $totals[$col['name']] += $data[$i]->getAttribute($col['name']);
                }
                $table_row[$j] .= "</tr>";
                echo $table_row[$j];
                break;
            }
            $r = 1;
        }
        foreach ($columns as $col){
            if ($col['name'] == 'Fakultet'){
                continue;
            }
            if ($col['htmlOptions']){
                $table_row[$j] .= "<td style='".$col['htmlOptions']['style']."'>";
            } else {
                $table_row[$j] .=  "<td>";
            }
            if ($col['name'] == 'Specialnost'){
                $var = $data[$i]->getAttribute($col['name']);
                $arr = explode('_',$var);
                $spec = $arr[0];
                $table_row[$j] .= $spec."</td>";
                continue;
            }
            $table_row[$j] .= $data[$i]->getAttribute($col['name'])."</td>";
            $totals[$col['name']] += $data[$i]->getAttribute($col['name']);
        }
        $table_row[$j] .= "</tr>";
        $r++;
    }

    
    $table_footer = "<tr>";
    
    foreach ($columns as $col){
        if ($col['name'] == 'Fakultet'){
            $table_footer .= "<td colspan='2'>Усього</td>";
            continue;
        }
        if ($col['name'] == 'Specialnost'){
            continue;
        }
        if ($col['htmlOptions']){
            $table_footer .= "<td style='".$col['htmlOptions']['style']."'>";
        } else {
            $table_footer .=  "<td>";
        }
        $table_footer .= $totals[$col['name']]."</td>";
    }
    $table_footer .= "</tr>";
    
    echo $table_footer;
    
?>
    </table>
</center>
    
</body>
</html>





