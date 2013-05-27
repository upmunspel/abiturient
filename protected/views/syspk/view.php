<?php
$this->breadcrumbs=array(
	'Sys Pks'=>array('index'),
	$model->idPk,
);

$this->menu=array(
	array('label'=>'Перелік','url'=>array('index')),
	array('label'=>'Створити','url'=>array('create')),
	array('label'=>'Змінити','url'=>array('update','id'=>$model->idPk)),
	array('label'=>'Видалити','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idPk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'MУправління','url'=>array('admin')),
);
?>

<h1>View SysPk #<?php echo $model->idPk; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'idPk',
		'PkName',
		'DepartmentID',
		'CourseID',
		'QualificationID',
		'SpecMask',
	),
)); ?>
