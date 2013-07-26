<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->idContract,
);

$this->menu=array(
	array('label'=>'List Contracts', 'url'=>array('admin'), "icon"=>""),
	array('label'=>'Create Contracts', 'url'=>array('create'), "icon"=>""),
	array('label'=>'Update Contracts', 'url'=>array('update', 'id'=>$model->idContract), "icon"=>""),
	array('label'=>'Delete Contracts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idContract),
            'confirm'=>'Are you sure you want to delete this item?'), "icon"=>""),
	array('label'=>'Manage Contracts', 'url'=>array('admin'), "icon"=>""),
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
