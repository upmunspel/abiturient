<?php
/* @var $this Educationclasscontroller */
/* @var $model Educationclass */

$this->breadcrumbs=array(
	'Educationclasses'=>array('index'),
	$model->idEducationClass,
);

$this->menu=array(
	/*array('label'=>'List Educationclass', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idEducationClass),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idEducationClass),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Освіта" #<?php echo $model->idEducationClass; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idEducationClass',
		'EducationClassName',
	),
)); ?>
