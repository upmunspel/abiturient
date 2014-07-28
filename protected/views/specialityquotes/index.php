<?php
/* @var $this SpecialityquotesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'specialityquotes',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Квоти спеціальностей</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
