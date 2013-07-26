<?php
$this->breadcrumbs=array(
	'Personbenefits'=>array('index'),
	$model->idPersonBenefits=>array('view','id'=>$model->idPersonBenefits),
	'Update',
);

$this->menu=array(
	array('label'=>'List Personbenefits','url'=>array('index')),
	array('label'=>'Create Personbenefits','url'=>array('create')),
	array('label'=>'View Personbenefits','url'=>array('view','id'=>$model->idPersonBenefits)),
	array('label'=>'Manage Personbenefits','url'=>array('admin')),
);
?>

<h1>Update Personbenefits <?php echo $model->idPersonBenefits; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>