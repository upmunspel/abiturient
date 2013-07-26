<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>СТАТИСТИКА ВСТУПУ</title>
<style media="print">
TD {
	font-size: 7pt;
	border: 1px solid black;
}
TH {
	font-size: 10pt;
	border: 1px solid black;
}
H1 {
	font-size: 12pt;
}

A {
	text-decoration: none;
	color: black;
}
</style>
<style media="screen">
TD {
	font-size: 14pt;
	/* border: 1px solid black; */
        padding: 5px;
}
TH {
	font-size: 14pt;
	/* border: 1px solid black; */
        padding: 5px;
        
}
H1 {
	font-size: 16pt;
}


</style>
</head>
<body>


<?php
/* @var $this AllcountsController */
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
    
?>

<center><h2>Статистика вступу абітуріентів Запорізького національного університету <?php echo date("Y"); ?></h2></center>    

    <?php 
if (!isset($_GET['okr']) || !is_numeric($_GET['okr'])){
    $data = $model->search();
    array_push($columns,array('name'=>'medals'));
}


if (isset($_GET['okr']) && $_GET['okr']==6){
    $data = $model->searchBachelors();
}

if (isset($_GET['okr']) && $_GET['okr']==7){
    $data = $model->searchSpecialists();
}

if (isset($_GET['okr']) && $_GET['okr']==8){
    $data = $model->searchMagisters();
}

?>

