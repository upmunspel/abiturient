<?php
/* @var $this ConvertAttestatController */
/* @var $model ConvertAttestat */

$this->breadcrumbs=array(
	'Convert Attestats'=>array('index'),
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
$.fn.yiiGridView.update('convert-attestat-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Довідник Convert Attestats</h1>

<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'convert-attestat-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'twelve_p',
		'two_hundred_p',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
