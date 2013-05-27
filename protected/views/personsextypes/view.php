<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */

$this->breadcrumbs=array(
	'Person Sex Types'=>array('index'),
	$model->idPersonSexTypes,
);

$this->menu=array(
	/*array('label'=>'List PersonSexTypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idPersonSexTypes)),
	array('label'=>'Видалити запис', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idPersonSexTypes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника "Статі" #<?php echo $model->idPersonSexTypes; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idPersonSexTypes',
		'PersonSexTypesName',
	),
)); ?>
