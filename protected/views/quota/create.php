<?php
/* @var $this QuotaController */
/* @var $model Quota */

$this->breadcrumbs=array(
	'Quota'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Квоти"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
