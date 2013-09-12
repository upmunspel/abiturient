<?php
/* @var $this ContractsController */
/* @var $model Contracts */

$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Contracts', 'url'=>array('index')),
	array('label'=>'Менеджер контрактів', 'url'=>array('admin'),'icon'=>"icon-list-alt"),
);
?>

<h1>Додання контракту</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'specid'=>$specid)); ?>