<?php
/* @var $this QuotaController */
/* @var $model Quota */

$this->breadcrumbs=array(
	'Quota'=>array('index'),
	$model->idQuota=>array('view','id'=>$model->idQuota),
	'Зміна запису довідника',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idQuota),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Квоти" <?php echo $model->idQuota; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
