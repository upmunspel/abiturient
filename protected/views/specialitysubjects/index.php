<?php
$this->breadcrumbs=array(
	'Specialitysubjects',
);

$this->menu=array(
	array('label'=>'Create Specialitysubjects','url'=>array('create')),
	array('label'=>'Manage Specialitysubjects','url'=>array('admin')),
);
?>

<h1>Specialitysubjects</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
