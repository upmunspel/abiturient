<?php
/* @var $this Persondocumenttypescontroller */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Person Document Types'=>array('index'),
	$model->idPersonDocumentTypes,
);
$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idPersonDocumentTypes),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonDocumentTypes),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Типи документів особи" #<?php echo $model->idPersonDocumentTypes; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idPersonDocumentTypes',
		'PersonDocumentTypesName',
		'IsEntrantDocument',
	),
)); ?>
