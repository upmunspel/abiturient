<?php Yii::app()->bootstrap->register(); ?>
<?php

$data = $model->search();

$columns = array(
    array('name'=>'F', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'S', 'htmlOptions'=>array('style'=>"width:180px;")),
    array('name'=>'zajavi_ot_nas', 'htmlOptions'=>array('style'=>"width:80px;")),
    array('name'=>'ludi_ot_nas', 'htmlOptions'=>array('style'=>"width:80px;")),
    array('name'=>'zajavi_ne_ot_nas', 'htmlOptions'=>array('style'=>"width:80px;")),
    array('name'=>'ludi_ne_ot_nas', 'htmlOptions'=>array('style'=>"width:80px;")),
    
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'all-counts-view-grid_',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
//'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
//'filter'=>$model,
'mergeColumns' => array('F'),
'columns'=>$columns,

)); ?>