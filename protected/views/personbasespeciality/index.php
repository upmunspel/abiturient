<?php
/* @var $this PersonbasespecialityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personbasespecialities',
);

$this->menu=array(
	array('label'=>'Create Personbasespeciality', 'url'=>array('create')),
	array('label'=>'Manage Personbasespeciality', 'url'=>array('admin')),
);
?>

<h1>Personbasespecialities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
