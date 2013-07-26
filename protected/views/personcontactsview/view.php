<?php
/* @var $this PersoncontactsviewController */
/* @var $model PersonContactsView */

$this->breadcrumbs=array(
	'Person Contacts Views'=>array('index'),
	$model->SepcialityID,
);

$this->menu=array(
	array('label'=>'List PersonContactsView', 'url'=>array('index')),
	array('label'=>'Create PersonContactsView', 'url'=>array('create')),
	array('label'=>'Update PersonContactsView', 'url'=>array('update', 'id'=>$model->SepcialityID)),
	array('label'=>'Delete PersonContactsView', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SepcialityID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PersonContactsView', 'url'=>array('admin')),
);
?>

<h1>View PersonContactsView #<?php echo $model->SepcialityID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'FIO',
		'SepcialityID',
		'EducationFormID',
		'isBudget',
		'isContract',
		'SpecName',
		'Contacts',
	),
)); ?>
