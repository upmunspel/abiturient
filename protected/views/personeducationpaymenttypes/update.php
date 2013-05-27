<?php
/* @var $this Personeducationpaymenttypescontroller */
/* @var $model Personeducationpaymenttypes */

$this->breadcrumbs=array(
	'Personeducationpaymenttypes'=>array('index'),
	$model->idEducationPaymentTypes=>array('view','id'=>$model->idEducationPaymentTypes),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Personeducationpaymenttypes', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idEducationPaymentTypes),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Форма навчання особи"<?php echo $model->idEducationPaymentTypes; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>