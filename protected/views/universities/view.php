<?php
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->IdUniversity,
);

$this->menu=array(
	array('label'=>'List Universities','url'=>array('index')),
	array('label'=>'Create Universities','url'=>array('create')),
	array('label'=>'Update Universities','url'=>array('update','id'=>$model->IdUniversity)),
	array('label'=>'Delete Universities','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->IdUniversity),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Universities','url'=>array('admin')),
);
?>

<h1>View Universities #<?php echo $model->IdUniversity; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'IdUniversity',
		'UniversityKode',
		'UniversityName',
	),
)); ?>
