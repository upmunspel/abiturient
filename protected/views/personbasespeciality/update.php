<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */

$this->breadcrumbs=array(
	'Personbasespecialities'=>array('index'),
	$model->idPersonBaseSpeciality=>array('view','id'=>$model->idPersonBaseSpeciality),
	'Update',
);

$this->menu=array(
	array('label'=>'List Personbasespeciality', 'url'=>array('index')),
	array('label'=>'Create Personbasespeciality', 'url'=>array('create')),
	array('label'=>'View Personbasespeciality', 'url'=>array('view', 'id'=>$model->idPersonBaseSpeciality)),
	array('label'=>'Manage Personbasespeciality', 'url'=>array('admin')),
);
?>

<h1>Update Personbasespeciality <?php echo $model->idPersonBaseSpeciality; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>