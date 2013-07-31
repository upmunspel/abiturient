<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->idContract=>array('view','id'=>$model->idContract),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Contracts', 'url'=>array('admin'), "icon"=>""),
        //array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
	array('label'=>'Переглянути', 'url'=>array('view', 'id'=>$model->idContract),'icon'=>"icon-eye-open"),
	array('label'=>'Переглянути контракти', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Редагування Контракту</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'specid'=>$model->PersonSpecialityID)); ?>