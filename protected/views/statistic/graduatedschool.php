<?php Yii::app()->bootstrap->register(); ?>
<?php

$data = $model->search();

$columns = array(
    array('name'=>'PIB', 'htmlOptions'=>array('style'=>"width:350px;font-size:12pt;")),
    array('name'=>'doc_type', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'Issued', 'htmlOptions'=>array('style'=>"width:250px;")),
    array('name'=>'IssuedYear', 'htmlOptions'=>array('style'=>"width:100px;")),
    array('name'=>'edu_type', 'htmlOptions'=>array('style'=>"width:100px;"),
        'filter'=>array(
            'загальноосвітня середня школа (денна)'=>'денна школа (загальноосвітня)',
            'вечірня школа'=>'вечірня школа',
            'гімназія'=>'гімназія',
            'колегіум'=>'колегіум',
            'коледж'=>'коледж',
            'ліцей'=>'ліцей',
            'навчально-виховний комплекс'=>'навчально-виховний комплекс',
            'спеціалізована школа' => 'спеціалізована школа',
            'технікум' => 'технікум',
            'училище' => 'училище')),
    
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'graduated-school',
 'type'=>'striped bordered condensed',
'dataProvider'=>$data,
'filter'=>$model,
'columns'=>$columns,
 'htmlOptions' => array(
     'style' => 'font-size:12pt;',
  )
)); ?>