<?php
/* @var $this CoursedpController */
/* @var $model Coursedp */

$this->breadcrumbs=array(
	'Coursedps'=>array('index'),
	$model->idCourseDP=>array('view','id'=>$model->idCourseDP),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Coursedp', 'url'=>array('index')),
	array('label'=>'Створити запис', 'url'=>array('create')),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idCourseDP)),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Змінити "Курси довузівської підготовки" <?php echo $model->idCourseDP; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>