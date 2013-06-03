<?php
$this->breadcrumbs=array(
	'Person Benefits'=>array('index'),
	$model->idPersonBenefits,
);

$this->menu=array(
	array('label'=>'List PersonBenefits','url'=>array('index')),
	array('label'=>'Create PersonBenefits','url'=>array('create')),
	array('label'=>'Update PersonBenefits','url'=>array('update','id'=>$model->idPersonBenefits)),
	array('label'=>'Delete PersonBenefits','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonBenefits),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PersonBenefits','url'=>array('admin')),
);
?>

<h1>View PersonBenefits #<?php echo $model->idPersonBenefits; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'idPersonBenefits',
		'PersonID',
		'BenefitID',
	),
)); ?>
