<?php
/* @var $this StatementsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Statements',
);

$this->menu=array(
	array('label'=>'Create Statements', 'url'=>array('create'),'icon'=>"" ),
	array('label'=>'Manage Statements', 'url'=>array('admin'), 'icon'=>""),
);
?>

<h1>Statements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
