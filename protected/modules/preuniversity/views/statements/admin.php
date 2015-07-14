<?php
/* @var $this StatementsController */
/* @var $model Statements */

    $this->breadcrumbs=array(
            'Ведомости'=>array('index'),
            'Довідник ',
    );

    $this->menu=array(
        array('label'=>'Додати запис', 'url'=>array('create'),'icon'=>" icon-pencil" ),
        array('label'=>'Перелік слухачів', 'url'=>array('/preuniversity/person'),'icon'=>" icon-user" ),
    );
?>

<?php /*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('statements-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
*/ ?>
<h1>Відомості</h1>

<p>
    Можна додати оператор порівняння (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) перед значенням пошуку
</p>

<?php //echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">
    <?php //$this->renderPartial('_search',array(	'model'=>$model,)); ?>
</div> search-form -->



<?php $this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'statements-grid',
'type'=>'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		//'idStatement',
		'number',
		'created',
                //'updated',
		//'uid',
		
                array("name"=>"SpecialityID","value"=>'$data->getSpecFullName()'),
		/*
		'Subjects1ID',
		'Subjects2ID',
		'Subjects3ID',
		'SubjectsDate1',
		'SubjectsDate2',
		'SubjectsDate3',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
