<?php
/* @var $this Subjectscontroller */
/* @var $model Subjects */

$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	$model->idSubjects=>array('view','id'=>$model->idSubjects),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Subjects', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idSubjects),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Предмет" <?php echo $model->idSubjects; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>