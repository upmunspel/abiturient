
<?php
    include_once 'print_template.php';
    $params = array();
    foreach ($_GET as $key => $param){
        switch ($key){
            case 'eduform':
                if (is_numeric($param)){
                    $params[$key] = $param;
                }
                break;
        }
    }
    $model = MagLangFil::model();
    $Data = $model->search($params);
    $columns = array(
    array('name'=>'spec','htmlOptions' => array ('style'=>'width:250px;')) ,
    array('name'=>'eduform','htmlOptions' => array ('style'=>'width:50px;')) ,
    array('name'=>'surname','htmlOptions' => array ('style'=>'width:150px;')) ,
    array('name'=>'name','htmlOptions' => array ('style'=>'width:100px;')) ,
    array('name'=>'farthername','htmlOptions' => array ('style'=>'width:150px;')) ,
    array('name'=>'ForeignLang','htmlOptions' => array ('style'=>'width:150px;')) ,
    array('name'=>'fah','htmlOptions' => array ('style'=>'width:100px;')) ,
    );
    $data = $Data->getData();
    $labels = $model->AttributeLabels();
    $title = "Список абітурієнтів (ОКР \"магістр\") факультету іноземної філології, що будуть скадати іспит з іноземної мови";
    $group_field_name = '';
    
    print_template($data, $columns, $labels, $title, $group_field_name);

?>
