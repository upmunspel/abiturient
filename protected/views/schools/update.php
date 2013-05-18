<?php
/* @var $this Schoolscontroller */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->idSchool=>array('view','id'=>$model->idSchool),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idSchool),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Школи" <?php echo $model->idSchool; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
