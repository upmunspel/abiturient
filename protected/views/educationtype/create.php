<?php
/* @var $this Educationtypecontroller */
/* @var $model Educationtype */

$this->breadcrumbs=array(
	'Educationtypes'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Educationtype', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Тип освіти"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>