<?php
$this->breadcrumbs=array(
	'Specialitysubjects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Specialitysubjects','url'=>array('index')),
	array('label'=>'Create Specialitysubjects','url'=>array('create')),
	array('label'=>'Update Specialitysubjects','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Specialitysubjects','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Specialitysubjects','url'=>array('admin')),
);
?>

<h1>View Specialitysubjects #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'SpecialityID',
		'SubjectID',
		'LevelID',
		'Modified',
		'SysUserID',
	),
)); ?>
