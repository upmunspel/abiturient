<?php
/* @var $this Subjectscontroller */
/* @var $model Subjects */

$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Subjects', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Предмет"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>