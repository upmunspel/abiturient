<?php
/* @var $this BenefitsgroupsController */
/* @var $model Benefitsgroups */

$this->breadcrumbs=array(
	'Benefitsgroups'=>array('index'),
	$model->idBenefitsGroups,
);

$this->menu=array(
	/*array('label'=>'List Benefitsgroups', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idBenefitsGroups)),
	array('label'=>'Видалити запис', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idBenefitsGroups),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника Benefitsgroups #<?php echo $model->idBenefitsGroups; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
        'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idBenefitsGroups',
		'BenefitsGroupsName',
	),
)); ?>
