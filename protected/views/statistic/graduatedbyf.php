<?php Yii::app()->bootstrap->register(); ?>
<?php

$Data = $model->search();

$columns = array(
    array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:200px;")),
    array('name'=>'cnt', 'htmlOptions'=>array('style'=>"width:80px;")),
    array('name'=>'cnt_not', 'htmlOptions'=>array('style'=>"width:80px;")),
    array('name'=>'cnt_our', 'htmlOptions'=>array('style'=>"width:80px;")),
    array('name'=>'cnt_ano', 'htmlOptions'=>array('style'=>"width:80px;")),
    
);

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
<title>АБІТУРІЄНТ :: СТАТИСТИКА ВСТУПУ ВИПУСКНИКІВ</title>
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
        if ($col['name'] == 'cnt_not'){
            $table_header .= "К-сть випускників ЗНУ, що не подали заявки</th>";
            $totals[$col['name']] =0;
            continue;
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
                    if ($col['name'] == 'cnt_not'){
                        $all = $data[$i]->getAttribute('cnt');
                        $not = $data[$i]->getAttribute('cnt_our');
                        $all_not = $all - $not;
                        $table_row[$j] .= $all_not."</td>";
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
            if ($col['name'] == 'cnt_not'){
                $all = $data[$i]->getAttribute('cnt');
                $not = $data[$i]->getAttribute('cnt_our');
                $all_not = $all - $not;
                $table_row[$j] .= $all_not."</td>";
                continue;
            }
            $table_row[$j] .= (0+$data[$i]->getAttribute($col['name']))."</td>";
            $totals[$col['name']] += $data[$i]->getAttribute($col['name']);
        }
        $table_row[$j] .= "</tr>";
        $r++;
    }

    
    $table_footer = "<tr>";
    
    foreach ($columns as $col){
        if ($col['name'] == 'Fakultet'){
            $table_footer .= "<td colspan='1'>Усього</td>";
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
    
    //echo $table_footer;
    
?>
    </table>
</center>
    
</body>
</html>