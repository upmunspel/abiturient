<?php
/* @var $this Personeducationtypescontroller */
/* @var $model Personeducationtypes */

$this->breadcrumbs=array(
	'Personeducationtypes'=>array('index'),
	$model->idPersonEducationTypes=>array('view','id'=>$model->idPersonEducationTypes),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Personeducationtypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idPersonEducationTypes),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Тип освіти особи" <?php echo $model->idPersonEducationTypes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>