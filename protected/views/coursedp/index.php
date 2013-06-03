<?php
/* @var $this CoursedpController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Coursedps',
);

$this->menu=array(
	array('label'=>'Create Coursedp', 'url'=>array('create')),
	array('label'=>'Manage Coursedp', 'url'=>array('admin')),
);
?>

<h1>Coursedps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
