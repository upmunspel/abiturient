<?php
/* @var $this PersonbasespecialityController */
/* @var $model Personbasespeciality */

$this->breadcrumbs=array(
	'Personbasespecialities'=>array('index'),
	'Довідник ',
);

$this->menu=array(
array('label'=>'Додати запис', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('personbasespeciality-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Довідник Базові напрямки підготовки</h1>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'personbasespeciality-grid',
    'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'idPersonBaseSpeciality',
		'PersonBaseSpecialityName',
		'PersonBaseSpecialityClasifierCode',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
