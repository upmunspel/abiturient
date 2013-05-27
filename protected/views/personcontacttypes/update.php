<?php
/* @var $this PersoncontacttypesController */
/* @var $model Personcontacttypes */

$this->breadcrumbs=array(
	'Personcontacttypes'=>array('index'),
	$model->idPersonContactType=>array('view','id'=>$model->idPersonContactType),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Personcontacttypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonContactType),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Тип контакту з особою"<?php echo $model->idPersonContactType; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>