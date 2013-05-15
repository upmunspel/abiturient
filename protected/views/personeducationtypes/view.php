<?php
/* @var $this Personeducationtypescontroller */
/* @var $model Personeducationtypes */

$this->breadcrumbs=array(
	'Personeducationtypes'=>array('index'),
	$model->idPersonEducationTypes,
);

$this->menu=array(
	/*array('label'=>'List Personeducationtypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idPersonEducationTypes),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonEducationTypes),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Тип освіти особи" #<?php echo $model->idPersonEducationTypes; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>array('bordered', 'condensed','striped'),
	'data'=>$model,
	'attributes'=>array(
		'idPersonEducationTypes',
		'PersonEducationTypesName',
	),
)); ?>
