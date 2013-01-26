<?php
$this->breadcrumbs=array(
	'people'=>array('index'),
	$model->idPerson,
);

$this->menu=array(
	array('label'=>'Перелік абітурієнтів','url'=>array('index'),'icon'=>"icon-list-alt"),
	array('label'=>'Додати  абітурієнта','url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Редагувати абітурієнта','url'=>array('update','id'=>$model->idPerson),'icon'=>" icon-pencil"),
	array('label'=>'Видалити абітурієнта','url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPerson),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Person','url'=>array('admin')),
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
