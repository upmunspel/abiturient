<?php
/* @var $this PersoneducationformsController */
/* @var $model Personeducationforms */

$this->breadcrumbs=array(
	'Personeducationforms'=>array('index'),
	$model->idPersonEducationForm=>array('view','id'=>$model->idPersonEducationForm),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Personeducationforms', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonEducationForm),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Форма освіти особи" <?php echo $model->idPersonEducationForm; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>