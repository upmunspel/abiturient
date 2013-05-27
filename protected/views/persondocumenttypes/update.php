<?php
/* @var $this Persondocumenttypescontroller */
/* @var $model PersonDocumentTypes */

$this->breadcrumbs=array(
	'Person Document Types'=>array('index'),
	$model->idPersonDocumentTypes=>array('view','id'=>$model->idPersonDocumentTypes),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Facultets', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonDocumentTypes),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Типи документів особи" <?php echo $model->idPersonDocumentTypes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>