<?php
$this->breadcrumbs=array(
	'Personbenefits'=>array('index'),
	$model->idPersonBenefits,
);

$this->menu=array(
	array('label'=>'List Personbenefits','url'=>array('index')),
	array('label'=>'Create Personbenefits','url'=>array('create')),
	array('label'=>'Update Personbenefits','url'=>array('update','id'=>$model->idPersonBenefits)),
	array('label'=>'Delete Personbenefits','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonBenefits),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Personbenefits','url'=>array('admin')),
);
?>

<h1>View Personbenefits #<?php echo $model->idPersonBenefits; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'idPersonBenefits',
		'PersonID',
		'BenefitID',
		'Series',
		'Numbers',
		'Issued',
		'Modified',
		'SysUserID',
	),
)); ?>
