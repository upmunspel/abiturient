<?php
/* @var $this Educationtypecontroller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Educationtypes',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>"Тип освіти"</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
