<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */

$this->breadcrumbs=array(
	'Specialities'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	//array('label'=>'List Specialities', 'url'=>array('index')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Спеціальності"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>