<?php
/* @var $this PricesController */
/* @var $model Prices */

$this->breadcrumbs=array(
	'Prices'=>array('index'),
	$model->idPrice=>array('view','id'=>$model->idPrice),
	'Update',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPrice),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Update Prices <?php echo $model->idPrice; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>