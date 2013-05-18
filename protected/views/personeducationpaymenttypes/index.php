<?php
/* @var $this Personeducationpaymenttypescontroller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personeducationpaymenttypes',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Personeducationpaymenttypes</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
