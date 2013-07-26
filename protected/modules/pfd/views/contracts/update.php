<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->idContract=>array('view','id'=>$model->idContract),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contracts', 'url'=>array('admin'), "icon"=>""),
	array('label'=>'Create Contracts', 'url'=>array('create'), "icon"=>""),
	array('label'=>'View Contracts', 'url'=>array('view', 'id'=>$model->idContract), "icon"=>""),
	array('label'=>'Manage Contracts', 'url'=>array('admin'), "icon"=>""),
);
?>

<h1>Update Contracts <?php echo $model->idContract; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'specid'=>$model->PersonSpecialityID)); ?>