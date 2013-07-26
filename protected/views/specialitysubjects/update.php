<?php
$this->breadcrumbs=array(
	'Specialitysubjects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Specialitysubjects','url'=>array('index')),
	array('label'=>'Create Specialitysubjects','url'=>array('create')),
	array('label'=>'View Specialitysubjects','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Specialitysubjects','url'=>array('admin')),
);
?>

<h1>Update Specialitysubjects <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>