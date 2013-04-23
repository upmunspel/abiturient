<?php
/* @var $this BenefitsgroupsController */
/* @var $model Benefitsgroups */

$this->breadcrumbs=array(
	'Benefitsgroups'=>array('index'),
	$model->idBenefitsGroups=>array('view','id'=>$model->idBenefitsGroups),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Benefitsgroups', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idBenefitsGroups)),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Змінити запис довідника Benefitsgroups <?php echo $model->idBenefitsGroups; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>