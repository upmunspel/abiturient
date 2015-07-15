<?php
/* @var $this ConvertAttestatController */
/* @var $model ConvertAttestat */

$this->breadcrumbs=array(
	'Convert Attestats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConvertAttestat', 'url'=>array('index')),
	array('label'=>'Manage ConvertAttestat', 'url'=>array('admin')),
);
?>

<h1>Create ConvertAttestat</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>