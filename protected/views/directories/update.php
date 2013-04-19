<?php
$this->breadcrumbs=array(
	'Directories'=>array('index'),
	$model->idDirecrtory=>array('view','id'=>$model->idDirecrtory),
	'Update',
);

$this->menu=array(
	array('label'=>'List Directories','url'=>array('index')),
	array('label'=>'Create Directories','url'=>array('create')),
	array('label'=>'View Directories','url'=>array('view','id'=>$model->idDirecrtory)),
	array('label'=>'Manage Directories','url'=>array('admin')),
);
?>

<h1>Update Directories <?php echo $model->idDirecrtory; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>