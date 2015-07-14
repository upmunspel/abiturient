<?php
/* @var $this ConvertAttestatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Convert Attestats',
);

$this->menu=array(
	array('label'=>'Create ConvertAttestat', 'url'=>array('create')),
	array('label'=>'Manage ConvertAttestat', 'url'=>array('admin')),
);
?>

<h1>Convert Attestats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
