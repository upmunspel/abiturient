<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */

$this->breadcrumbs=array(
	'Person Sex Types'=>array('index'),
	$model->idPersonSexTypes=>array('view','id'=>$model->idPersonSexTypes),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonSexTypes),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Статі" <?php echo $model->idPersonSexTypes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>