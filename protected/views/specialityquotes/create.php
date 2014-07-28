<?php
/* @var $this SpecialityquotesController */
/* @var $model Specialityquotes */

$this->breadcrumbs=array(
	'specialityquotes'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Квоти спеціальностей"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
