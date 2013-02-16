<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->idCountry,
);

$this->menu=array(
	/*array('label'=>'List Country', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idCountry)),
	array('label'=>'Видалити запис', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCountry),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника "Країни громадянства" #<?php echo $model->idCountry; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idCountry',
		'CountryName',
		'Visible',
	),
)); ?>
