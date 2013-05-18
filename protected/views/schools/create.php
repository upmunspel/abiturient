<?php
/* @var $this Schoolscontroller */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Schools', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Школи"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
