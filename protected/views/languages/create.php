<?php
/* @var $this Languagescontroller */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Languages', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Мови"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>