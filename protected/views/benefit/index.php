<?php
/* @var $this BenefitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Benefits',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Benefits</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
