<?php
/* @var $this PersondocumenttypesController */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Типи документів'=>array('index'),
	'Стаорити',
);

$this->menu=array(
	array('label'=>'Перелік', 'url'=>array('index')),
	array('label'=>'Керування', 'url'=>array('admin')),
);
?>

<h1>Створити документ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>