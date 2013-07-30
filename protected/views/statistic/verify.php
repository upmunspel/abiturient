<?php Yii::app()->bootstrap->register(); ?>
<?php


$params = array();
$all_params = array(
  'okr',
  'form',
  'spec',
  'date',
  'isBudget',
  'isContract',
  'isCopyEntrantDoc',
  'isPZK',
  'isPV',
  'RequestFromEB',
  'medal'
);

foreach($_GET as $key => $val){
	if (in_array($key, $all_params)){
            $params[$key] = $val;
	}
}



$data = $model->search($params);

$columns = array(
    array('name'=>'Pilga', 'htmlOptions'=>array('style'=>"width:350px;font-size:7pt;"),
        'value' => '($data->Pilga)? "$data->Pilga":"немає"'),
    array('name'=>'FIO', 'htmlOptions'=>array('style'=>"width:250px;")),
    array('name'=>'FacultetFullName', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'QualificationName', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'Forma', 'htmlOptions'=>array('style'=>"width:50px;")),
    array('name'=>'exams', 'htmlOptions'=>array('style'=>"width:90px;")),
    array('name'=>'ispity', 'htmlOptions'=>array('style'=>"width:90px;")),
    array('name'=>'olymp', 'htmlOptions'=>array('style'=>"width:90px;")),
    array('name'=>'courses', 'htmlOptions'=>array('style'=>"width:90px;")),
    array('name'=>'isContract', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->isContract == 1)? "так":"ні"'),
    array('name'=>'isBudget', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->isBudget == 1)? "так":"ні"'),
    array('name'=>'isCopyEntrantDoc', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->isCopyEntrantDoc == 1)? "копія":"оригінал"', 'filter'=>array('0'=>'оригінал','1'=>'копія')),
    array('name'=>'RequestFromEB', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->RequestFromEB == 0)? "ні":"так"', 'filter'=>array('0'=>'ні','1'=>'так')),
    array('name'=>'PozaKonkursom', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->PozaKonkursom == 0)? "ні":"так"', 'filter'=>array('0'=>'ні','1'=>'так')),
    array('name'=>'Pozacherg', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->Pozacherg == 0)? "ні":"так"', 'filter'=>array('0'=>'ні','1'=>'так')),
    array('name'=>'VillageQuota', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->VillageQuota == 0)? "ні":"так"', 'filter'=>array('0'=>'ні','1'=>'так')),
    array('name'=>'TargetQuota', 'htmlOptions'=>array('style'=>"width:40px;") , 
        'value' => '($data->TargetQuota == 0)? "ні":"так"', 'filter'=>array('0'=>'ні','1'=>'так')),
    array('name'=>'Date', 'htmlOptions'=>array('style'=>"width:130px;")),
    array('name'=>'Nomer_lichnogo_dela', 'htmlOptions'=>array('style'=>"width:50px;")),
    array('name'=>'N_dela', 'htmlOptions'=>array('style'=>"width:50px;")),
    array('name'=>'Status', 'htmlOptions'=>array('style'=>"width:50px;"), 
        //'value' => '$data->getStatusName($data->StatusID)'
        ),
    array('name'=>'edboID', 'htmlOptions'=>array('style'=>"width:150px;")),
    
);

//$t = new TbGroupGridView(null);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'all-counts-view-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
'rowCssClassExpression'=>'$data->getRowClass($data->StatusID)',
'filter'=>$model,
'mergeColumns' => array('FIO','Pilga'),
'columns'=>$columns,
 'htmlOptions' => array(
     'style' => 'font-size:8pt;',
  )
)); ?>