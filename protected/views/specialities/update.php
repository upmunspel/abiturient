<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */

$this->breadcrumbs=array(
	'Specialities'=>array('index'),
	$model->idSpeciality=>array('view','id'=>$model->idSpeciality),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Specialities', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idSpeciality),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Спеціальності" <?php echo $model->idSpeciality; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>