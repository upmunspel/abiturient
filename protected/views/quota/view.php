<?php
/* @var $this QuotaController */
/* @var $model Quota */

$this->breadcrumbs=array(
	'Quota'=>array('index'),
	$model->idQuota,
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idQuota)),
	array('label'=>'Видалити запис', 'url'=>'#', 
    'linkOptions'=>array('submit'=>array('delete','id'=>$model->idQuota),
      'confirm'=>'Видалити остаточно?')
  ),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника "Квоти" #<?php echo $model->idQuota; ?></h1>

<?php 
$this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
  'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idQuota',
		'QuotaName',
	),
));
?>
