<?php
/* @var $this BenefitController */
/* @var $model Benefit */

$this->breadcrumbs=array(
	'Benefits'=>array('index'),
	'Довідник ',
);

$this->menu=array(
/*array('label'=>'List Benefit', 'url'=>array('index')),*/
array('label'=>'Додати запис', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('benefit-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Довідник "Пільги"</h1>

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
'id'=>'benefit-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'idBenefit',
		'BenefitName',
		'BenefitKey',
		'BenefitGroupID',
		array('name'=>'Visible',
                    'header'=>'Відображати при виборі',
                    'filter'=>array('1'=>'так','0'=>'ні'),
                    'value'=>'($data->Visible=="1")?("так"):("ні")'),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
