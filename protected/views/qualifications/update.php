<?php
/* @var $this Qualificationscontroller */
/* @var $model Qualifications */

$this->breadcrumbs=array(
	'Qualifications'=>array('index'),
	$model->idQualification=>array('view','id'=>$model->idQualification),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Qualifications', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idQualification),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Кваліфікації" <?php echo $model->idQualification; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>