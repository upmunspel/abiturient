<?php
/* @var $this PersonviewController */
/* @var $model PersonSpecialityView */

$this->breadcrumbs=array(
	'Person Speciality Views'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PersonSpecialityView', 'url'=>array('index')),
	array('label'=>'Manage PersonSpecialityView', 'url'=>array('admin')),
);
?>

<h1>Create PersonSpecialityView</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>