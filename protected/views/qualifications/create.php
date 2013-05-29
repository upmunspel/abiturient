<?php
/* @var $this Qualificationscontroller */
/* @var $model Qualifications */

$this->breadcrumbs=array(
	'Qualifications'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Qualifications', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Кваліфікації"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>