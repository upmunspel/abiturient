<?php
/* @var $this Countrycontroller */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->idCountry=>array('view','id'=>$model->idCountry),
	'Зміна запису довідника',
);

$this->menu=array(
	/*array('label'=>'List Country', 'url'=>array('index')),*/
	array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути запис', 'url'=>array('view', 'id'=>$model->idCountry),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути записи', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Змінити запис довідника "Країни громадянства" <?php echo $model->idCountry; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
