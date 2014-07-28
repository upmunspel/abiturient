<?php
/* @var $this SpecialityquotesController */
/* @var $model Specialityquotes */

$this->breadcrumbs=array(
	'specialityquotes'=>array('index'),
	$model->idSpecialityQuotes=>array('view','id'=>$model->idSpecialityQuotes),
	'Зміна запису довідника',
);

$this->menu=array(
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idSpecialityQuotes),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Квоти спеціальностей" <?php echo $model->idSpecialityQuotes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
