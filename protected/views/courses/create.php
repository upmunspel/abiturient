<?php
/* @var $this Coursescontroller */
/* @var $model Courses */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Courses', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Курси"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>