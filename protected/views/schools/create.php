<?php
/* @var $this SchoolsController */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Schools', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Створити запис довідника "Школи"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>