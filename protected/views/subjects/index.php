<?php
/* @var $this Subjectscontroller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subjects',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Subjects</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
