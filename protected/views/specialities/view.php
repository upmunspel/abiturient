<?php
/* @var $this Specialitiescontroller */
/* @var $model Specialities */

$this->breadcrumbs=array(
	'Specialities'=>array('index'),
	$model->idSpeciality,
);

$this->menu=array(
	/*array('label'=>'List Specialities', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idSpeciality),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSpeciality),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника Specialities #<?php echo $model->idSpeciality; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>array('bordered', 'condensed','striped'),
    'data'=>$model,
	'attributes'=>array(
		'idSpeciality',
		'SpecialityName',
		'SpecialityKode',
		'FacultetID',
		'SpecialityClasifierCode',
		'SpecialityBudgetCount',
		'SpecialityContractCount',
		'isZaoch'=> array('name'=>'isZaoch', 'value' => $model->isZaoch == 1 ? 'Так' : 'Ні'),
		'isPublishIn'=> array('name'=>'isPublishIn', 'value' => $model->isPublishIn == 1 ? 'Так' : 'Ні'),
	),
)); ?>
