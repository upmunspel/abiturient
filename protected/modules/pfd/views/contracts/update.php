<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->idContract=>array('view','id'=>$model->idContract),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contracts', 'url'=>array('index')),
	array('label'=>'Create Contracts', 'url'=>array('create')),
	array('label'=>'View Contracts', 'url'=>array('view', 'id'=>$model->idContract)),
	array('label'=>'Manage Contracts', 'url'=>array('admin')),
);
?>

<h1>Update Contracts <?php echo $model->idContract; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>