<?php
/* @var $this Educationtypecontroller */
/* @var $model Educationtype */

$this->breadcrumbs=array(
	'Educationtypes'=>array('index'),
	$model->idEducationType=>array('view','id'=>$model->idEducationType),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Educationtype', 'url'=>array('index')),*/
        array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idEducationType),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Тип освіти"<?php echo $model->idEducationType; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>