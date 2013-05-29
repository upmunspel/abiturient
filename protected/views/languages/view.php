<?php
/* @var $this Languagescontroller */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->idLanguages,
);

$this->menu=array(
	/*array('label'=>'List Languages', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idLanguages),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idLanguages),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Мови" #<?php echo $model->idLanguages; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'type'=>array('bordered', 'condensed','striped'),
	'data'=>$model,
	'attributes'=>array(
		'idLanguages',
		'LanguagesCode',
		'LanguagesName',
	),
)); ?>
