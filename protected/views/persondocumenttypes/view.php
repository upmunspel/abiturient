<?php
/* @var $this PersondocumenttypesController */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Типи документів'=>array('index'),
	$model->idPersonDocumentTypes,
);

$this->menu=array(
	array('label'=>'Перелік', 'url'=>array('index')),
	array('label'=>'Створити', 'url'=>array('create')),
	array('label'=>'Редагувати', 'url'=>array('update', 'id'=>$model->idPersonDocumentTypes)),
	array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonDocumentTypes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управління', 'url'=>array('admin')),
);
?>

<h1>Перегляд  Документу #<?php echo $model->idPersonDocumentTypes; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idPersonDocumentTypes',
		'PersonDocumentTypesName',
		'IsEntrantDocument',
		'display',
	),
)); ?>
