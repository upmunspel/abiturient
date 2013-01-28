<?php
/* @var $this BenefitController */
/* @var $model Benefit */

$this->breadcrumbs=array(
	'Benefits'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Benefit', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Створити запис довідника "Пільги"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>