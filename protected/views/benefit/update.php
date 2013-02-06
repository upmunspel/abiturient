<?php
/* @var $this BenefitController */
/* @var $model Benefit */

$this->breadcrumbs=array(
	'Benefits'=>array('index'),
	$model->idBenefit=>array('view','id'=>$model->idBenefit),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Benefit', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idBenefit)),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Змінити запис довідника "Пільги" <?php echo $model->idBenefit; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>