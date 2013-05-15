<?php
/* @var $this Educationclasscontroller */
/* @var $model Educationclass */

$this->breadcrumbs=array(
	'Educationclasses'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Educationclass', 'url'=>array('index')),*/
    array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Освіта"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>