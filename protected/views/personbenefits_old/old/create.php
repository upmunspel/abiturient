<?php
$this->breadcrumbs=array(
	'Person Benefits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PersonBenefits','url'=>array('index')),
	array('label'=>'Manage PersonBenefits','url'=>array('admin')),
);
?>

<h1>Create PersonBenefits</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>