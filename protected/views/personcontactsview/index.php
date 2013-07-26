<?php
/* @var $this PersoncontactsviewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Person Contacts Views',
);

$this->menu=array(
	array('label'=>'Create PersonContactsView', 'url'=>array('create')),
	array('label'=>'Manage PersonContactsView', 'url'=>array('admin')),
);
?>

<h1>Person Contacts Views</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
