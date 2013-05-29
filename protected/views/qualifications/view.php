<?php
/* @var $this Qualificationscontroller */
/* @var $model Qualifications */

$this->breadcrumbs=array(
	'Qualifications'=>array('index'),
	$model->idQualification,
);

$this->menu=array(
	/*array('label'=>'List Qualifications', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idQualification),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idQualification),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Кваліфікації" #<?php echo $model->idQualification; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idQualification',
		'QualificationName',
	),
)); ?>
