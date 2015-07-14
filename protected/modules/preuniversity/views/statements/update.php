<?php
/* @var $this StatementsController */
/* @var $model Statements */

$this->breadcrumbs=array(
	'Statements'=>array('index'),
	$model->idStatement=>array('view','id'=>$model->idStatement),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Statements', 'url'=>array('index'),'icon'=>" icon-pencil" ),
	array('label'=>'Створити', 'url'=>array('create'),'icon'=>" icon-pencil" ),
	array('label'=>'Переглянути', 'url'=>array('view', 'id'=>$model->idStatement),'icon'=>" icon-pencil" ),
	array('label'=>'Перелік відомостей', 'url'=>array('admin'),'icon'=>" icon-pencil" ),
);
?>

<h1>Редагувати відомість №<?php echo $model->number; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>