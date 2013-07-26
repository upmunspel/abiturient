<?php
/* @var $this CoursedpController */
/* @var $model Coursedp */

$this->breadcrumbs=array(
	'Coursedps'=>array('index'),
	$model->idCourseDP,
);

$this->menu=array(
	//array('label'=>'List Coursedp', 'url'=>array('index')),
	array('label'=>'Створити запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idCourseDP)),
	//array('label'=>'Видалити ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCourseDP),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути "Курси довузівської підготовки" #<?php echo $model->idCourseDP; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idCourseDP',
		'CourseDPName',
	),
)); ?>
