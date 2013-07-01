<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */

$this->breadcrumbs=array(
	'Person Speciality Views'=>array('index'),
	$model->idPersonSpeciality=>array('view','id'=>$model->idPersonSpeciality),
	'Update',
);

$this->menu=array(
	array('label'=>'List PersonSpecialityView', 'url'=>array('index')),
	array('label'=>'Create PersonSpecialityView', 'url'=>array('create')),
	array('label'=>'View PersonSpecialityView', 'url'=>array('view', 'id'=>$model->idPersonSpeciality)),
	array('label'=>'Manage PersonSpecialityView', 'url'=>array('admin')),
);
?>

<h1>Update PersonSpecialityView <?php echo $model->idPersonSpeciality; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>