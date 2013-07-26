<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->idContract,
);

$this->menu=array(
	array('label'=>'List Contracts', 'url'=>array('index')),
	array('label'=>'Create Contracts', 'url'=>array('create')),
	array('label'=>'Update Contracts', 'url'=>array('update', 'id'=>$model->idContract)),
	array('label'=>'Delete Contracts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idContract),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contracts', 'url'=>array('admin')),
);
?>

<h1>View Contracts #<?php echo $model->idContract; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idContract',
		'PersonSpecialityID',
		'ContractNumber',
		'ContractDate',
		'CustomerName',
		'CustomerDoc',
		'CustomerAddress',
		'CustomerPaymentDetails',
		'PaymentDate',
		'Comment',
	),
)); ?>
