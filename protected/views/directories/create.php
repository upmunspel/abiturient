<?php
$this->breadcrumbs=array(
	'Directories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Directories','url'=>array('index')),
	array('label'=>'Manage Directories','url'=>array('admin')),
);
?>

<h1>Create Directories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>