<?php
/* @var $this FacultetsController */
/* @var $model Facultets */
$this->pageTitle = "Факультети";
$this->breadcrumbs=array(
	'Facultets'=>array('index'),
	$model->idFacultet=>array('view','id'=>$model->idFacultet),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idFacultet),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Факультет" <?php echo $model->idFacultet; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
