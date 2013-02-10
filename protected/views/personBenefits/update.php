<?php
$this->breadcrumbs=array(
	'Person Benefits'=>array('index'),
	$model->idPersonBenefits=>array('view','id'=>$model->idPersonBenefits),
	'Update',
);

$this->menu=array(
	array('label'=>'List PersonBenefits','url'=>array('index')),
	array('label'=>'Create PersonBenefits','url'=>array('create')),
	array('label'=>'View PersonBenefits','url'=>array('view','id'=>$model->idPersonBenefits)),
	array('label'=>'Manage PersonBenefits','url'=>array('admin')),
);
?>

<h1>Update PersonBenefits <?php echo $model->idPersonBenefits; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>