<?php
/* @var $this PersonDocumentTypesController */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Person Document Types'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List PersonDocumentTypes', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Створити запис довідника PersonDocumentTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>