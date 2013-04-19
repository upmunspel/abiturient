<?php
$this->breadcrumbs=array(
	'Directories'=>array('index'),
	$model->idDirecrtory,
);

$this->menu=array(
	array('label'=>'List Directories','url'=>array('index')),
	array('label'=>'Create Directories','url'=>array('create')),
	array('label'=>'Update Directories','url'=>array('update','id'=>$model->idDirecrtory)),
	array('label'=>'Delete Directories','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idDirecrtory),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Directories','url'=>array('admin')),
);
?>

<h1>View Directories #<?php echo $model->idDirecrtory; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'idDirecrtory',
		'DirectoryName',
		'DirectoryInfo',
		'DirectoryLink',
		'Visible',
		'Access',
	),
)); ?>
