<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */

$this->breadcrumbs=array(
	'Personbasespecialities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Personbasespeciality', 'url'=>array('index')),
	array('label'=>'Manage Personbasespeciality', 'url'=>array('admin')),
);
?>

<h1>Create Personbasespeciality</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>