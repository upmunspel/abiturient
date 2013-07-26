<?php
/* @var $this PersoncontactsviewController */
/* @var $model PersonContactsView */

$this->breadcrumbs=array(
	'Person Contacts Views'=>array('index'),
	$model->SepcialityID=>array('view','id'=>$model->SepcialityID),
	'Update',
);

$this->menu=array(
	array('label'=>'List PersonContactsView', 'url'=>array('index')),
	array('label'=>'Create PersonContactsView', 'url'=>array('create')),
	array('label'=>'View PersonContactsView', 'url'=>array('view', 'id'=>$model->SepcialityID)),
	array('label'=>'Manage PersonContactsView', 'url'=>array('admin')),
);
?>

<h1>Update PersonContactsView <?php echo $model->SepcialityID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>