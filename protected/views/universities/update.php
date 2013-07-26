<?php
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->idUniversity=>array('view','id'=>$model->idUniversity),
	'Update',
);

$this->menu=array(
	array('label'=>'List Universities','url'=>array('index')),
	array('label'=>'Create Universities','url'=>array('create')),
	array('label'=>'View Universities','url'=>array('view','id'=>$model->idUniversity)),
	array('label'=>'Manage Universities','url'=>array('admin')),
);
?>

<h1>Update Universities <?php echo $model->idUniversity; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>