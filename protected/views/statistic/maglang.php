
<?php

$params = array();
foreach ($_GET as $key => $param){
    switch ($key){
        case 'FacultetID':
            if (is_numeric($param)){
                $params[$key] = $param;
								if ($param == 1638){
									header("Location: ".Yii::app()->createUrl("statistic/maglangfil"));
									exit();
								}
            }
            break;
        case 'SpecialityID':
            if (is_numeric($param)){
                $params[$key] = $param;
            }
            break;
    }
}

$model = MagLang::model();
$Data = $model->search($params);

$columns = array(
//array('name'=>'idPersonMySql'),
array('name'=>'spec','htmlOptions' => array ('style'=>'width:250px;')) ,
array('name'=>'SepcialityID','htmlOptions' => array ('style'=>'width:80px;')) ,
array('name'=>'surname','htmlOptions' => array ('style'=>'width:150px;')) ,
array('name'=>'name','htmlOptions' => array ('style'=>'width:100px;')) ,
array('name'=>'farthername','htmlOptions' => array ('style'=>'width:150px;')) ,
array('name'=>'langName','htmlOptions' => array ('style'=>'width:150px;')) ,
);

$data = $Data->getData();
$group_field = "";
$group_field_name = 'spec';
$rowspan[0] = 1;
$table_row = array();
$j = 0;
$N = count($data);
for ($i = 0; $i < $N; $i++){
    if ((($data[$i]->getAttribute($group_field_name) != $group_field) && ($group_field != ""))){
       $table_row[$j++] = "<tr><td rowspan='".($rowspan[$j-1]-1)."' style='vertical-align:center;width:150px;'>".$group_field."</td>"; 
       $rowspan[$j] = 1;
    }
    if ($i == $N-1 && ($data[$i]->getAttribute($group_field_name) != $group_field)){
       $group_field = $data[$i]->getAttribute($group_field_name);
       $table_row[$j++] = "<tr><td rowspan='".$rowspan[$j-1]."' style='vertical-align:center;width:150px;'>".$group_field."</td>"; 
       $rowspan[$j] = 1;
    }
    if ($i == $N-1 && ($data[$i]->getAttribute($group_field_name) == $group_field)){
       $table_row[$j++] = "<tr><td rowspan='".($rowspan[$j-1]+1)."' style='vertical-align:center;width:150px;'>".$group_field."</td>"; 
       $rowspan[$j-1] += 1;
       break;
    }
    $group_field = $data[$i]->getAttribute($group_field_name);
    //echo  $fk."<br/>";
    $rowspan[$j]++;
}

?>

<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>АБІТУРІЄНТ :: МАГІСТРИ :: ІНОЗЕМНА МОВА</title>
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
    
    
    $table_header = "<tr>";
    foreach ($columns as $col){
        if (isset($col['htmlOptions']) && $col['htmlOptions']){
            $table_header .= "<th style='".$col['htmlOptions']['style']."'>";
        } else {
            $table_header .=  "<th>";
        }
        $table_header .= $labels[$col['name']]."</th>";
    }
    
    $table_header .= "</tr>";
    
    echo $table_header;
    
    for ($i = 0; $i < count($data); $i++){
        if ($r == $rowspan[$j]){
            $table_row[$j++] .= "</tr>\n";
            echo $table_row[$j-1];
            if ($i == count($data)-1){
                foreach ($columns as $col){
                    if ($col['name']==$group_field_name){
                        continue;
                    }
                    if (isset($col['htmlOptions']) && $col['htmlOptions']){
                        $table_row[$j] .= "<td style='".$col['htmlOptions']['style']."'>";
                    } else {
                        $table_row[$j] .=  "<td>";
                    }
                    $table_row[$j] .= $data[$i]->getAttribute($col['name'])."</td>";
                }
                $table_row[$j] .= "</tr>";
                echo $table_row[$j];
                break;
            }
            $r = 1;
        }
        foreach ($columns as $col){
            if ($col['name']==$group_field_name){
                continue;
            }
            if (isset($col['htmlOptions']) && $col['htmlOptions']){
                $table_row[$j] .= "<td style='".$col['htmlOptions']['style']."'>";
            } else {
                $table_row[$j] .=  "<td>";
            }
            $table_row[$j] .= ($data[$i]->getAttribute($col['name']))."</td>";
        }
        $table_row[$j] .= "</tr>";
        $r++;
    }
    
?>
    </table>
</center>
    
</body>
</html>