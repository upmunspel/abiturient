<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */

$this->breadcrumbs=array(
	'Personbasespecialities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Перелік записів', 'url'=>array('admin')),
	//array('label'=>'Управління', 'url'=>array('admin')),
);
?>

<h1>Створити Базовий напрямки підготовки</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>