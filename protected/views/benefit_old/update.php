<?php
/* @var $this Benefitcontroller */
/* @var $model Benefit */

$this->breadcrumbs=array(
	'Benefits'=>array('index'),
	$model->idBenefit=>array('view','id'=>$model->idBenefit),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Benefit', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idBenefit),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Пільги" <?php echo $model->idBenefit; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
