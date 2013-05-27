<?php
/* @var $this FacultetsController */
/* @var $model Facultets */
$this->pageTitle = "Факультети";
$this->breadcrumbs=array(
	'Facultets'=>array('index'),
	$model->idFacultet,
);

$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idFacultet),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idFacultet),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Факультет"#<?php echo $model->idFacultet; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idFacultet',
		'FacultetFullName',
		'FacultetShortName',
		'FacultetKode',
		'FacultetTypeName',
	),
)); ?>
