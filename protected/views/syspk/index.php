<?php
$this->breadcrumbs=array(
	'Sys Pks',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управління','url'=>array('admin')),
);
?>

<h1>Sys Pks</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
