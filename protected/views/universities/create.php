<?php
$this->breadcrumbs=array(
	'Universities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Universities','url'=>array('index')),
	array('label'=>'Manage Universities','url'=>array('admin')),
);
?>

<h1>Create Universities</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>