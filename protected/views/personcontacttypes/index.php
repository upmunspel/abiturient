<?php
/* @var $this PersoncontacttypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personcontacttypes',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Тип контакту з особою</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
