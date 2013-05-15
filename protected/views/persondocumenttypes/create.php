<?php
/* @var $this Persondocumenttypescontroller */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Person Document Types'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List PersonDocumentTypes', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Типи документів особи"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>