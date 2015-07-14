<?php
/* @var $this ConvertAttestatController */
/* @var $model ConvertAttestat */

$this->breadcrumbs=array(
	'Convert Attestats'=>array('index'),
	$model->twelve_p=>array('view','id'=>$model->twelve_p),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConvertAttestat', 'url'=>array('index')),
	array('label'=>'Create ConvertAttestat', 'url'=>array('create')),
	array('label'=>'View ConvertAttestat', 'url'=>array('view', 'id'=>$model->twelve_p)),
	array('label'=>'Manage ConvertAttestat', 'url'=>array('admin')),
);
?>

<h1>Update ConvertAttestat <?php echo $model->twelve_p; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>