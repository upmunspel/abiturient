<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */

$this->breadcrumbs=array(
	'Person Sex Types'=>array('index'),
	$model->idPersonSexTypes,
);

$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idPersonSexTypes),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonSexTypes),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Статі" #<?php echo $model->idPersonSexTypes; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idPersonSexTypes',
		'PersonSexTypesName',
	),
)); ?>
