<?php
/* @var $this CoursedpController */
/* @var $model Coursedp */

$this->breadcrumbs=array(
	'Coursedps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Coursedp', 'url'=>array('index')),
	array('label'=>'Manage Coursedp', 'url'=>array('admin')),
);
?>

<h1>Створити "Курси довузівської підготовки"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>