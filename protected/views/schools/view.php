<?php
/* @var $this SchoolsController */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->idSchool,
);

$this->menu=array(
	/*array('label'=>'List Schools', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idSchool)),
	array('label'=>'Видалити запис', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idSchool),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Переглянути запис довідника "Школи" #<?php echo $model->idSchool; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
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
