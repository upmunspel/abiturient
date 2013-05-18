<?php
/* @var $this Benefitcontroller */
/* @var $model Benefit */

$this->breadcrumbs=array(
	'Benefits'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Benefit', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Пільги"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
