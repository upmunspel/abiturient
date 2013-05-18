<?php
$this->breadcrumbs=array(
	'Sys Pks'=>array('index'),
	$model->idPk=>array('view','id'=>$model->idPk),
	'Update',
);

$this->menu=array(
	array('label'=>'Перелік','url'=>array('index')),
	array('label'=>'Створити','url'=>array('create')),
	array('label'=>'Переглянути','url'=>array('view','id'=>$model->idPk)),
	array('label'=>'Управління','url'=>array('admin')),
);
?>

<h1>Оновити приймальну комісію <?php echo $model->idPk; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>