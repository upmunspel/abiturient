<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */

$this->breadcrumbs=array(
	'Person Speciality Views'=>array('index'),
	$model->idPersonSpeciality,
);

$this->menu=array(
	array('label'=>'List PersonSpecialityView', 'url'=>array('index')),
	array('label'=>'Create PersonSpecialityView', 'url'=>array('create')),
	array('label'=>'Update PersonSpecialityView', 'url'=>array('update', 'id'=>$model->idPersonSpeciality)),
	array('label'=>'Delete PersonSpecialityView', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonSpeciality),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PersonSpecialityView', 'url'=>array('admin')),
);
?>

<h1>View PersonSpecialityView #<?php echo $model->idPersonSpeciality; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idPersonSpeciality',
		'CreateDate',
		'idPerson',
		'Birthday',
		'FIO',
		'isContract',
		'isBudget',
		'SpecCodeName',
		'QualificationID',
		'CourseID',
		'RequestNumber',
		'PersonRequestNumber',
	),
)); ?>
