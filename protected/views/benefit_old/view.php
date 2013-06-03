<?php
/* @var $this BenefitController */
/* @var $model Benefit */

$this->breadcrumbs=array(
	'Benefits'=>array('index'),
	$model->idBenefit,
);

$this->menu=array(
	/*array('label'=>'List Benefit', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idBenefit)),
	array('label'=>'Видалити запис', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idBenefit),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника "Пільги" #<?php echo $model->idBenefit; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idBenefit',
		'BenefitName',
		'BenefitKey',
		'BenefitGroup',
		'Visible',
	),
)); ?>
