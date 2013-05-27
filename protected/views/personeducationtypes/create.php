<?php
/* @var $this Personeducationtypescontroller */
/* @var $model Personeducationtypes */

$this->breadcrumbs=array(
	'Personeducationtypes'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Personeducationtypes', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Тип освіти особи"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>