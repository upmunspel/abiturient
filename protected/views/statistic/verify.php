<?php Yii::app()->bootstrap->register(); ?>
<?php
$model = PersonspecAll::model();

$params = array();

$data = $model->search($params);

$columns = array(
    array('name'=>'FIO', 'htmlOptions'=>array('style'=>"width:250px;")),
    array('name'=>'FacultetFullName', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'QualificationName', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'Forma', 'htmlOptions'=>array('style'=>"width:50px;")),
    array('name'=>'isContract', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->isContract == 1)? "так":"ні"'),
    array('name'=>'isBudget', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->isBudget == 1)? "так":"ні"'),
    array('name'=>'isCopyEntrantDoc', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->isCopyEntrantDoc == 1)? "копія":"оригінал"'),
    array('name'=>'RequestFromEB', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->RequestFromEB == 0)? "ні":"так"'),
    array('name'=>'Pilga', 'htmlOptions'=>array('style'=>"width:350px;font-size:7pt;"),
        'value' => '($data->Pilga)? "$data->Pilga":"немає"'),
    array('name'=>'PozaKonkursom', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->PozaKonkursom == 0)? "ні":"так"'),
    array('name'=>'Pozacherg', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->Pozacherg == 0)? "ні":"так"'),
    array('name'=>'Date', 'htmlOptions'=>array('style'=>"width:130px;")),
    array('name'=>'edboID', 'htmlOptions'=>array('style'=>"width:50px;")),
    array('name'=>'N_dela', 'htmlOptions'=>array('style'=>"width:50px;")),
    array('name'=>'StatusID', 'htmlOptions'=>array('style'=>"width:50px;"),
//        'value' => 'switch($data->StatusID){ case 1: "Нова заява";break; 
//            case 2: "Відмова";break; 
//            case 3: "Скасована";break; 
//            case 4: "Допущена";break; 
//            case 5: "Рекомендовано";break; 
//            case 6: "Відхилено";break; 
//            case 7: "До наказу";break;
//            case 8: "Із сайту";break; 
//            case 9: "Затримано";break;}'
        ),
    array('name'=>'edboID', 'htmlOptions'=>array('style'=>"width:150px;")),
    
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'all-counts-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
//'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
//'filter'=>$model,
'mergeColumns' => array('FIO'),
'columns'=>$columns,

)); ?>