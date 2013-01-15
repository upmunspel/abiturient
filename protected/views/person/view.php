<?php
$this->breadcrumbs=array(
	'people'=>array('index'),
	$model->idPerson,
);

$this->menu=array(
	array('label'=>'List Person','url'=>array('index')),
	array('label'=>'Create Person','url'=>array('create')),
	array('label'=>'Update Person','url'=>array('update','id'=>$model->idPerson)),
	array('label'=>'Delete Person','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idPerson),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Person','url'=>array('admin')),
);
?>

<h1>Інформація про абітурієнта (<?php echo $model->idPerson; ?>)</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
        'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idPerson',
		'FirstName',
		'MiddleName',
		'LastName',
	),
)); ?>
