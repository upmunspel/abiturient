<?php

    include_once 'print_template.php';
    $params = array();
    foreach ($_GET as $key => $param){
        switch ($key){
            case 'FacultetID':
                if (is_numeric($param)){
                    $params[$key] = $param;
                    if ($param == 1638){
                        $form = 0;
                        if (isset($_GET['eduform'])){
                            $form = $_GET['eduform'];
                        }
                        $Loc = "Location: ".Yii::app()->createUrl("statistic/maglangfil");
                        if ($form > 0){
                            $Loc .= "?eduform=".$form;
                        }
                        header($Loc);
                        exit();
                    }
                }
                break;
            case 'eduform':
                if (is_numeric($param)){
                    $params[$key] = $param;
                }
                break;
        }
    }

    $model = MagLang::model();
    $Data = $model->search($params);

    $columns = array(
    array('name'=>'spec','htmlOptions' => array ('style'=>'width:250px;')) ,
    array('name'=>'eduform','htmlOptions' => array ('style'=>'width:50px;')) ,
    array('name'=>'surname','htmlOptions' => array ('style'=>'width:150px;')) ,
    array('name'=>'name','htmlOptions' => array ('style'=>'width:100px;')) ,
    array('name'=>'farthername','htmlOptions' => array ('style'=>'width:150px;')) ,
    array('name'=>'langName','htmlOptions' => array ('style'=>'width:150px;')) ,
    );
    $data = $Data->getData();
    $labels = $model->AttributeLabels();
    $title = "Список абітурієнтів (ОКР \"магістр\"), що будуть складати екзамен з іноземної мови";
    $group_field_name = '';
    
    print_template($data, $columns, $labels, $title, $group_field_name);

?>
