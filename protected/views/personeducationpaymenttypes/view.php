<?php
/* @var $this Personeducationpaymenttypescontroller */
/* @var $model Personeducationpaymenttypes */

$this->breadcrumbs=array(
	'Personeducationpaymenttypes'=>array('index'),
	$model->idEducationPaymentTypes,
);

$this->menu=array(
	/*array('label'=>'List Personeducationpaymenttypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Змінити запис', 'url'=>array('update', 'id'=>$model->idEducationPaymentTypes),'icon'=>" icon-pencil"),
	array('label'=>'Видалити запис', 'url'=>'#','icon'=>"icon-trash", 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idEducationPaymentTypes),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Переглянути запис довідника "Форма навчання особи" #<?php echo $model->idEducationPaymentTypes; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>array('bordered', 'condensed','striped'),
	'attributes'=>array(
		'idEducationPaymentTypes',
		'EducationPaymentTypesName',
	),
)); ?>
