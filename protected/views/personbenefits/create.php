<?php
$this->breadcrumbs=array(
	'Personbenefits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Personbenefits','url'=>array('index')),
	array('label'=>'Manage Personbenefits','url'=>array('admin')),
);
?>

<h1>Create Personbenefits</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>