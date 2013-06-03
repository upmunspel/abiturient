<?php
$this->breadcrumbs=array(
	'Personbenefits',
);

$this->menu=array(
	array('label'=>'Create Personbenefits','url'=>array('create')),
	array('label'=>'Manage Personbenefits','url'=>array('admin')),
);
?>

<h1>Personbenefits</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
