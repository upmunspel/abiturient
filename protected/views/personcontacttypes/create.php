<?php
/* @var $this PersoncontacttypesController */
/* @var $model Personcontacttypes */

$this->breadcrumbs=array(
	'Personcontacttypes'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Personcontacttypes', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Тип контакту з особою"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>