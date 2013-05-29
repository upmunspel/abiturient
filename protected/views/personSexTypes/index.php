<?php
/* @var $this PersonSexTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Person Sex Types',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Person Sex Typesrgfgbf</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
