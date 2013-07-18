<?php Yii::app()->bootstrap->register(); ?>
<?php

$data = $model->search();

$columns = array(
    array('name'=>'vypusknik', 'htmlOptions'=>array('style'=>"width:180px;")),
    array('name'=>'kem_vydan_diplom', 'htmlOptions'=>array('style'=>"width:280px;")),
    array('name'=>'Fakultet', 'htmlOptions'=>array('style'=>"width:150px;")),
    array('name'=>'Specialnost', 'htmlOptions'=>array('style'=>"width:180px;")),

    
);

$this->widget('bootstrap.widgets.TbGroupGridView', array(
'id'=>'all-counts-view-grid_',
    'type'=>'striped bordered condensed',
'dataProvider'=>$data,
//'rowCssClassExpression'=>'empty($data->SpecEdboID) && empty($data->PersonEdboID) ?"row-red":"row-green"',
//'filter'=>$model,
'mergeColumns' => array('vypusknik'),
'columns'=>$columns,

)); ?>