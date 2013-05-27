<?php
/* @var $this PersoncontacttypesController */
/* @var $model Personcontacttypes */

$this->breadcrumbs=array(
	'Personcontacttypes'=>array('index'),
	$model->idPersonContactType,
);

$this->menu=array(
	/*array('label'=>'List Personcontacttypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idPersonContactType),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonContactType),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Тип контакту з особою" #<?php echo $model->idPersonContactType; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idPersonContactType',
		'PersonContactTypeName',
	),
)); ?>
