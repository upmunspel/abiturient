<?php
/* @var $this Persondocumenttypescontroller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Person Document Types',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Person Document Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
