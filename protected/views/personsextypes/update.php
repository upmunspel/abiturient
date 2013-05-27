<?php
/* @var $this PersonSexTypesController */
/* @var $model PersonSexTypes */

$this->breadcrumbs=array(
	'Person Sex Types'=>array('index'),
	$model->idPersonSexTypes=>array('view','id'=>$model->idPersonSexTypes),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List PersonSexTypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonSexTypes)),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Змінити запис довідника "Статі" <?php echo $model->idPersonSexTypes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>