<?php
/* @var $this PersonDocumentTypesController */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Person Document Types'=>array('index'),
	$model->idPersonDocumentTypes,
);

$this->menu=array(
	/*array('label'=>'List PersonDocumentTypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idPersonDocumentTypes)),
	array('label'=>'Видалити запис', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonDocumentTypes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника PersonDocumentTypes #<?php echo $model->idPersonDocumentTypes; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idPersonDocumentTypes',
		'PersonDocumentTypesName',
		'IsEntrantDocument',
	),
)); ?>
