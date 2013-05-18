<?php
/* @var $this Educationclasscontroller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Educationclasses',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>"Освіта"</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
