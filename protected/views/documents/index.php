<?php
/* @var $this DocumentsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = "Документи";
$this->breadcrumbs=array(
	'"Документи"',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>"Документи"</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
