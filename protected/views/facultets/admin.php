<?php
/* @var $this FacultetsController */
/* @var $model Facultets */
$this->pageTitle = "Факультети";
$this->breadcrumbs=array(
	'Facultets'=>array('index'),
	'Довідник ',
);

$this->menu=array(
/*array('label'=>'List Facultets', 'url'=>array('index')),*/
array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>"icon-plus"),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('facultets-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<h1>Довідник "Факультет"</h1>
<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>
<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none; margin-top: 20px;">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<!-- search-form -->
<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'facultets-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'idFacultet',
		'FacultetFullName',
		'FacultetShortName',
		'FacultetKode',
		'FacultetTypeName',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
