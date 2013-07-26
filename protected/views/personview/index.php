<?php
/* @var $this PersonviewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Person Speciality Views',
);

$this->menu=array(
	array('label'=>'Create PersonSpecialityView', 'url'=>array('create')),
	array('label'=>'Manage PersonSpecialityView', 'url'=>array('admin')),
);
?>

<h1>Person Speciality Views</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
