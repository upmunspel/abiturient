<?php
/* @var $this Countrycontroller */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->idCountry,
);

$this->menu=array(
	/*array('label'=>'List Country', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idCountry),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCountry),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Країни громадянства" #<?php echo $model->idCountry; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idCountry',
		'CountryName',
		'Visible',
	),
)); ?>
