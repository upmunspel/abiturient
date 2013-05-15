<?php
/* @var $this BenefitsgroupsController */
/* @var $model Benefitsgroups */

$this->breadcrumbs=array(
	'Benefitsgroups'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Benefitsgroups', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Створити запис довідника Benefitsgroups</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>