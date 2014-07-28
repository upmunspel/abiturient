<?php
/* @var $this QuotaController */
/* @var $model Quota */

$this->breadcrumbs=array(
	'Quota'=>array('index'),
	'Довідник ',
);

$this->menu=array(
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);
?>

<h1>Довідник "Квоти"</h1>


<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
  'id'=>'quota-grid',
  'type'=>'striped bordered condensed',
  'dataProvider'=>$model->search(),
  'filter'=>$model,
  'columns'=>array(
      'idQuota',
      'QuotaName',
      array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
      ),
  ),
)); ?>
