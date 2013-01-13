<?php
$this->breadcrumbs=array(
	'people'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Person','url'=>array('index')),
	array('label'=>'Manage Person','url'=>array('admin')),
);
?>

<h3>Абітуріент</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>