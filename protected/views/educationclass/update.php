<?php
/* @var $this Educationclasscontroller */
/* @var $model Educationclass */

$this->breadcrumbs=array(
	'Educationclasses'=>array('index'),
	$model->idEducationClass=>array('view','id'=>$model->idEducationClass),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Educationclass', 'url'=>array('index')),*/
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idEducationClass),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Освіта" <?php echo $model->idEducationClass; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>