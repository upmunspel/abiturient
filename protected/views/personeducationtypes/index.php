<?php
/* @var $this Personeducationtypescontroller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personeducationtypes',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Personeducationtypes</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
