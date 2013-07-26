<?php
/* @var $this PersoncontactsviewController */
/* @var $model PersonContactsView */

$this->breadcrumbs=array(
	'Person Contacts Views'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PersonContactsView', 'url'=>array('index')),
	array('label'=>'Manage PersonContactsView', 'url'=>array('admin')),
);
?>

<h1>Create PersonContactsView</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>