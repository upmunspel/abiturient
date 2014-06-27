<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */

$this->breadcrumbs=array(
	'Personbasespecialities'=>array('index'),
	$model->idPersonBaseSpeciality=>array('view','id'=>$model->idPersonBaseSpeciality),
	'Update',
);

$this->menu=array(
	array('label'=>'Перелік', 'url'=>array('admin')),
	array('label'=>'Створити', 'url'=>array('create')),
	//array('label'=>'View Personbasespeciality', 'url'=>array('view', 'id'=>$model->idPersonBaseSpeciality)),
	array('label'=>'Управління', 'url'=>array('admin')),
);
?>

<h1>Оновити Базовий напрям #<?php echo $model->idPersonBaseSpeciality; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>