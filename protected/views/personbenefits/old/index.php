<?php
$this->breadcrumbs=array(
	'Person Benefits',
);

$this->menu=array(
	array('label'=>'Create PersonBenefits','url'=>array('create')),
	array('label'=>'Manage PersonBenefits','url'=>array('admin')),
);
?>

<h1>Person Benefits</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
