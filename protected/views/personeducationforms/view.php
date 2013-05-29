<?php
/* @var $this PersoneducationformsController */
/* @var $model Personeducationforms */

$this->breadcrumbs=array(
	'Personeducationforms'=>array('index'),
	$model->idPersonEducationForm,
);

$this->menu=array(
	/*array('label'=>'List Personeducationforms', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idPersonEducationForm),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonEducationForm),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Форма освіти особи" #<?php echo $model->idPersonEducationForm; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idPersonEducationForm',
		'PersonEducationFormName',
	),
)); ?>
