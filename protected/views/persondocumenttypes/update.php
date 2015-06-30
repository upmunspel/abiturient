<?php
/* @var $this PersondocumenttypesController */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Типи документів'=>array('index'),
	$model->idPersonDocumentTypes=>array('view','id'=>$model->idPersonDocumentTypes),
	'Редагувати',
);

$this->menu=array(
	array('label'=>'Перелік', 'url'=>array('index')),
	array('label'=>'Створити', 'url'=>array('create')),
	array('label'=>'Переглянути', 'url'=>array('view', 'id'=>$model->idPersonDocumentTypes)),
	array('label'=>'Керування', 'url'=>array('admin')),
);
?>

<h1>Редагувати Документ <?php echo $model->idPersonDocumentTypes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>