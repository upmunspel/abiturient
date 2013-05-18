<?php
/* @var $this Schoolscontroller */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->idSchool,
);
$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idSchool),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSchool),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Школи" #<?php echo $model->idSchool; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
    	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idSchool',
		'EducationTypeID',
		'Kode_School',
		'SchoolName',
		'SchoolShortName',
		'KOATUUCode',
		'KOATUUFullName',
		'StreetTypeID',
		'StreetName',
		'HouceNum',
		'SchoolBossLastName',
		'SchoolBossFirstName',
		'SchoolBossMiddleName',
		'SchoolPhone',
		'SchoolMobile',
		'SchoolEMail',
	),
)); ?>
