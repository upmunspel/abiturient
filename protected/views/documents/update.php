<?php
/* @var $this DocumentsController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->idDocuments=>array('view','id'=>$model->idDocuments),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Documents', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idDocuments),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Документи"<?php echo $model->idDocuments; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>