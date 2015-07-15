<?php
/* @var $this ConvertAttestatController */
/* @var $model ConvertAttestat */

$this->breadcrumbs=array(
	'Convert Attestats'=>array('index'),
	$model->twelve_p,
);

$this->menu=array(
	array('label'=>'List ConvertAttestat', 'url'=>array('index')),
	array('label'=>'Create ConvertAttestat', 'url'=>array('create')),
	array('label'=>'Update ConvertAttestat', 'url'=>array('update', 'id'=>$model->twelve_p)),
	array('label'=>'Delete ConvertAttestat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->twelve_p),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConvertAttestat', 'url'=>array('admin')),
);
?>

<h1>View ConvertAttestat #<?php echo $model->twelve_p; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'twelve_p',
		'two_hundred_p',
	),
)); ?>
