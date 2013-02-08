<?php
/* @var $this SchoolsController */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->idSchool=>array('view','id'=>$model->idSchool),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Schools', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create')),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idSchool)),
	array('label'=>'Переглянути записи', 'url'=>array('admin')),
);
?>

<h1>Змінити запис довідника "Школи" <?php echo $model->idSchool; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>