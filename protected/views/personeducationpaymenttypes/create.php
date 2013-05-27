<?php
/* @var $this Personeducationpaymenttypescontroller */
/* @var $model Personeducationpaymenttypes */

$this->breadcrumbs=array(
	'Personeducationpaymenttypes'=>array('index'),
	'Створення запису довідника ',
);

$this->menu=array(
	/*array('label'=>'List Personeducationpaymenttypes', 'url'=>array('index')),*/
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Створити запис довідника "Форма навчання особи"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>