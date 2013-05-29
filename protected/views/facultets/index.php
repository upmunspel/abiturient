<?php
/* @var $this FacultetsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = "Факультети";
$this->breadcrumbs=array(
	'Facultets',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>"Факультет"</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
