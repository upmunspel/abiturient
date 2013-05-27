<?php
/* @var $this Languagescontroller */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->idLanguages=>array('view','id'=>$model->idLanguages),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Languages', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idLanguages),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Мови" <?php echo $model->idLanguages; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>