<?php
$this->breadcrumbs=array(
	'Sys Pks'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'Перелік','url'=>array('index')),
	array('label'=>'Управління','url'=>array('admin')),
);
?>

<h1>Створити Приймальну комісію</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>