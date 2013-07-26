<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */

$this->breadcrumbs=array(
	'Personbasespecialities'=>array('index'),
	$model->idPersonBaseSpeciality,
);

$this->menu=array(
	array('label'=>'List Personbasespeciality', 'url'=>array('index')),
	array('label'=>'Create Personbasespeciality', 'url'=>array('create')),
	array('label'=>'Update Personbasespeciality', 'url'=>array('update', 'id'=>$model->idPersonBaseSpeciality)),
	array('label'=>'Delete Personbasespeciality', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonBaseSpeciality),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Personbasespeciality', 'url'=>array('admin')),
);
?>

<h1>View Personbasespeciality #<?php echo $model->idPersonBaseSpeciality; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idPersonBaseSpeciality',
		'PersonBaseSpecialityName',
		'PersonBaseSpecialityClasifierCode',
	),
)); ?>
