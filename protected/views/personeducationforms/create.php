<?php
/* @var $this PersoneducationformsController */
/* @var $model Personeducationforms */

$this->breadcrumbs=array(
	'Personeducationforms'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Personeducationforms', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Форма освіти особи"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>