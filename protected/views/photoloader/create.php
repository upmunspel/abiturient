<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */

$this->breadcrumbs=array(
	'Person Sex Types'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List PersonSexTypes', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Статі"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>