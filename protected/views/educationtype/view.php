<?php
/* @var $this Educationtypecontroller */
/* @var $model Educationtype */

$this->breadcrumbs=array(
	'Educationtypes'=>array('index'),
	$model->idEducationType,
);

$this->menu=array(
	/*array('label'=>'List Educationtype', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idEducationType),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idEducationType),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Тип освіти" #<?php echo $model->idEducationType; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idEducationType',
		'EducationTypeFullName',
		'EducationTypeShortName',
		'EducationTypeClassID',
	),
)); ?>
