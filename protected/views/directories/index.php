<?php
$this->breadcrumbs=array(
	'Directories',
);

$this->menu=array(
	array('label'=>'Create Directories','url'=>array('create')),
	array('label'=>'Manage Directories','url'=>array('admin')),
);
?>

<h1>Directories</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
