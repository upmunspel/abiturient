<?php
/* @var $this PersondocumenttypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Типи документів',
);

$this->menu=array(
	array('label'=>'Створити документ', 'url'=>array('create')),
	array('label'=>'Керування документами', 'url'=>array('admin')),
);
?>

<h1>Типи документів</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
