<?php
/* @var $this PersonDocumentTypesController */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Person Document Types'=>array('index'),
	$model->idPersonDocumentTypes=>array('view','id'=>$model->idPersonDocumentTypes),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List PersonDocumentTypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonDocumentTypes)),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Змінити запис довідника PersonDocumentTypes <?php echo $model->idPersonDocumentTypes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>