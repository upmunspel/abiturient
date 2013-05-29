<?php
/* @var $this FacultetsController */
/* @var $model Facultets */
$this->pageTitle = "Факультети";
$this->breadcrumbs=array(
	'Facultets'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Факультет"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
