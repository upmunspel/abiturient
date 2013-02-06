<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Country', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Створити запис довідника "Країни громадянства"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>