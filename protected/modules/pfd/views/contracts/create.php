<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Contracts', 'url'=>array('index')),
	array('label'=>'Manage Contracts', 'url'=>array('admin')),
);
?>

<h1>Create Contracts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>